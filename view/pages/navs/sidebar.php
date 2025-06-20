<?php

$user = $_SESSION['user'] ?? [];
$pagina = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_STRING) ?: 'inicio';

// Etiquetas de rol
$roleLabels = [
    'admin'               => 'Administrador',
    'teacher'             => 'Director de área',
    'student'             => 'Estudiante',
    'organismo_externo'   => 'Organismo externo',
];
$role       = $user['role'] ?? '';
$roleLabel  = $roleLabels[$role] ?? 'Usuario';

// Configuración genérica del menú
$menuConfig = [
    'admin' => [
        [
            'type' => 'link',
            'href' => 'inicio',
            'icon' => 'fa-duotone fa-house',
            'text' => 'Tablero',
        ],
        [
            'type'  => 'dropdown',
            'text'  => 'Servicio social',
            'icon'  => 'fa-duotone fa-hands-helping',
            'id'    => 'ssMenu',
            'items' => [
                ['href'=>'users',  'icon'=>'fa-duotone fa-users',            'text'=>'Usuarios'],
                ['href'=>'courses','icon'=>'fad fa-school',                  'text'=>'Ciclo escolar'],
                ['href'=>'degrees','icon'=>'fad fa-graduation-cap',          'text'=>'Licenciaturas'],
                ['href'=>'areas',  'icon'=>'fad fa-ball-pile',               'text'=>'Áreas'],
                ['href'=>'events', 'icon'=>'fad fa-calendar',                'text'=>'Eventos'],
                ['href'=>'students','icon'=>'fad fa-user-graduate',          'text'=>'Estudiantes'],
            ],
        ],
        [
            'type'  => 'dropdown',
            'text'  => 'Prácticas profesionales',
            'icon'  => 'fa-duotone fa-briefcase',
            'id'    => 'ppMenu',
            'items' => [
                ['href'=>'internship_companies','icon'=>'fa-duotone fa-building',     'text'=>'Organismos receptores'],
                ['href'=>'practice_solicitud','icon'=>'fa-duotone fa-file-signature', 'text'=>'Solicitudes de practicas'],
                ['href'=>'internship_students','icon'=>'fa-duotone fa-user-tie',     'text'=>'Estudiantes'],
                ['href'=>'internship_events',  'icon'=>'fa-duotone fa-calendar-days','text'=>'Eventos'],
            ],
        ],
    ],
    'teacher' => [
        [
            'type' => 'link',
            'href' => 'inicio',
            'icon' => 'fa-duotone fa-house',
            'text' => 'Tablero',
        ],
        [
            'type' => 'link',
            'href' => 'students',
            'icon' => 'fad fa-user-graduate',
            'text' => 'Estudiantes',
        ],
    ],
    'student' => [
        [
            'type' => 'link',
            'href' => 'inicio',
            'icon' => 'fa-duotone fa-house',
            'text' => 'Tablero',
        ],
    ],
    'organismo_externo' => [
        [
            'type' => 'link',
            'href' => 'inicio',
            'icon' => 'fa-duotone fa-house',
            'text' => 'Tablero',
        ],
    ],
];

// Helper para marcar activo
function isActive(string $href, string $current): string {
    return $href === $current ? 'active' : '';
}

$items = $menuConfig[$role] ?? [];
?>
<div class="row">
  <aside class="col-2 px-0 sidebar sidebar-collapse pt-2 d-flex flex-column h-100">
    <div class="px-3">
      <a href="./" class="icon-header-logo">
        <img src="view/assets/images/logo-color.png" alt="Logo" class="logo">
      </a>

      <nav class="mt-4">
        <div class="mb-2"><?= htmlspecialchars($roleLabel, ENT_QUOTES, 'UTF-8') ?></div>
        <h6>
          <?php if ($role !== 'organismo_externo'): ?>
            <?= htmlspecialchars($user['firstname'].' '.$user['lastname'], ENT_QUOTES, 'UTF-8') ?>
          <?php else: ?>
            <?= htmlspecialchars($user['empresa'], ENT_QUOTES, 'UTF-8') ?><br>
            <?= htmlspecialchars($user['nombre_contacto'], ENT_QUOTES, 'UTF-8') ?>
          <?php endif; ?>
        </h6>

        <!-- Campos ocultos -->
        <input type="hidden" id="role"  value="<?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?>">
        <?php if ($role === 'student'): ?>
          <input type="hidden" id="idStudent" value="<?= htmlspecialchars($user['idStudent'], ENT_QUOTES, 'UTF-8') ?>">
        <?php elseif ($role !== 'organismo_externo'): ?>
          <input type="hidden" id="idUser"  value="<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') ?>">
          <input type="hidden" id="idArea"  value="<?= htmlspecialchars($user['idArea'], ENT_QUOTES, 'UTF-8') ?>">
        <?php endif; ?>

        <div class="row schools">
          <?php foreach ($items as $item): ?>
            <?php if ($item['type'] === 'link'): ?>
              <a href="<?= $item['href'] ?>"
                 class="mt-3 menu-top py-2 <?= isActive($item['href'], $pagina) ?>">
                <div class="row">
                  <div class="col-2"><i class="<?= $item['icon'] ?>"></i></div>
                  <div class="col-8"><?= $item['text'] ?></div>
                </div>
              </a>
            <?php elseif ($item['type'] === 'dropdown'): ?>
              <div class="dropdown mt-1">
                <button class="btn menu-top dropdown-toggle w-100"
                        id="<?= $item['id'] ?>"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                  <i class="<?= $item['icon'] ?> me-2"></i> <?= $item['text'] ?>
                </button>
                <ul class="dropdown-menu w-100" aria-labelledby="<?= $item['id'] ?>">
                  <?php foreach ($item['items'] as $sub): ?>
                    <li>
                      <a class="dropdown-item <?= isActive($sub['href'], $pagina) ?>"
                         href="<?= $sub['href'] ?>">
                        <i class="<?= $sub['icon'] ?> me-2"></i> <?= $sub['text'] ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </nav>
    </div>

    <footer class="px-3 mt-auto">
      <ul class="navbar-nav w-100">
        <li class="d-grid gap-2">
          <button class="btn-logout mt-3 py-2"
                  onclick="logout('<?= $role === 'organismo_externo' ? 'externo' : '' ?>')">
            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
          </button>
        </li>
      </ul>
    </footer>
  </aside>

  <!-- Espacio para margen -->
  <div class="col-lg-3 col-xl-2"></div>

  <main class="col-12 col-lg-9 col-xl-10 p-4 row">
    <!-- CONTENIDO DE PÁGINA -->
