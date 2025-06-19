<?php

header('Content-Type: application/json');

require_once "../../model/forms.models.php";
require_once "../forms.controller.php";
require_once __DIR__ . '/../../vendor/autoload.php';
session_start();

switch ($_POST['action']) {
    case 'getSolicitudes':
        $response = PracticasController::getSolicitudesPracticas($_SESSION['user']['id']);
        echo json_encode($response);
        break;
    case 'getSolicitudById':
        $idSolicitud = $_POST['id'];
        $response = PracticasController::getSolicitudPracticaById($idSolicitud);
        echo json_encode($response);
        break;
    case 'solicitarPracticas':
        $data = array(
            'licenciatura' => $_POST['licenciatura'],
            'numPract' => $_POST['numPract'],
            'actividades' => $_POST['actividades'],
            'apoyoEconomico' => ($_POST['apoyoEconomico'] == 'Sí') ? 1 : 0,
            'montoApoyo' => $_POST['montoApoyo'],
            'fechaLimite' => $_POST['fechaLimite'],
            'modalidad' => $_POST['modalidad'],
            'diaInicio' => $_POST['diaInicio'],
            'diaFin' => $_POST['diaFin'],
            'horaInicio' => $_POST['horaInicio'],
            'horaFin' => $_POST['horaFin'],
            'capacidades' => $_POST['capacidades'],
            'direccionPractica' => $_POST['direccionPractica'],
            'nombreResponsable' => $_POST['nombreResponsable'],
            'contactoResponsable' => $_POST['contactoResponsable'],
            'organismo_externo_id' => $_SESSION['user']['id']
        );
        $response = PracticasController::solicitarPracticas($data);
        echo json_encode($response);
        break;
    case 'updateSolicitud':
        $data = array(
            'idSolicitud' => $_POST['idSolicitud'],
            'licenciatura' => $_POST['licenciatura'],
            'numPract' => $_POST['numPract'],
            'actividades' => $_POST['actividades'],
            'apoyoEconomico' => ($_POST['apoyoEconomico'] == 'Sí') ? 1 : 0,
            'montoApoyo' => $_POST['montoApoyo'],
            'fechaLimite' => $_POST['fechaLimite'],
            'modalidad' => $_POST['modalidad'],
            'diaInicio' => $_POST['diaInicio'],
            'diaFin' => $_POST['diaFin'],
            'horaInicio' => $_POST['horaInicio'],
            'horaFin' => $_POST['horaFin'],
            'capacidades' => $_POST['capacidades'],
            'direccionPractica' => $_POST['direccionPractica'],
            'nombreResponsable' => $_POST['nombreResponsable'],
            'contactoResponsable' => $_POST['contactoResponsable']
        );
        $response = PracticasController::updateSolicitudPractica($data);
        echo json_encode($response);
        break;
    case 'deleteSolicitud':
        $idSolicitud = $_POST['id'];
        $response = PracticasController::deleteSolicitudPractica($idSolicitud);
        echo json_encode($response);
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
    
}