<?php
require_once "../../model/forms.models.php";
require_once "../forms.controller.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $login = new PracticasController();
    $login->ctrLoginOrganismoReceptor();
} else {
    echo "Invalid request";
}
