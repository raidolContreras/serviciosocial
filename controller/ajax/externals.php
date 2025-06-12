<?php

require_once "../../model/forms.models.php";
require_once "../forms.controller.php";

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'get_externals':
            $response = PracticasController::ctrGetExternals();
            echo json_encode($response);
            break;
    }
} else {
    echo json_encode(['error' => 'No action specified']);
}