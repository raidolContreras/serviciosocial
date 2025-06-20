<?php
session_start();

$pagina = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_STRING);
$pagina = $pagina ? $pagina : 'inicio';

// Verificar si el usuario está logueado
if (!isset($_SESSION['logged'])) {
    // Permitir el acceso a login o RegisterStudent sin estar logueado
    if ($pagina == 'login' || $pagina == 'inscripcionPracticas' || $pagina == 'inscripcionServicio' || $pagina == 'inscripcionEmpresas' || $pagina == 'OrganismoReceptor') {
        if ($pagina == 'inscripcionServicio') {
            $pagina = 'RegisterStudent';
        } elseif ($pagina == 'inscripcionPracticas') {
            $pagina = 'practicas/RegisterPracticas';
        } elseif ($pagina == 'inscripcionEmpresas') {
            $pagina = 'practicas/RegisterEmpresas';
        } elseif ($pagina == 'OrganismoReceptor') {
            $pagina = 'practicas/organismoReceptor';
        }
        include_once 'view/pages/' . $pagina . '.php';
    } else {
        // Redirigir al login si intenta acceder a otras páginas sin estar logueado
        header("Location: login");
        exit();
    }
} else {
    includeAuthPages($pagina);
}

function includeUserPages($pagina)
{
    include 'view/pages/navs/header.php';
    include 'view/js.php';
    includeCommonComponents();

    // Detectar dinámicamente si está en subcarpeta "practicas/"
    // o en la raíz de view/pages/
    $paths = [
        "view/pages/$pagina.php",
        "view/pages/practicas/$pagina.php"
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            include $file;
            return;
        }
    }

    // Si no encontramos el archivo
    includeError404();
}

function includeAuthPages($pagina)
{
    $role = $_SESSION['user']['role'] ?? '';
    if ($role === 'admin') {
        $whitelist = ['inicio','users','events','event_types','students','register_event','courses','areas','degrees','internship_companies','practice_solicitud','internship_students','internship_events'];
    } elseif ($role === 'teacher') {
        $whitelist = ['inicio', 'students'];
    } else {
        $whitelist = ['inicio'];
    }

    if (!in_array($pagina, $whitelist, true)) {
        includeError404();
        return;
    }

    // Ya no es necesario reasignar $pagina aquí: includeUserPages lo resuelve
    includeUserPages($pagina);
}

function includeCommonComponents()
{
    include 'view/pages/navs/sidebar.php';
}

function includeError404()
{
    include 'view/pages/error404.php';
}
