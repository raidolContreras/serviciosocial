<?php

$pagina = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_STRING);
$pagina = $pagina ? $pagina : 'inicio';
$role = $_SESSION["user"]['role'];

$roleLabels = [
    'admin' => 'Administrador',
    'teacher' => 'Director de área',
    'student' => 'Estudiante'
];
$roleLabel = $roleLabels[$_SESSION["user"]['role']] ?? 'Usuario';
?>
<div class="row">
    <div class="col-2 px-0 sidebar sidebar-collapse pt-2 d-flex flex-column h-100">
        <!-- Contenedor principal del sidebar -->
        <div class="px-3">
            <a href="./" class="icon-header-logo">
                <img src="view/assets/images/logo-color.png" alt="Logo" class="logo">
            </a>
            <nav class="mt-4">

                <div><?= htmlspecialchars($roleLabel, ENT_QUOTES, 'UTF-8'); ?></div>
                <h6><?= htmlspecialchars($_SESSION["user"]['firstname'] . ' ' . $_SESSION["user"]['lastname'], ENT_QUOTES, 'UTF-8'); ?>
                </h6>
                <input type="hidden" id="role"
                    value="<?= htmlspecialchars($_SESSION["user"]['role'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php if ($_SESSION["user"]['role'] === 'student'): ?>
                    <input type="hidden" id="idStudent"
                        value="<?= htmlspecialchars($_SESSION["user"]['idStudent'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php else: ?>
                    <input type="hidden" id="idUser"
                        value="<?= htmlspecialchars($_SESSION["user"]['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" id="idArea"
                        value="<?= htmlspecialchars($_SESSION["user"]['idArea'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php endif; ?>

                <div class="row schools" style="padding-right: 0 !important;">
                    <a href="inicio" class="mt-3 menu-top py-2 <?= setActiveClass('inicio', $pagina) ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa-duotone fa-house"></i>
                            </div>
                            <div class="col-8">Tablero</div>
                        </div>
                    </a>
                    <?php if ($role === 'admin'): ?>
                        <div class="dropdown mt-1">
                            <button class="btn menu-top dropdown-toggle w-100" type="button"
                                id="adminMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-duotone fa-hands-helping me-2"></i> Servicio social
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="adminMenuButton">
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('users', $pagina) ?>" href="users">
                                        <i class="fa-duotone fa-users me-2"></i> Usuarios
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('courses', $pagina) ?>" href="courses">
                                        <i class="fad fa-school me-2"></i> Ciclo escolar
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('degrees', $pagina) ?>" href="degrees">
                                        <i class="fad fa-graduation-cap me-2"></i> Licenciaturas
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('areas', $pagina) ?>" href="areas">
                                        <i class="fad fa-ball-pile me-2"></i> Áreas
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('events', $pagina) ?>" href="events">
                                        <i class="fad fa-calendar me-2"></i> Eventos
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('students', $pagina) ?>" href="students">
                                        <i class="fad fa-user-graduate me-2"></i> Estudiantes
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown mt-1">
                            <button class="btn menu-top dropdown-toggle w-100" type="button"
                                id="internshipMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-duotone fa-briefcase me-2"></i> Prácticas profesionales
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="internshipMenuButton">
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('internship_companies', $pagina) ?>" href="internship_companies">
                                        <i class="fa-duotone fa-building me-2"></i> Organismos receptores
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('internship_students', $pagina) ?>" href="internship_students">
                                        <i class="fa-duotone fa-user-tie me-2"></i> Estudiantes
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?= setActiveClass('internship_events', $pagina) ?>" href="internship_events">
                                        <i class="fa-duotone fa-calendar-days me-2"></i> Eventos
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php elseif ($role === 'teacher'): ?>
                        <!-- Menú para teacher (sin desplegable) -->
                        <a href="students" class="mt-3 menu-top py-2 <?= setActiveClass('students', $pagina) ?>">
                            <div class="row">
                                <div class="col-2"><i class="fad fa-user-graduate"></i></div>
                                <div class="col-8">Estudiantes</div>
                            </div>
                        </a>
                    <?php endif; ?>

                </div>
            </nav>
        </div>

        <!-- Botón de Cerrar sesión alineado abajo -->
        <div class="px-3 mt-auto">
            <!-- Información del usuario -->
            <ul class="navbar-nav w-100">
                <li class="d-grid gap-2">
                    <button class="btn-logout mt-3 py-2" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Resto del layout -->
    <div class="col-lg-3 col-xl-2"></div>
    <div class="col-12 col-lg-9 col-xl-10 p-4 row">
        <!-- Aquí continúa el contenido de la página -->