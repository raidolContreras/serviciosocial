<div class="container">
    <h2>Estudiantes Registrados</h2>
	<?php if ($_SESSION["user"]['role'] == 'admin'): ?>
    <button class="btn btn-primary mb-3 registerStudentModal">Registrar Estudiante Nuevo</button>
	<?php endif ?>
    <div class="table-responsive">
        <table id="studentsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Licenciatura</th>
                    <th>Pariente</th>
                    <?php if ($_SESSION["user"]['role'] == 'admin'):?>
                        <th>Acciones</th>
                    <?php endif ?>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?php
    include 'view/pages/modals/studentModals.php';
?>
<script src="view/assets/js/ajax/students.js"></script>