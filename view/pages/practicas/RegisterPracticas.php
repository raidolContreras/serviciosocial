<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Prácticas Profesionales</title>
    <!-- Bootstrap y FontAwesome -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 15px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #dee2e6;
        }
        .card-header {
            background-color: #01643D;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            padding: 20px;
        }
        .card-body {
            padding: 30px;
            background-color: white;
        }
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .is-invalid { border-color: #dc3545 !important; }
        .is-valid   { border-color: #28a745 !important; }
        .btn-primary:hover {
            background-color: #1b4434;
            border-color: #01643D;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Registro de Prácticas Profesionales</div>
            <div class="card-body">
                <form id="registerForm">

                    <!-- Paso 1: Información del Alumno -->
                    <div class="step active" id="step-1">
                        <h4 class="mb-4">Paso 1: Información del Alumno</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="matricula">Matrícula</label>
                                <input type="text" class="form-control" id="matricula" placeholder="00000" required>
                                <div class="invalid-feedback">Matrícula no encontrada o inválida.</div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre completo</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Juan Pérez López" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="curp">CURP</label>
                                <input type="text" class="form-control" id="curp" placeholder="LLLL000101HDFABC01" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nacimiento">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="nacimiento" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="genero">Género</label>
                                <select id="genero" class="form-control" required>
                                    <option value="">Selecciona...</option>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                    <option>Otro</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email-alumno">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email-alumno" placeholder="ejemplo@dominio.com" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefono-alumno">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono-alumno" placeholder="(55) 1234 5678" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="direccion-alumno">Dirección</label>
                                <input type="text" class="form-control" id="direccion-alumno" placeholder="Calle, número, colonia, CP" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary next-step">Siguiente</button>
                    </div>

                    <!-- Paso 2: Grado Académico -->
                    <div class="step" id="step-2">
                        <h4 class="mb-4">Paso 2: Grado Académico</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="programa">Programa Académico</label>
                                <select id="programa" class="form-control" required>
                                    <option value="">Selecciona...</option>
                                    <option>Ingeniería en Sistemas</option>
                                    <option>Administración</option>
                                    <option>Otra</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="semestre">Semestre</label>
                                <input type="text" class="form-control" id="semestre" placeholder="6°" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tutor-acad">Tutor Académico</label>
                                <input type="text" class="form-control" id="tutor-acad" placeholder="Nombre del tutor" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email-tutor">Email Tutor</label>
                                <input type="email" class="form-control" id="email-tutor" placeholder="tutor@universidad.edu" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                        <button type="button" class="btn btn-primary next-step">Siguiente</button>
                    </div>

                    <!-- Paso 3: Tipo de Prácticas -->
                    <div class="step" id="step-3">
                        <h4 class="mb-4">Paso 3: Tipo de Prácticas</h4>
                        <div class="form-group">
                            <label>Seleccione opción de prácticas *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPractica" id="opcionUniv" value="universidad" required>
                                <label class="form-check-label" for="opcionUniv">Directamente con la Universidad</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPractica" id="opcionEmp" value="empresa">
                                <label class="form-check-label" for="opcionEmp">Con una Empresa Foránea</label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                        <button type="submit" class="btn btn-primary">Registrar Alumno</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    // Función debounce genérica
    function debounce(fn, delay) {
      let timer;
      return function(...args) {
        clearTimeout(timer);
        timer = setTimeout(() => fn.apply(this, args), delay);
      };
    }

    $(function () {
      // Wizard de pasos (igual que antes)
      let currentStep = 0;
      const steps = $('.step');
      function showStep(i) {
        steps.removeClass('active').eq(i).addClass('active');
      }
      $('.next-step').click(function () {
        if (currentStep < steps.length - 1) {
          currentStep++;
          showStep(currentStep);
        }
      });
      $('.prev-step').click(function () {
        if (currentStep > 0) {
          currentStep--;
          showStep(currentStep);
        }
      });
      showStep(currentStep);

      // Mapa de códigos de género
      const genderMap = { 'F': 'Femenino', 'M': 'Masculino', 'O': 'Otro' };

      // Autocompletar al buscar matrícula
      const matInput = document.getElementById('matricula');
      matInput.addEventListener('input', debounce(async function () {
        const val = this.value.trim();
        if (!/^\d+$/.test(val)) {
          this.classList.add('is-invalid');
          this.classList.remove('is-valid');
          return;
        }
        try {
          const res = await fetch('controller/ajax/ajax.forms.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
              action: 'checkMatricula',
              matricula: val
            })
          });
          const data = await res.json();
          if (data.id) {
            // matrícula válida
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');

            // 1) Nombre completo
            $('#nombre').val(`${data.nombre} ${data.apellido1} ${data.apellido2}`);

            // 2) CURP
            $('#curp').val(data.claveCiudadano);

            // 3) Fecha de nacimiento (solo YYYY-MM-DD)
            $('#nacimiento').val(data.fechaNacimiento.split(' ')[0]);

            // 4) Género (mapeado)
            $('#genero').val(genderMap[data.genero] || '');

            // 5) Contacto
            $('#email-alumno').val(data.email);
            $('#telefono-alumno').val(data.telefono);
            
            // 6) Dirección
            const dir = data.direcionCasa || '';
            const num = data.numCasa || '';
            const cp  = data.cpCasa || '';
            $('#direccion-alumno').val(`${dir} #${num}, CP ${cp}`);

            // 7) Programa Académico
            const prog = data.nameOferta || '';
            if (prog) {
              if (!$('#programa option[value="'+prog+'"]').length) {
                $('#programa').append(new Option(prog, prog));
              }
              $('#programa').val(prog);
            }

            // 8) Semestre (avance)
            if (data.avance) {
              $('#semestre').val(data.avance + '°');
            }

            // NOTA: los campos "Tutor Académico" y "Email Tutor" no están en el JSON,
            // así que se mantienen para que el usuario los llene manualmente.
          } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
          }
        } catch (err) {
          this.classList.add('is-invalid');
          this.classList.remove('is-valid');
        }
      }, 800));
    });
  </script>
</body>
</html>
