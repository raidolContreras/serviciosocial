<?php
$degrees = FormsController::ctrSearchDegrees(null, );
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"></script>
<!-- Vista para Organismos Externos -->
<div class="card-header">
    <div class="col-12">
        <strong id="namePage">Organismo Externo</strong>
    </div>
</div>
<div class="mt-4">
    <button id="btnSolicitarPract" class="btn btn-primary">
        <i class="fas fa-user-graduate"></i> Solicitar Practicantes Universitarios
    </button>

    <div class="mt-3 solicitudes"></div>
</div>
<!-- Modal de Solicitud -->
<div class="modal fade" id="solicitarPractModal" tabindex="-1" role="dialog" aria-labelledby="solicitarPractLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="solicitarPractLabel">Solicitud de Practicantes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form id="solicitarForm" method="POST">
                <div class="modal-body row g-3">

                    <div class="col-md-6">
                        <label for="licenciatura" class="form-label">Licenciatura Solicitada</label>
                        <select id="licenciatura" name="licenciatura" class="form-select" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($degrees as $degree): ?>
                                <?php if ($degree['minPoints'] == '480'): ?>
                                    <option value="<?php echo $degree['nameDegree']; ?>"><?php echo $degree['nameDegree']; ?>
                                    </option>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="numPract" class="form-label">Número de Practicantes</label>
                        <input type="number" class="form-control" id="numPract" name="numPract" min="1" required>
                    </div>

                    <div class="col-12">
                        <label for="actividades" class="form-label">Actividades que Realizarán</label>
                        <textarea id="actividades" name="actividades" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="apoyoEconomico" class="form-label">¿Ofrece Apoyo Económico?</label>
                        <select id="apoyoEconomico" name="apoyoEconomico" class="form-select" onchange="toggleMonto()"
                            required>
                            <option value="">Selecciona</option>
                            <option value="Sí">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="col-md-6" id="grupoMonto" style="display: none;">
                        <label for="montoApoyo" class="form-label">Monto Mensual Aproximado</label>
                        <input type="text" class="form-control" id="montoApoyo" name="montoApoyo"
                            placeholder="$ 0.00 MXN">
                    </div>

                    <div class="col-md-6">
                        <label for="fechaLimite" class="form-label">Fecha Límite para Incorporación</label>
                        <input type="date" class="form-control" id="fechaLimite" name="fechaLimite" required>
                    </div>

                    <div class="col-md-6">
                        <label for="modalidad" class="form-label">Modalidad</label>
                        <select id="modalidad" name="modalidad" class="form-select" required>
                            <option value="">Selecciona</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Híbrido">Híbrido</option>
                            <option value="Virtual">Virtual</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Horario Propuesto</label>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label>Día Inicio</label>
                                <select class="form-select" id="diaInicio" name="diaInicio" required>
                                    <option value="">Inicio</option>
                                    <option value="L">Lunes</option>
                                    <option value="M">Martes</option>
                                    <option value="X">Miércoles</option>
                                    <option value="J">Jueves</option>
                                    <option value="V">Viernes</option>
                                    <option value="S">Sábado</option>
                                    <option value="D">Domingo</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Día Fin</label>
                                <select class="form-select" id="diaFin" name="diaFin" disabled>
                                    <option value="">Fin</option>
                                    <option value="L">Lunes</option>
                                    <option value="M">Martes</option>
                                    <option value="X">Miércoles</option>
                                    <option value="J">Jueves</option>
                                    <option value="V">Viernes</option>
                                    <option value="S">Sábado</option>
                                    <option value="D">Domingo</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Hora Inicio</label>
                                <select class="form-select" id="horaInicio" name="horaInicio" disabled>
                                    <optgroup label="Mañana">
                                        <option value="07:00">07:00</option>
                                        <option value="07:30">07:30</option>
                                        <option value="08:00">08:00</option>
                                        <option value="08:30">08:30</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                    </optgroup>
                                    <optgroup label="Tarde">
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:30">16:30</option>
                                    </optgroup>
                                    <optgroup label="Noche">
                                        <option value="17:00">17:00</option>
                                        <option value="17:30">17:30</option>
                                        <option value="18:00">18:00</option>
                                        <option value="18:30">18:30</option>
                                        <option value="19:00">19:00</option>
                                        <option value="19:30">19:30</option>
                                        <option value="20:00">20:00</option>
                                        <option value="20:30">20:30</option>
                                        <option value="21:00">21:00</option>
                                    </optgroup>
                                </select>

                            </div>
                            <div class="col-md-3">
                                <label>Hora Fin</label>
                                <select class="form-select" id="horaFin" name="horaFin" disabled>
                                    <optgroup label="Mañana">
                                        <option value="07:00">07:00</option>
                                        <option value="07:30">07:30</option>
                                        <option value="08:00">08:00</option>
                                        <option value="08:30">08:30</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                    </optgroup>
                                    <optgroup label="Tarde">
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:30">16:30</option>
                                    </optgroup>
                                    <optgroup label="Noche">
                                        <option value="17:00">17:00</option>
                                        <option value="17:30">17:30</option>
                                        <option value="18:00">18:00</option>
                                        <option value="18:30">18:30</option>
                                        <option value="19:00">19:00</option>
                                        <option value="19:30">19:30</option>
                                        <option value="20:00">20:00</option>
                                        <option value="20:30">20:30</option>
                                        <option value="21:00">21:00</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="capacidades" class="form-label">Capacidades y Habilidades Deseadas</label>
                        <textarea id="capacidades" name="capacidades" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-5">
                        <label for="direccionPractica" class="form-label">Dirección del Lugar de Prácticas</label>
                        <input type="text" class="form-control" id="direccionPractica" name="direccionPractica"
                            placeholder="Calle, número, colonia, ciudad, estado">
                    </div>

                    <div class="col-md-4">
                        <label for="nombreResponsable" class="form-label">Nombre del Responsable del Área</label>
                        <input type="text" class="form-control" id="nombreResponsable" name="nombreResponsable"
                            required>
                    </div>

                    <div class="col-md-3">
                        <label for="contactoResponsable" class="form-label">Teléfono </label>
                        <input type="text" class="form-control" id="contactoResponsable" name="contactoResponsable"
                            placeholder="+52 123 456 7890" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar Solicitud</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Edición de Solicitud -->
