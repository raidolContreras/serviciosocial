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
        .card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        .card-header {
            background-color: #01643D;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border-bottom: 1px solid #dee2e6;
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

                    <!-- Paso 1: Datos del Alumno -->
                    <div class="step active" id="step-1">
                        <h4 class="mb-4">Paso 1: Datos del Alumno</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="matricula">Matrícula</label>
                                <input type="text" class="form-control" id="matricula" placeholder="202512345" required>
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
                            <div class="form-group col-md-6">
                                <label for="tutor-acad">Tutor Académico</label>
                                <input type="text" class="form-control" id="tutor-acad" placeholder="Nombre del tutor" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email-tutor">Email Tutor</label>
                                <input type="email" class="form-control" id="email-tutor" placeholder="tutor@universidad.edu" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="horas-requeridas">Horas Requeridas</label>
                                <input type="number" class="form-control" id="horas-requeridas" min="1" placeholder="180" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="periodo">Periodo de Prácticas</label>
                                <input type="text" class="form-control" id="periodo" placeholder="Ej. Ene-Jun 2025" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary next-step">Siguiente</button>
                    </div>

                    <!-- Paso 2: Tipo de Prácticas -->
                    <div class="step" id="step-2">
                        <h4 class="mb-4">Paso 2: Tipo de Prácticas</h4>
                        <div class="form-group">
                            <label>Seleccione opción de prácticas *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPractica" id="opcionUniv" value="universidad" required>
                                <label class="form-check-label" for="opcionUniv">
                                    Directamente con la Universidad
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipoPractica" id="opcionEmp" value="empresa">
                                <label class="form-check-label" for="opcionEmp">
                                    Con una Empresa Foránea
                                </label>
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
        $(document).ready(function () {
            let currentStep = 0;
            const steps = $('.step');
            function showStep(index) {
                steps.removeClass('active').eq(index).addClass('active');
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
        });
    </script>
</body>
</html>
