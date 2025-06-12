<?php

#autoload composer
require_once __DIR__ . '/../vendor/autoload.php';

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
            $password = $this->generateRandomPassword();

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

    private function generateRandomPassword($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
            $password = (new self)->generateRandomPassword();
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

function sendPasswordToStudent($email, $password)
{
    $subject = 'Servicio social UNIMO - Nueva contraseña';

    $message = '
    <html>
    <head>
        <title>Servicio social UNIMO - Nueva contraseña</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .email-container {
                width: 100%;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 600px;
                margin: 20px auto;
                overflow: hidden;
            }
            .header {
                background-color: #01643D;
                padding: 20px;
                border-radius: 10px 10px 0 0;
                color: white;
                text-align: center;
            }
            .header img {
                max-width: 200px;
                margin-bottom: 10px;
            }
            .header h1 {
                margin: 0;
                font-size: 22px;
                line-height: 1.4;
            }
            .content {
                padding: 20px;
                text-align: left;
            }
            .content p {
                font-size: 16px;
                color: #333333;
                line-height: 1.5;
                margin-bottom: 20px;
            }
            .content .info-box {
                background-color: #e7f5ec;
                color: #01643D;
                padding: 10px;
                border-radius: 5px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
                text-decoration: none;
            }
            .content a.button {
                display: inline-block;
                background-color: #01643D;
                color: #ffffff;
                padding: 12px 20px;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                margin-top: 20px;
            }
            .footer {
                text-align: center;
                padding: 20px;
                font-size: 12px;
                color: #999999;
                background-color: #f4f4f4;
                border-radius: 0 0 10px 10px;
            }
            .footer a {
                color: #01643D;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <img src="https://serviciosocial.unimontrer.edu.mx/view/assets/images/logo.png" alt="UNIMO Logo">
                <h1>Bienvenido al servicio social de UNIMO</h1>
            </div>
            <div class="content">
                <p>Hola,</p>
                <p>¡Bienvenido al servicio social de UNIMO! Estamos emocionados de que formes parte de nuestro programa.</p>
                <p>Tu email registrado es:</p>
                <p class="info-box">' . $email . '</p>
                <p>Tu contraseña es:</p>
                <p class="info-box">' . $password . '</p>
                <p>Para iniciar sesión en nuestra plataforma, haz clic en el botón de abajo o visita nuestro sitio web.</p>
                <p style="text-align: center;"><a href="https://serviciosocial.unimontrer.edu.mx"' . $email . '&password=' . $password . '" target="_blank" class="button">Iniciar sesión</a></p>
            </div>
            <div class="footer">
                <p>Si tienes alguna pregunta, no dudes en <a href="mailto:serviciosocial@unimontrer.edu.mx">contactarnos</a>.</p>
                <p>&copy; ' . date("Y") . ' Universidad Montrer. Todos los derechos reservados.</p>
            </div>
        </div>
    </body>
    </html>';

    $mail = new PHPMailer(true);

    // configurar campos env
    $HOST = $_ENV['SMTP_HOST'];
    $USER = $_ENV['SMTP_USER'];
    $PASS = $_ENV['SMTP_PASS'];
    $PORT = $_ENV['SMTP_PORT'];
    $NAME = $_ENV['FROM_NAME'];
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        // Configurar el correo a UTF-8
        $mail->CharSet = 'UTF-8';

        // Configuración del remitente y destinatario
        $mail->setFrom($_ENV['FROM_EMAIL'], $_ENV['FROM_NAME']);
        $mail->addAddress($email); // Añadir destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = '';

        // Enviar correo
        $mail->send();
        return 'ok';
    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        echo "Error al enviar correo: {$mail->ErrorInfo}";
        return false;
    }

}

function sendServiceSocialInfo($email, $password)
{
    $subject = 'Servicio Social UNIMO - Información y formatos';

    // Versión HTML del correo (HEREDOC para interpolar {$email} y {$password})
    $message = <<<HTML
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Servicio Social UNIMO</title>
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #F2F2F5;
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                    color: #1C1C1E;
                }
                .container {
                    max-width: 600px;
                    margin: 40px auto;
                    background-color: #FFFFFF;
                    border-radius: 20px;
                    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
                    overflow: hidden;
                }
                .header {
                    background-color: #FFFFFF;
                    text-align: center;
                    padding: 30px 0 10px;
                }
                .header img {
                    width: 120px;
                    height: auto;
                }
                .content {
                    padding: 30px 30px 10px;
                    line-height: 1.6;
                    font-size: 16px;
                }
                .content h2 {
                    font-weight: 600;
                    margin-bottom: 20px;
                }
                .content p {
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    background-color: #efeffc;
                    color: #303030;
                    text-decoration: none;
                    padding: 14px 24px;
                    border-radius: 12px;
                    font-weight: 500;
                }
                .footer {
                    background-color: #efeffc;
                    padding: 20px 30px;
                    text-align: center;
                    font-size: 13px;
                    color: #6E6E73;
                }
                .info-box {
                    display: inline-block;
                    background: #f0f0f0;
                    padding: 4px 8px;
                    border-radius: 4px;
                    font-weight: 600;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="https://infomontrer.unimontrer.edu.mx/assets/images/logo.png" alt="Logo UNIMO">
                </div>
                <div class="content">
                    <h2>Buen día,</h2>
                    <p>
                        El Servicio Social UNIMO está regulado por el Instituto de la Juventud Michoacana, 
                        ubicado en Periférico Paseo de la República 2451, C.P. 58290, Morelia, Mich. 
                        Encuentra sus formatos y requisitos aquí:
                    </p>
                    <p>
                        <a href="https://jovenes.michoacan.gob.mx/" target="_blank" class="button">
                            Visitar Instituto
                        </a>
                    </p>
                    <p>
                        Asegúrate de ver si tu empresa, institución o dependencia cuenta con un Programa 
                        de Servicio Social registrado y vigente antes de tu desarrollo.
                    </p>
                    <p>
                        El Servicio Social debe realizarse después de acreditar las Prácticas Profesionales 
                        y de haber concluido quinto semestre o sexto cuatrimestre (para licenciaturas 
                        en salud, hasta finalizar estudios profesionales).
                    </p>
                    <p>
                        Para emitir tu <strong>Carta de Presentación</strong>, ingresa con los siguientes datos:
                    </p>
                    <p>
                        <a href="https://serviciosocial.unimontrer.edu.mx" target="_blank" class="button">
                            Ingresar al sitio
                        </a>
                    </p>
                    <p>
                        <strong>Usuario (correo):</strong>
                        <span class="info-box">{$email}</span><br>
                        <strong>Contraseña:</strong>
                        <span class="info-box">{$password}</span>
                    </p>
                    <p>
                        <strong>Contacto adicional:</strong><br>
                        Servicio Social Nutrición/Fisioterapia: 
                        <a href="mailto:servicionutricion@unimontrer.edu.mx">servicionutricion@unimontrer.edu.mx</a><br>
                        Prácticas Profesionales: 
                        <a href="mailto:practicasprofesionales@unimontrer.edu.mx">practicasprofesionales@unimontrer.edu.mx</a>
                    </p>
                    <p style="color:#8E8E93; font-size:14px;">
                        Nota: No envíes la misma solicitud más de una vez; se atienden en orden de llegada.
                    </p>
                    <p>Saludos,<br>Gracias por tu atención.</p>
                </div>
                <div class="footer">
                    Universidad Montrer (UNIMO) • Av Lázaro Cárdenas 1760, Chapultepec Sur, 58260 Morelia, Mich. • Morelia, Michoacán
                </div>
            </div>
        </body>
        </html>
        HTML;

    // Versión plain-text
    $plainText = <<<TXT
        Buen día,

        El Servicio Social UNIMO está regulado por el Instituto de la Juventud Michoacana:
        https://jovenes.michoacan.gob.mx/

        Verifica que tu dependencia tenga Programa de Servicio Social registrado y vigente.

        Debes completar las Prácticas Profesionales y haber concluido 5° semestre o 6° cuatrimestre.
        Usuario: {$email}
        Contraseña: {$password}

        Contacto:
        - Nutrición/Fisioterapia: servicionutricion@unimontrer.edu.mx
        - Prácticas Profesionales: practicasprofesionales@unimontrer.edu.mx

        Nota: No envíes la misma solicitud más de una vez; se atienden en orden de llegada.

        Saludos,
        Gracias por tu atención.
        TXT;

    $mail = new PHPMailer(true);
    try {
        // Configuración SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        // Remitente y destinatario
        $mail->CharSet = 'UTF-8';
        $mail->setFrom($_ENV['FROM_EMAIL'], $_ENV['FROM_NAME']);
        $mail->addAddress($email);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $plainText;

        $mail->send();
        return 'ok';
    } catch (Exception $e) {
        error_log("Error al enviar correo: {$mail->ErrorInfo}");
        return false;
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

class PracticasController {
    static public function ctrGetExternals() {
        return PracticasModel::mdlGetExternals($idexternal = null);
    }
}