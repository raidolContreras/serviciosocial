<?php

#autoload composer
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controller/emails.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class FormsController
{

    public function ctrRegisterUser()
    {
        if (isset($_POST["firstname"])) {
            $table = "users";
            $data = array(
                "firstname" => $_POST["firstname"],
                "lastname" => $_POST["lastname"],
                "email" => $_POST["email"],
                "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
                "role" => $_POST["role"]
            );
            $response = FormsModel::mdlRegisterUser($table, $data);
            echo $response ? 'success' : 'error';
        }
    }

    public function ctrLogin()
    {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $table = "users";
            $item = "email";
            $value = $_POST["email"];
            $response = FormsModel::mdlShowUser($table, $item, $value);
            if ($response && password_verify($_POST["password"], $response["password"])) {
                session_start();
                $_SESSION["logged"] = true;
                unset($response["password"]);
                $_SESSION["user"] = $response;
                echo 'success';
            } else {
                $student = FormsModel::mdlGetStudent($_POST['email']);
                if ($student && password_verify($_POST["password"], $student["password"])) {
                    session_start();
                    $student['role'] = 'student';
                    $_SESSION["logged"] = true;
                    unset($student["password"]);
                    $_SESSION["user"] = $student;
                    echo 'success';
                } else {
                    echo 'error';
                }
            }
        }
    }

    public function ctrGradeStudent($data)
    {
        return FormsModel::mdlGradeStudent($data);
    }

    public function ctrSearchAreas($idArea)
    {
        return FormsModel::mdlSearchAreas($idArea);
    }

    public function ctrEditArea($editArea, $nameArea)
    {
        return FormsModel::mdlEditArea($editArea, $nameArea);
    }

    public function ctrDeleteArea($deleteArea)
    {
        return FormsModel::mdlDeleteArea($deleteArea);
    }

    public function ctrAddArea($nameArea)
    {
        return FormsModel::mdlAddArea($nameArea);
    }

    public function ctrSearchEventTypes($idEventType)
    {
        return FormsModel::mdlSearchEventTypes($idEventType);
    }

    public function ctrEditEventType($editEventType, $name, $idArea, $pointsPerEvent, $benefitsPerYear)
    {
        return FormsModel::mdlEditEventTypes($editEventType, $name, $idArea, $pointsPerEvent, $benefitsPerYear);
    }

    public function ctrDeleteEventType($deleteEventType)
    {
        return FormsModel::mdlDeleteEventTypes($deleteEventType);
    }

    public function ctrAddEventType($name, $pointsPerEvent, $benefitsPerYear, $idArea)
    {
        return FormsModel::mdlAddEventTypes($name, $pointsPerEvent, $benefitsPerYear, $idArea);
    }

    public function ctrGetCourses($idCourse)
    {
        return FormsModel::mdlGetCourses($idCourse);
    }

    public function ctrAddCourse($nameCourse, $startCourse, $endCourse)
    {
        return FormsModel::mdlAddCourse($nameCourse, $startCourse, $endCourse);
    }

    public function ctrEditCourse($idCourse, $nameCourse, $startCourse, $endCourse)
    {
        return FormsModel::mdlUpdateCourse($idCourse, $nameCourse, $startCourse, $endCourse);
    }

    public function ctrDeleteCourse($deleteCourse)
    {
        return FormsModel::mdlDeleteCourse($deleteCourse);
    }

    public function ctrSearchStudents($student)
    {
        return FormsModel::mdlSearchStudents($student);
    }

    public function ctrEndSocialService($student)
    {
        $student = FormsModel::mdlSearchStudents($student);
        if ($student) {
            $degree = FormsModel::mdlSearchDegrees($student['idDegree']);

            FormsModelPDF::getAceptationCard($student, $degree);

            return FormsModelPDF::mdlEndSocialService($student, $degree);
        }
    }

    public function ctrAcceptStudent($student)
    {
        $response = FormsModel::mdlAcceptStudent($student);
        if ($response == 'success') {
            // Generate a random password
            $password = generateRandomPassword();

            $cryptPass = password_hash($password, PASSWORD_DEFAULT);

            $response = FormsModel::mdlAddPasswordStudent($cryptPass, $student);

            // If the update is successful, send the password to the student by email
            if ($response == 'success') {
                $searchStudent = FormsModel::mdlSearchStudents($student);
                if ($searchStudent) {
                    $sendMail = sendPasswordToStudent($searchStudent["email"], $password);
                    echo $sendMail;
                }
            }
        }
        return $password;
    }

    public function ctrDenegateStudent($idStudent)
    {
        return FormsModel::mdlDenegateStudent($idStudent);
    }

    public function ctrDropStudent($idStudent, $reason)
    {
        return FormsModel::mdlDropStudent($idStudent, $reason);
    }

    public function ctrGetEvents()
    {
        return FormsModel::mdlGetEvents();
    }

    static public function ctrAddDegree($data)
    {
        return FormsModel::mdlAddDegree($data);
    }

    static public function ctrSearchDegrees($idDegree)
    {
        return FormsModel::mdlSearchDegrees($idDegree);
    }

    static public function ctrRegisterStudent($data)
    {
        $register = FormsModel::mdlRegisterStudent($data);
        if ($register == 'success') {
            return $register;
        } elseif ($register != 'duplicate' && $register != 'error') {
            $password = generateRandomPassword();
            $cryptPass = password_hash($password, PASSWORD_DEFAULT);
            $response = FormsModel::mdlAddPasswordStudent($cryptPass, $register);
            if ($response == 'success') {
                $sendMail = sendServiceSocialInfo($data["correoInstitucional"], $password);
                if ($sendMail == 'ok') {
                    return 'success';
                } else {
                    return 'error';
                }
            } else {
                return 'error';
            }
        } else {
            return 'duplicate';
        }
    }

    static public function ctrEditStudent($data)
    {
        return FormsModel::mdlEditStudent($data);
    }

    static public function ctrApplyEvent($idEvent, $idStudent)
    {
        return FormsModel::mdlApplyEvent($idEvent, $idStudent);
    }

    static public function ctrCheckApplicationEvent($idEvent, $idStudent)
    {
        return FormsModel::mdlCheckApplicationEvent($idEvent, $idStudent);
    }

    static public function ctrSearchEvents($idEvent)
    {
        return FormsModel::mdlSearchEvents($idEvent);
    }

    static public function ctrStudentEvents($idEvent)
    {
        return FormsModel::mdlStudentEvents($idEvent);
    }

    static public function ctrEventsCandidates($idEvent)
    {
        return FormsModel::mdlEventsCandidates($idEvent);
    }

    static public function ctrUsersToAreas($idArea)
    {
        return FormsModel::mdlUsersToAreas($idArea);
    }

    static public function ctrUpdateUsersToAreas($idArea, $idUser)
    {
        return FormsModel::mdlUpdateUsersToAreas($idArea, $idUser);
    }

    static public function ctrSearchUsers($idUser)
    {
        return FormsModel::mdlSearchUsers($idUser);
    }

    static public function ctrAcceptCandidate($idStudent, $idEvent, $idUser, $status)
    {
        if ($status == 1) {
            return FormsModel::mdlAcceptCandidate($idStudent, $idEvent, $idUser);
        } else {
            return FormsModel::mdlDeclineCandidate($idStudent, $idEvent, $idUser);
        }
    }

    static public function ctrApproveEvent($idStudent, $idEvent, $idUser, $status)
    {
        if ($status == 1) {
            $points = FormsModel::mdlGetPointsEvent($idEvent);
            return FormsModel::mdlApproveEvent($idStudent, $idEvent, $idUser, $points['points']);
        } else {
            return FormsModel::mdlDeclineEvent($idStudent, $idEvent, $idUser);
        }
    }

    static public function ctrStudentEventsPoints($idStudent)
    {
        return FormsModel::mdlStudentEventsPoints($idStudent);
    }

    static public function ctrEditDegree($data)
    {
        return FormsModel::mdlEditDegree($data);
    }

    static public function ctrDeleteDegree($idDegree)
    {
        return FormsModel::mdlDeleteDegree($idDegree);
    }
}

