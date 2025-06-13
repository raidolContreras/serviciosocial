<?php

require_once "../../model/forms.models.php";
require_once "../forms.controller.php";

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'get_externals':
            $response = PracticasController::ctrGetExternals();
            echo json_encode($response);
            break;
        case 'accept_external':
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $response = PracticasController::ctrAcceptExternal($id);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'ID not provided']);
            }
            break;
        case 'disable_external':
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $response = PracticasController::ctrDisableExternal($id);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'ID not provided']);
            }
            break;
    }
} else {
    echo json_encode(['error' => 'No action specified']);
}