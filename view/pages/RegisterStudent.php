<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Estudiante</title>
    <!-- Bootstrap 5 y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #01643D;
            --primary-dark: #1B4434;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 3rem auto;
        }

        .card {
            border-radius: .75rem;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
        }

        .card-header {
            background: var(--primary);
            color: #fff;
            border-radius: .75rem .75rem 0 0;
            font-size: 1.5rem;
            text-align: center;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1080;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="text-center mb-4">
            <img src="view/assets/images/logo-color.png" alt="Logo de Unimo" class="img-fluid" style="max-width: 10rem;">
        </div>

        <div class="card">
            <div class="card-header">Registro de Estudiantes para Servicio Social Universitario</div>
            <div class="card-body">
                <form id="registerStudentForm" class="needs-validation" novalidate>
                    <!-- Paso 1 -->
                    <div class="step" data-step="0">
                        <h5>Paso 1: Información Personal</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6 position-relative">
                                <label for="matricula" class="form-label">
                                    Matrícula *
                                    <i class="fas fa-question-circle text-muted" data-bs-toggle="tooltip" title="Ingresa tu matrícula de estudiante"></i>
                                </label>
                                <input type="text" class="form-control" id="matricula" name="matricula" required pattern="\d+">
                                <div class="invalid-feedback">La matrícula debe contener solo números.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                <div class="invalid-feedback">Este campo es obligatorio.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidoPaterno" class="form-label">Apellido paterno *</label>
                                <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required>
                                <div class="invalid-feedback">Este campo es obligatorio.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidoMaterno" class="form-label">Apellido materno</label>
                                <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno">
                            </div>
                            <div class="col-md-3">
                                <label for="diaNacimiento" class="form-label">Día *</label>
                                <input type="number" class="form-control" id="diaNacimiento" name="diaNacimiento" min="1" max="31" required>
                                <div class="invalid-feedback">Ingresa un día válido.</div>
                            </div>
                            <div class="col-md-3">
                                <label for="mesNacimiento" class="form-label">Mes *</label>
                                <input type="number" class="form-control" id="mesNacimiento" name="mesNacimiento" min="1" max="12" required>
                                <div class="invalid-feedback">Ingresa un mes válido.</div>
                            </div>
                            <div class="col-md-3">
                                <label for="anioNacimiento" class="form-label">Año *</label>
                                <select class="form-select" id="anioNacimiento" name="anioNacimiento" required>
                                    <option value="" selected disabled>Seleccione un año</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un año.</div>
                            </div>
                            <div class="col-md-3">
                                <label for="genero" class="form-label">Género *</label>
                                <select class="form-select" id="genero" name="genero" required>
                                    <option value="" selected disabled>Selecciona</option>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                    <option value="0">Otro</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un género.</div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary next-btn">Siguiente</button>
                    </div>

                    <!-- Paso 2 -->
                    <div class="step d-none" data-step="1">
                        <h5>Paso 2: Datos Académicos y Contacto</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="licenciatura" class="form-label">Licenciatura *</label>
                                <select class="form-select" id="licenciatura" name="licenciatura" required>
                                    <option value="" selected>Seleccione licenciatura</option>
                                </select>
                                <div class="invalid-feedback">Selecciona una licenciatura.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="tipoLicenciatura" class="form-label">Tipo *</label>
                                <select class="form-select" id="tipoLicenciatura" name="tipoLicenciatura" required>
                                    <option value="" selected disabled>Selecciona</option>
                                    <option value="semestral">Semestral</option>
                                    <option value="cuatrimestral">Cuatrimestral</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un tipo.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="grado" class="form-label">Grado *</label>
                                <input type="number" class="form-control" id="grado" name="grado" required>
                                <div class="invalid-feedback">Ingresa tu grado.</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="correoInstitucional" class="form-label">
                                    Correo Institucional *
                                    <i class="fas fa-question-circle text-muted" data-bs-toggle="tooltip" title="Debe ser @unimontrer.edu.mx"></i>
                                </label>
                                <input type="email" class="form-control" id="correoInstitucional" name="correoInstitucional" required>
                                <div class="invalid-feedback">El correo debe ser @unimontrer.edu.mx.</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="telefonoContacto" class="form-label">
                                    Celular *
                                    <i class="fas fa-question-circle text-muted" data-bs-toggle="tooltip" title="10 dígitos"></i>
                                </label>
                                <input type="tel" class="form-control" id="telefonoContacto" name="telefonoContacto" required pattern="\d{10}">
                                <div class="invalid-feedback">Debe contener 10 dígitos.</div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="telefonoEmergencia" class="form-label">
                                    Emergencia *
                                    <i class="fas fa-question-circle text-muted" data-bs-toggle="tooltip" title="10 dígitos"></i>
                                </label>
                                <input type="tel" class="form-control" id="telefonoEmergencia" name="telefonoEmergencia" required pattern="\d{10}">
                                <div class="invalid-feedback">Debe contener 10 dígitos.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="parentesco" class="form-label">Parentesco *</label>
                                <select class="form-select" id="parentesco" name="parentesco" required>
                                    <option value="" selected disabled>Selecciona</option>
                                    <option value="Padre">Padre</option>
                                    <option value="Madre">Madre</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un parentesco.</div>
                            </div>
                            <div class="col-md-6 d-none" id="parentescoEspecificar">
                                <label for="otroParentesco" class="form-label">Especificar *</label>
                                <input type="text" class="form-control" id="otroParentesco" name="otroParentesco">
                                <div class="invalid-feedback">Especifica el parentesco.</div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary prev-btn">Anterior</button>
                        <button type="button" class="btn btn-primary next-btn">Siguiente</button>
                    </div>

                    <!-- Paso 3 -->
                    <div class="step d-none" data-step="2">
                        <h5>Paso 3: Dirección</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="calle" class="form-label">Calle *</label>
                                <input type="text" class="form-control" id="calle" name="calle" required>
                                <div class="invalid-feedback">Ingresa tu calle.</div>
                            </div>
                            <div class="col-md-3">
                                <label for="numeroExterior" class="form-label">Ext. *</label>
                                <input type="text" class="form-control" id="numeroExterior" name="numeroExterior" required>
                                <div class="invalid-feedback">Ingresa el número exterior.</div>
                            </div>
                            <div class="col-md-3">
                                <label for="numeroInterior" class="form-label">Int.</label>
                                <input type="text" class="form-control" id="numeroInterior" name="numeroInterior">
                            </div>
                            <div class="col-md-6">
                                <label for="colonia" class="form-label">Colonia *</label>
                                <input type="text" class="form-control" id="colonia" name="colonia" required>
                                <div class="invalid-feedback">Ingresa tu colonia.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="codigoPostal" class="form-label">CP *</label>
                                <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" required>
                                <div class="invalid-feedback">Ingresa el código postal.</div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary prev-btn">Anterior</button>
                        <button type="button" class="btn btn-primary next-btn">Siguiente</button>
                    </div>

                    <!-- Paso 4 -->
                    <div class="step d-none" data-step="3">
                        <h5>Paso 4: Elige la modalidad para realizar tu servicio social</h5>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPractica" id="opcionUniv" value="universidad" required>
                                <label class="form-check-label" for="opcionUniv">A través de la Universidad (proyectos institucionales, eventos, etc.)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPractica" id="opcionEmp" value="empresa">
                                <label class="form-check-label" for="opcionEmp">Unidad productiva (empresa, institución, organización, etc.)</label>
                            </div>
                            <div class="invalid-feedback">Selecciona una opción.</div>
                        </div>
                        <button type="button" class="btn btn-secondary prev-btn">Anterior</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toasts -->
    <div class="toast-container">
        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">¡Éxito! Datos registrados.</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
        <div id="duplicateToast" class="toast align-items-center text-bg-warning border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">¡Atención! Alumno ya registrado.</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
        <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">Ocurrió un error. Intenta de nuevo.</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle (Popper incluido) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module">
        // Inicializaciones
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el =>
            new bootstrap.Tooltip(el)
        );

        // Rellenar años
        const yearSel = document.getElementById('anioNacimiento');
        for (let y = new Date().getFullYear(); y >= 1970; y--) {
            yearSel.add(new Option(y, y));
        }

        // Cargar licenciaturas
        async function loadDegrees() {
            try {
                const res = await fetch('controller/ajax/ajax.forms.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        search: 'degrees'
                    })
                });
                const data = await res.json();
                const sel = document.getElementById('licenciatura');
                sel.innerHTML = '<option value="">Seleccione licenciatura</option>' +
                    data.map(d => `<option value="${d.idDegree}">${d.nameDegree}</option>`).join('');
            } catch {}
        }
        loadDegrees();

        // Pasos
        const steps = [...document.querySelectorAll('.step')];
        let current = 0;
        const show = i => steps.forEach((s, idx) => s.classList.toggle('d-none', idx !== i));
        document.querySelectorAll('.next-btn').forEach(b =>
            b.addEventListener('click', () => {
                if (validateStep(current)) show(++current);
            })
        );
        document.querySelectorAll('.prev-btn').forEach(b =>
            b.addEventListener('click', () => show(--current))
        );
        show(0);

        function validateStep(i) {
            const elems = [...steps[i].querySelectorAll('input,select')];
            let ok = true;
            elems.forEach(f => {
                if (!f.checkValidity()) {
                    f.classList.add('is-invalid');
                    ok = false;
                } else f.classList.remove('is-invalid');
            });
            return ok;
        }

        // Toast helper
        function toast(id) {
            new bootstrap.Toast(document.getElementById(id), {
                delay: 3000
            }).show();
        }

        // Debounce
        const debounce = (fn, ms = 500) => {
            let t;
            return (...a) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...a), ms);
            };
        };

        // Autocompletar al buscar matrícula
        const matInput = document.getElementById('matricula');
        matInput.addEventListener('input', debounce(async () => {
            const val = matInput.value.trim();
            if (!/^\d+$/.test(val)) return matInput.classList.add('is-invalid');
            try {
                const res = await fetch('controller/ajax/ajax.forms.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        action: 'checkMatricula',
                        matricula: val
                    })
                });
                const data = await res.json();
                if (data.id) {
                    // Campos personales
                    document.getElementById('nombre').value = data.nombre;
                    document.getElementById('apellidoPaterno').value = data.apellido1;
                    document.getElementById('apellidoMaterno').value = data.apellido2;
                    // Género ('F'->2, 'M'->1, otro->0)
                    document.getElementById('genero').value =
                        data.genero === 'F' ? 2 : data.genero === 'M' ? 1 : 0;
                    // Fecha de nacimiento
                    const [year, month, day] = data.fechaNacimiento.split(' ')[0].split('-');
                    yearSel.value = year;
                    document.getElementById('mesNacimiento').value = month;
                    document.getElementById('diaNacimiento').value = day;
                    // Dirección
                    document.getElementById('calle').value = data.direcionCasa;
                    document.getElementById('codigoPostal').value = data.cpCasa;
                    document.getElementById('numeroExterior').value = data.numCasa;
                    // Teléfonos (quitamos espacios)
                    document.getElementById('telefonoContacto').value = (data.telefono || '').replace(/\s+/g, '');
                    document.getElementById('telefonoEmergencia').value = (data.celular || '').replace(/\s+/g, '');

                    // --- Nueva parte: seleccionar licenciatura por texto ---
                    const degSel = document.getElementById('licenciatura');
                    // buscamos la opción cuyo textContent coincida con nameOferta (case-insensitive)
                    const matchOpt = Array.from(degSel.options)
                        .find(opt => opt.textContent.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/ñ/g, "n").replace(/Ñ/g, "N").trim().toUpperCase() === 
                                     data.nameOferta.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/ñ/g, "n").replace(/Ñ/g, "N").trim().toUpperCase());
                    if (matchOpt) {
                        degSel.value = matchOpt.value;
                    }
                    const nombre_periodo = data.nombre_periodo.toLowerCase();
                    // Seleccionar tipo de licenciatura
                    const tipoLicSel = document.getElementById('tipoLicenciatura');
                    if (nombre_periodo.includes('cuatrimestre')) {
                        tipoLicSel.value = 'cuatrimestral';
                    } else if (nombre_periodo.includes('semestre')) {
                        tipoLicSel.value = 'semestral';
                    } else {
                        tipoLicSel.value = '';
                    }
                    const correoInstitucional = data.matricula + '@unimontrer.edu.mx';
                    document.getElementById('correoInstitucional').value = correoInstitucional;

                    const Familiar_Telefono = (data.Familiar_Telefono || '').replace(/\D/g, '').slice(-10);
                    // Teléfono de emergencia (Familiar_Telefono)
                    document.getElementById('telefonoEmergencia').value = Familiar_Telefono;

                    const TipoFamiliar = data.TipoFamiliar || '';
                    // Parentesco
                    const parentescoSel = document.getElementById('parentesco');
                    parentescoSel.value = TipoFamiliar === 'Padre' ? 'Padre' :
                        TipoFamiliar === 'Madre' ? 'Madre' : 'Otro';

                    // ------------------------------------------------------

                    // marcamos matrícula válida
                    matInput.classList.remove('is-invalid');
                    matInput.classList.add('is-valid');
                } else {
                    matInput.classList.add('is-invalid');
                }
            } catch {
                matInput.classList.add('is-invalid');
            }
        }, 1000));


        // Mostrar/ocultar "otro parentesco"
        document.getElementById('parentesco').addEventListener('change', e => {
            const div = document.getElementById('parentescoEspecificar');
            const inp = document.getElementById('otroParentesco');
            if (e.target.value === 'Otro') {
                div.classList.remove('d-none');
                inp.required = true;
            } else {
                div.classList.add('d-none');
                inp.required = false;
            }
        });

        // Envío
        document.getElementById('registerStudentForm').addEventListener('submit', async e => {
            e.preventDefault();
            const form = e.target;
            if (!form.checkValidity()) return;
            const data = new FormData(form);
            data.append('search', 'student');
            data.append('action', 'addStudent');
            try {
                const res = await fetch('controller/ajax/ajax.forms.php', {
                    method: 'POST',
                    body: data
                });
                const txt = await res.text();
                if (txt.includes('success')) toast('successToast');
                else if (txt.includes('duplicate')) toast('duplicateToast');
                else toast('errorToast');
            } catch {
                toast('errorToast');
            }
        });
    </script>
</body>

</html>