class SilController
{

    public function ctrSearchStudentSIL($matricula)
    {
        return SilModel::mdlSearchStudentSIL($matricula);
    }
}

class ServicioController
{
    static public function ctrGetOrganismos_receptores()
    {
        return ServicioModel::mdlGetOrganismos_receptores();
    }
}

class PracticasController
{
    static public function ctrGetExternals()
    {
        return PracticasModel::mdlGetExternals($idexternal = null);
    }

    static public function ctrAcceptExternal($id)
    {
        $result = PracticasModel::mdlAcceptExternal($id);
        if ($result == 'success') {
            $external = PracticasModel::mdlGetExternals($id);
            if ($external) {
                // Generate a random password
                $password = generateRandomPassword();
                $cryptPass = password_hash($password, PASSWORD_DEFAULT);
                $response = PracticasModel::mdlAddPasswordExternal($cryptPass, $id);
                // If the update is successful, send the password to the external organization by email
                if ($response == 'success') {
                    $sendMail = sendPracticasOrganismoExternoInfo($external["email"], $password);
                } else {
                    return 'error';
                }
                return $sendMail;
            }
            return 'error';
        } else {
            return $result;
        }
    }
    static public function ctrDisableExternal($id)
    {
        return PracticasModel::mdlDisableExternal($id);
    }

    static public function ctrLoginOrganismoReceptor()
    {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $table = "organismos_externos";
            $item = "email";
            $value = $_POST["email"];
            $response = PracticasModel::mdlShowOrganismoReceptor($table, $item, $value);
            if ($response && password_verify($_POST["password"], $response["password"])) {
                session_start();
                $_SESSION["logged"] = true;
                unset($response["password"]);
                $_SESSION["user"] = $response;
                $_SESSION["user"]['role'] = 'organismo_externo';
                echo 'success';
            } else {
                echo 'error Contraseña o correo incorrecto';
            }
        }
    }

    static public function solicitarPracticas($data) {
        $response = PracticasModel::mdlSolicitarPracticas($data);
        if ($response['success']) {
            Notifications::addNotification(
                11, // recipient_id (replace with actual admin ID if needed)
                'admin', // recipient_type
                'Nueva solicitud de prácticas recibida.', // message
                'solicitudes_practicas', // url
                null, // data
                2, // notification_type
                2 // priority
            );
        }
        return $response;
    }

    static public function getSolicitudesPracticas($organismo_externo_id) {
        $response = PracticasModel::mdlGetSolicitudesPracticas($organismo_externo_id);
        return $response;
    }
    
    static public function deleteSolicitudPractica($idSolicitud) {
        $response = PracticasModel::mdlDeleteSolicitudPractica($idSolicitud);
        return $response;
    }

    static public function getSolicitudPracticaById($idSolicitud) {
        $response = PracticasModel::mdlGetSolicitudPracticaById($idSolicitud);
        return $response;
    }

    static public function updateSolicitudPractica($data) {
        $response = PracticasModel::mdlUpdateSolicitudPractica($data);
        return $response;
    }
}

function generateRandomPassword($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
