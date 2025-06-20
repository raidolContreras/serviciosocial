<style>
    body {
        background: #ecf2fe;
    }
</style>

<div class="row gy-4">
    <div class="col-xxl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-2">155+</h4>

                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <!-- icono dentro de círculo de color -->
                        <span
                            class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                            style="width:48px;height:48px;font-size:1.5rem;">
                            <i class="fas fa-user-graduate"></i>
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600">Alumnos (Servicio social interno)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-2">39+</h4>
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <!-- icono dentro de círculo de color -->
                        <span
                            class="d-flex align-items-center justify-content-center rounded-circle bg-success text-white"
                            style="width:48px;height:48px;font-size:1.5rem;">
                            <i class="fas fa-users"></i>
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600">Alumnos (Servicio social externo)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-2">25+</h4>
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <!-- icono dentro de círculo de color -->
                        <span
                            class="d-flex align-items-center justify-content-center rounded-circle bg-warning text-white"
                            style="width:48px;height:48px;font-size:1.5rem;">
                            <i class="fas fa-briefcase"></i>
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600">Alumnos (Practicas profesionales)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-2">18k+</h4>
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <!-- icono dentro de círculo de color -->
                        <span
                            class="d-flex align-items-center justify-content-center rounded-circle bg-danger text-white"
                            style="width:48px;height:48px;font-size:1.5rem;">
                            <i class="fas fa-building"></i>
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600">Organismos externos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card" style="min-height: 180px;">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <h6 class="mb-2">Nuevos Alumnos Servicio social externo</h6>
                    </div>
                    <div>
                        <a href="students" class="btn btn-primary btn-sm float-end">
                            Ver todo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body list-student-service-external">
                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                    <span class="text-gray-600">No hay nuevos alumnos</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card" style="min-height: 180px;">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <h6 class="mb-2">Nuevos Alumnos Practicas Profesionales</h6>
                    </div>
                    <div>
                        <a href="students-Practicas" class="btn btn-primary btn-sm float-end">
                            Ver todo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body list-student-practice-professional">
                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                    <span class="text-gray-600">No hay nuevos alumnos</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card" style="min-height: 180px;">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <h6 class="mb-2">Nuevos Organismos externos</h6>
                    </div>
                    <div>
                        <a href="internship_companies" class="btn btn-primary btn-sm float-end">
                            Ver todo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body list-organism-external">
                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                    <span class="text-gray-600">No hay nuevos organismos</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card" style="min-height: 180px;">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <h6 class="mb-2">Solicitudes de practicantes</h6>
                    </div>
                    <div>
                        <a href="internship_students" class="btn btn-primary btn-sm float-end">
                            Ver todo
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body list-request-practice-professional">
                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                    <span class="text-gray-600">No hay solicitudes</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        // 1. Función genérica para cargar un listado
        function loadList(selector, requestData, renderFn) {
            const $container = $(selector);
            $.ajax({
                url: 'controller/ajax/ajax.forms.php',
                method: 'POST',
                data: requestData,
                dataType: 'json',
            })
                .done(function (data) {
                    if (Array.isArray(data) && data.length) {
                        $container.html(data.map(renderFn).join(''));
                    } else {
                        $container.html(
                            `<div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                        <span class="text-gray-600">${renderFn.noDataText}</span>
                     </div>`
                        );
                    }
                })
                .fail(function () {
                    $container.html(
                        `<div class="text-danger text-center p-3">Error al cargar datos.</div>`
                    );
                });
        }

        // 2. Render functions para cada lista
        function renderServiceStudent(student) {
            return `
            <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                <div>
                    <strong>${student.firstname} ${student.lastname} ${student.lastnameMom}</strong>
                    <div class="small text-muted">
                        ${student.email} | ${student.matricula}
                    </div>
                </div>
                <div>
                    <button class="btn btn-success btn-sm me-2 btn-accept-student-services"
                            data-id="${student.idStudent}">
                        Aceptar
                    </button>
                    <button class="btn btn-danger btn-sm btn-reject-student-services"
                            data-id="${student.idStudent}">
                        Rechazar
                    </button>
                </div>
            </div>
        `;
        }
        renderServiceStudent.noDataText = 'No hay nuevos alumnos';

        // 3. Funciones específicas que llaman a loadList
        function loadServiceStudents() {
            loadList('.list-student-service-external',
                { search: 'student', action: 'noaceptedStudents' },
                renderServiceStudent
            );
        }

        // 4. Inicializamos las listas que queramos al cargar la página
        loadServiceStudents();
        // aquí podrías llamar a loadList(...) para las otras tres tarjetas

        // 5. Event delegation para botones dinámicos
        $('.list-student-service-external')
            .on('click', '.btn-accept-student-services', function () {
                const id = $(this).data('id');
                if (!confirm('¿Está seguro de aceptar a este alumno?')) return;
                $.post('controller/ajax/ajax.forms.php',
                    { search: 'student', action: 'acceptStudent', idStudent: id },
                    function (response) {
                        if (response == 'success') {
                            loadServiceStudents();
                        } else {
                            alert('No se pudo aceptar al alumno.');
                        }
                    }, 'json'
                ).fail(function () {
                    alert('Error al procesar la solicitud.');
                });
            })
            .on('click', '.btn-reject-student-services', function () {
                const id = $(this).data('id');
                if (!confirm('¿Está seguro de rechazar a este alumno?')) return;
                $.post('controller/ajax/ajax.forms.php',
                    { search: 'student', action: 'denegateStudent', idStudent: id },
                    function (response) {
                        if (response == 'success') {
                            loadServiceStudents();
                        } else {
                            alert('No se pudo rechazar al alumno.');
                        }
                    }, 'json'
                ).fail(function () {
                    alert('Error al procesar la solicitud.');
                });
            });
    });
</script>