<div class="modal fade" id="editarPractModal" tabindex="-1" role="dialog" aria-labelledby="editarPractLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarPractLabel">Editar Solicitud de Practicantes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form id="editarForm" method="POST">
                <div class="modal-body row g-3">

                    <input type="hidden" id="editarIdSolicitud" name="idSolicitud">

                    <div class="col-md-6">
                        <label for="editarLicenciatura" class="form-label">Licenciatura Solicitada</label>
                        <select id="editarLicenciatura" name="licenciatura" class="form-select" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($degrees as $degree): ?>
                                <?php if ($degree['minPoints'] == '480'): ?>
                                    <option value="<?php echo $degree['nameDegree']; ?>"><?php echo $degree['nameDegree']; ?></option>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="editarNumPract" class="form-label">Número de Practicantes</label>
                        <input type="number" class="form-control" id="editarNumPract" name="numPract" min="1" required>
                    </div>

                    <div class="col-12">
                        <label for="editarActividades" class="form-label">Actividades que Realizarán</label>
                        <textarea id="editarActividades" name="actividades" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="editarApoyoEconomico" class="form-label">¿Ofrece Apoyo Económico?</label>
                        <select id="editarApoyoEconomico" name="apoyoEconomico" class="form-select" onchange="toggleEditarMonto()" required>
                            <option value="">Selecciona</option>
                            <option value="Sí">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="col-md-6" id="editarGrupoMonto" style="display: none;">
                        <label for="editarMontoApoyo" class="form-label">Monto Mensual Aproximado</label>
                        <input type="text" class="form-control" id="editarMontoApoyo" name="montoApoyo" placeholder="$ 0.00 MXN">
                    </div>

                    <div class="col-md-6">
                        <label for="editarFechaLimite" class="form-label">Fecha Límite para Incorporación</label>
                        <input type="date" class="form-control" id="editarFechaLimite" name="fechaLimite" required>
                    </div>

                    <div class="col-md-6">
                        <label for="editarModalidad" class="form-label">Modalidad</label>
                        <select id="editarModalidad" name="modalidad" class="form-select" required>
                            <option value="">Selecciona</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Híbrido">Híbrido</option>
                            <option value="Virtual">Virtual</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Horario Propuesto</label>
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label>Día Inicio</label>
                                <select class="form-select" id="editarDiaInicio" name="diaInicio" required>
                                    <option value="">Inicio</option>
                                    <option value="L">Lunes</option>
                                    <option value="M">Martes</option>
                                    <option value="X">Miércoles</option>
                                    <option value="J">Jueves</option>
                                    <option value="V">Viernes</option>
                                    <option value="S">Sábado</option>
                                    <option value="D">Domingo</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Día Fin</label>
                                <select class="form-select" id="editarDiaFin" name="diaFin">
                                    <option value="">Fin</option>
                                    <option value="L">Lunes</option>
                                    <option value="M">Martes</option>
                                    <option value="X">Miércoles</option>
                                    <option value="J">Jueves</option>
                                    <option value="V">Viernes</option>
                                    <option value="S">Sábado</option>
                                    <option value="D">Domingo</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Hora Inicio</label>
                                <select class="form-select" id="editarHoraInicio" name="horaInicio">
                                    <optgroup label="Mañana">
                                        <option value="07:00">07:00</option>
                                        <option value="07:30">07:30</option>
                                        <option value="08:00">08:00</option>
                                        <option value="08:30">08:30</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                    </optgroup>
                                    <optgroup label="Tarde">
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:30">16:30</option>
                                    </optgroup>
                                    <optgroup label="Noche">
                                        <option value="17:00">17:00</option>
                                        <option value="17:30">17:30</option>
                                        <option value="18:00">18:00</option>
                                        <option value="18:30">18:30</option>
                                        <option value="19:00">19:00</option>
                                        <option value="19:30">19:30</option>
                                        <option value="20:00">20:00</option>
                                        <option value="20:30">20:30</option>
                                        <option value="21:00">21:00</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Hora Fin</label>
                                <select class="form-select" id="editarHoraFin" name="horaFin">
                                    <optgroup label="Mañana">
                                        <option value="07:00">07:00</option>
                                        <option value="07:30">07:30</option>
                                        <option value="08:00">08:00</option>
                                        <option value="08:30">08:30</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                    </optgroup>
                                    <optgroup label="Tarde">
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:30">16:30</option>
                                    </optgroup>
                                    <optgroup label="Noche">
                                        <option value="17:00">17:00</option>
                                        <option value="17:30">17:30</option>
                                        <option value="18:00">18:00</option>
                                        <option value="18:30">18:30</option>
                                        <option value="19:00">19:00</option>
                                        <option value="19:30">19:30</option>
                                        <option value="20:00">20:00</option>
                                        <option value="20:30">20:30</option>
                                        <option value="21:00">21:00</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="editarCapacidades" class="form-label">Capacidades y Habilidades Deseadas</label>
                        <textarea id="editarCapacidades" name="capacidades" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-5">
                        <label for="editarDireccionPractica" class="form-label">Dirección del Lugar de Prácticas</label>
                        <input type="text" class="form-control" id="editarDireccionPractica" name="direccionPractica"
                            placeholder="Calle, número, colonia, ciudad, estado">
                    </div>

                    <div class="col-md-4">
                        <label for="editarNombreResponsable" class="form-label">Nombre del Responsable del Área</label>
                        <input type="text" class="form-control" id="editarNombreResponsable" name="nombreResponsable"
                            required>
                    </div>

                    <div class="col-md-3">
                        <label for="editarContactoResponsable" class="form-label">Teléfono </label>
                        <input type="text" class="form-control" id="editarContactoResponsable" name="contactoResponsable"
                            placeholder="+52 123 456 7890" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function toggleEditarMonto() {
    var select = document.getElementById('editarApoyoEconomico');
    var grupoMonto = document.getElementById('editarGrupoMonto');
    if (select.value === 'Sí') {
        grupoMonto.style.display = 'block';
    } else {
        grupoMonto.style.display = 'none';
        document.getElementById('editarMontoApoyo').value = '';
    }
}
</script>

<script src="view/assets/js/organismo/modalFuncion.js"></script>
<script>
</script>