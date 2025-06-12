<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formulario de registro - Universidad Montrer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
        }
        .card-header {
            background-color: #01643D;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .progress {
            height: 25px;
        }
        .progress-bar {
            background-color: #01643D;
        }
        .file-input {
            margin-bottom: 1rem;
        }
        .required:after {
            content: " *";
            color: #dc3545;
        }
        .invalid-feedback {
            display: none;
        }
        .form-control.is-invalid + .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header text-center">Formulario de registro - Universidad Montrer</div>
        <div class="card-body">
            <!-- Progress bar -->
            <div class="progress mb-4">
                <div class="progress-bar" role="progressbar" style="width: 33%;" id="formProgress">Paso 1 de 3</div>
            </div>

            <form id="evaluationForm" enctype="multipart/form-data" novalidate>
                <!-- Paso 0: Aviso y documentos -->
                <div class="step active" id="step-0">
                    <h5 class="mb-3">Compromisos al llenar este formulario:</h5>
                    <ul>
                        <li>Asignar actividades relevantes para la formación académica del estudiante.</li>
                        <li>Mantener un ambiente seguro y propicio para el aprendizaje.</li>
                        <li>Respetar los horarios acordados con la Universidad Montrer.</li>
                        <li>Facilitar la supervisión adecuada del estudiante.</li>
                    </ul>
                    <div class="form-group mt-4">
                        <label class="font-weight-bold required">Tipo de Persona</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoPersona" id="personaMoral" value="moral" required>
                            <label class="form-check-label" for="personaMoral">Persona Moral</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoPersona" id="personaFisica" value="fisica" required>
                            <label class="form-check-label" for="personaFisica">Persona Física</label>
                        </div>
                        <div class="invalid-feedback">Seleccione el tipo de persona.</div>
                    </div>
                    <div class="document-list mb-3" id="documentosRequeridos"></div>
                    <button type="button" class="btn btn-primary float-right next-step" disabled id="btnNext0">Siguiente</button>
                </div>

                <!-- Paso 1: Información General -->
                <div class="step" id="step-1">
                    <h5 class="mb-3">Información General de la Empresa</h5>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="required">Nombre de la Empresa</label>
                            <input type="text" class="form-control" name="empresa" placeholder="Ej. ACME S.A. de C.V." required>
                            <div class="invalid-feedback">Ingrese el nombre de la empresa.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required">Giro de la Empresa</label>
                            <input type="text" class="form-control" name="giro" placeholder="Ej. Consultoría Educativa" required>
                            <div class="invalid-feedback">Ingrese el giro de la empresa.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Fecha de Constitución</label>
                            <input type="date" class="form-control" name="fecha_constitucion">
                            <small>Opcional</small>
                        </div>
                        <div class="form-group col-md-8">
                            <label>Página Web</label>
                            <input type="url" class="form-control" name="web" placeholder="https://">
                            <small>Incluya el protocolo (http:// o https://)</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label class="required">Calle y Número</label>
                            <input type="text" class="form-control" name="calle" placeholder="Ej. Av. Reforma 123" required>
                            <div class="invalid-feedback">Ingrese la dirección completa.</div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required">Código Postal</label>
                            <input type="text" class="form-control" name="cp" placeholder="Ej. 01234" required pattern="[0-9]{5}">
                            <div class="invalid-feedback">Ingrese un código postal válido de 5 dígitos.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="required">Colonia</label>
                            <input type="text" class="form-control" name="colonia" placeholder="Ej. Centro" required>
                            <div class="invalid-feedback">Ingrese la colonia.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad" placeholder="Ej. Ciudad de México" required>
                            <div class="invalid-feedback">Ingrese la ciudad.</div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                    <button type="button" class="btn btn-primary float-right next-step">Siguiente</button>
                </div>

                <!-- Paso 2: Contacto -->
                <div class="step" id="step-2">
                    <h5 class="mb-3">Información de Contacto</h5>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="required">Teléfono(s) de Contacto</label>
                            <input type="tel" class="form-control" name="telefonos" placeholder="Ej. 55 1234 5678" required>
                            <div class="invalid-feedback">Ingrese al menos un teléfono de contacto.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required">Correo Electrónico</label>
                            <input type="email" class="form-control" name="email" placeholder="ejemplo@dominio.com" required>
                            <div class="invalid-feedback">Ingrese un correo válido.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="required">Nombre del Contacto</label>
                            <input type="text" class="form-control" name="nombre_contacto" placeholder="Ej. Juan Pérez" required>
                            <div class="invalid-feedback">Ingrese el nombre del contacto.</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Celular</label>
                            <input type="tel" class="form-control" name="celular" placeholder="Ej. 55 8765 4321">
                            <small>Opcional</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nombre del Representante Legal</label>
                            <input type="text" class="form-control" name="rep_legal" placeholder="Opcional">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Cargo del Representante Legal</label>
                            <input type="text" class="form-control" name="cargo_legal" placeholder="Opcional">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Correo del Representante Legal</label>
                            <input type="email" class="form-control" name="email_legal" placeholder="Opcional">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Teléfono Oficina</label>
                            <input type="tel" class="form-control" name="tel_oficina" placeholder="Opcional">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required">Actividades Propuestas para Estudiantes</label>
                        <textarea class="form-control" name="actividades" rows="3" placeholder="Describa las actividades" required></textarea>
                        <div class="invalid-feedback">Describa las actividades propuestas.</div>
                    </div>
                    <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                    <button type="submit" class="btn btn-success float-right">Enviar Formulario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(function () {
        let currentStep = 0;
        const steps = $('.step');
        const totalSteps = steps.length;
        const documentos = {
            moral: [
                "Acta Constitutiva (PDF)",
                "Constancia de Situación Fiscal (PDF)",
                "Comprobante de domicilio (Vigencia no mayor a 2 meses)"
            ],
            fisica: [
                "Constancia de Situación Fiscal (PDF)",
                "Comprobante de domicilio (Vigencia no mayor a 2 meses)"
            ]
        };

        function showStep(index) {
            steps.removeClass('active').eq(index).addClass('active');
            const percent = Math.round(((index + 1) / totalSteps) * 100);
            $('#formProgress')
                .css('width', percent + '%')
                .text(`Paso ${index + 1} de ${totalSteps}`);
        }

        function updateDocumentos(tipo) {
            const list = documentos[tipo] || [];
            const container = $('#documentosRequeridos');
            container.empty();
            list.forEach(doc => {
                const key = doc.replace(/[^a-z0-9]/gi, '_').toLowerCase();
                container.append(
                    `<div class="file-input">
                        <label class="required" for="${key}">${doc}</label>
                        <input type="file" class="form-control" name="docs[${key}]" id="${key}" accept=".pdf,.jpg,.png" required>
                        <div class="invalid-feedback">Por favor adjunte ${doc}.</div>
                    </div>`
                );
            });
            $('#btnNext0').prop('disabled', false);
        }

        $('input[name="tipoPersona"]').change(function () {
            updateDocumentos(this.value);
        });

        function validateStep(step) {
            let valid = true;
            const fields = $(`#step-${step}`).find('input, select, textarea');
            fields.each(function () {
                if (!this.checkValidity()) {
                    $(this).addClass('is-invalid');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            return valid;
        }

        $('.next-step').click(function () {
            if (!validateStep(currentStep)) {
                return;
            }
            if (currentStep < totalSteps - 1) {
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

        $('#evaluationForm').on('submit', function (e) {
            if (!validateStep(currentStep)) {
                e.preventDefault();
                return;
            }
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            $.ajax({
                url: 'controller/ajax/ajax.registroOrganismos.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('¡Formulario enviado correctamente! Revisaremos la información proporcionada y se le notificará el resultado vía correo electrónico.');
                        form.reset();
                        currentStep = 0;
                        showStep(currentStep);
                        $('#btnNext0').prop('disabled', true);
                        $('#documentosRequeridos').empty();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Ocurrió un error al enviar el formulario.');
                }
            });
        });

        showStep(currentStep);
    });
</script>
</body>
</html>
