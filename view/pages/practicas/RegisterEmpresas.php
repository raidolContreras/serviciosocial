<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresas</title>
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
            <div class="card-header">
                Registro de Empresa
            </div>
            <div class="card-body">
                <form id="registerCompanyForm">
                    <!-- Paso 1: Información General -->
                    <div class="step active" id="step-1">
                        <h4 class="mb-4">Paso 1: Información General</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="empresa">Nombre de la Empresa</label>
                                <input type="text" class="form-control" id="empresa" placeholder="Tech Solutions S.A." required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rfc">RFC</label>
                                <input type="text" class="form-control" id="rfc" placeholder="TSS850101XYZ" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="giro">Giro</label>
                                <input type="text" class="form-control" id="giro" placeholder="Desarrollo de Software" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="website">Sitio Web</label>
                                <input type="url" class="form-control" id="website" placeholder="https://www.empresa.com">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="num-empleados"># Empleados</label>
                                <input type="number" class="form-control" id="num-empleados" min="1" placeholder="50">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="direccion-org">Dirección</label>
                                <input type="text" class="form-control" id="direccion-org" placeholder="Calle, número, colonia, CP" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary next-step">Siguiente</button>
                    </div>
                    
                    <!-- Paso 2: Contacto y Horario -->
                    <div class="step" id="step-2">
                        <h4 class="mb-4">Paso 2: Contacto y Horario</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="contacto">Supervisor / Contacto</label>
                                <input type="text" class="form-control" id="contacto" placeholder="Ing. María Gómez" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email-org">Email de Contacto</label>
                                <input type="email" class="form-control" id="email-org" placeholder="contacto@empresa.com" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefono-org">Teléfono de Contacto</label>
                                <input type="tel" class="form-control" id="telefono-org" placeholder="(55) 9876 5432" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="horario-org">Horario de Atención</label>
                                <input type="text" class="form-control" id="horario-org" placeholder="Lun-Vie 9:00–18:00">
                            </div>
                            <div class="form-group col-12">
                                <label for="responsabilidades">Notas / Comentarios</label>
                                <textarea class="form-control" id="responsabilidades" rows="3" placeholder="Responsabilidades o comentarios adicionales"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                        <button type="submit" class="btn btn-primary">Registrar Empresa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            let currentStep = 0;
            const steps = $('.step');
            function showStep(index) {
                steps.removeClass('active').eq(index).addClass('active');
            }
            $('.next-step').click(() => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });
            $('.prev-step').click(() => {
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
