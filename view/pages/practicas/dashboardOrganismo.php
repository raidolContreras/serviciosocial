<?php
$degrees = FormsController::ctrSearchDegrees(null, );
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js"></script>
<!-- Vista para Organismos Externos -->
<div class="row mb-4">
    <div class="col-12">
        <strong id="namePage">Organismo Externo</strong>
    </div>
</div>
<div class="mt-4">
    <button id="btnSolicitarPract" class="btn btn-primary">
        <i class="fas fa-user-graduate"></i> Solicitar Practicantes Universitarios
    </button>
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
            <form id="solicitarForm" action="controller/ajax/solicitar_practicantes.php" method="POST">
                <div class="modal-body row g-3">

                    <div class="col-md-6">
                        <label for="licenciatura" class="form-label">Licenciatura Solicitada</label>
                        <select id="licenciatura" name="licenciatura" class="form-select" required>
                            <option value="">Selecciona una opción</option>
                            <?php foreach ($degrees as $degree): ?>
                                <?php if ($degree['minPoints'] == '480'):?>
                                    <option value="<?php echo $degree['idDegree']; ?>"><?php echo $degree['nameDegree']; ?></option>
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
                                <select class="form-select" id="diaInicio">
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
                                <select class="form-select" id="diaFin" disabled>
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
                                <select class="form-select" id="horaInicio" disabled>
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
                                <select class="form-select" id="horaFin" disabled>
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

<script>
document.addEventListener('DOMContentLoaded', bindPhoneFormatter);

function bindPhoneFormatter() {
    const inputs = [
        document.getElementById("contactoResponsable")
    ];
    inputs.forEach(input => {
        if (!input) return;
        input.addEventListener("input", function () {
            // 1) Sólo dígitos, máximo 14
            let v = this.value.replace(/\D/g, "").slice(0, 12);

            // 2) Si es internacional (>10 dígitos)
            if (v.length > 10) {
                // longitud del código de país = total - 10
                const ccLen = v.length - 10;
                const cc     = v.slice(0, ccLen);
                const p1     = v.slice(ccLen, ccLen + 3);
                const p2     = v.slice(ccLen + 3, ccLen + 6);
                const p3     = v.slice(ccLen + 6);
                // +CC… CCC-CCC-CCCC
                this.value = `+${cc} ${p1}-${p2}-${p3}`.trim();
            }
            // 3) Nacional (hasta 10 dígitos)
            else if (v.length > 6) {
                // 3-3-4
                this.value = v.replace(/(\d{3})(\d{3})(\d{1,4})/, "$1-$2-$3");
            } else if (v.length > 3) {
                // 3-rest
                this.value = v.replace(/(\d{3})(\d{1,3})/, "$1-$2");
            } else {
                // menos de 4 dígitos, sin formato
                this.value = v;
            }
        });
    });
}
</script>


<script>
    /**
     * Maneja la lógica de selección de días y horas para el horario propuesto.
     * – Día Inicio  → habilita Día Fin
     * – Día Fin     → habilita Hora Inicio
     * – Hora Inicio → habilita Hora Fin (sólo horas posteriores)
     */
    function armarHorario(e) {
        // Referencias
        const $diaInicio = $('#diaInicio');
        const $diaFin = $('#diaFin');
        const $horaInicio = $('#horaInicio');
        const $horaFin = $('#horaFin');

        // Valores actuales
        const diaInicioVal = $diaInicio.val();
        const diaFinVal = $diaFin.val();
        const horaInicioVal = $horaInicio.val();

        /* --- 1. Reset en cascada ------------------------------------ */
        const changed = e?.target?.id || null;      // quién disparó el cambio

        if (changed === 'diaInicio') {              // cambió el día de inicio
            $diaFin.val('');
            $horaInicio.val('');
            $horaFin.val('');
        }
        if (changed === 'diaFin') {                 // cambió el día de fin
            $horaInicio.val('');
            $horaFin.val('');
        }
        if (changed === 'horaInicio') {             // cambió la hora de inicio
            $horaFin.val('');
        }

        /* --- 2. Habilitar / deshabilitar ---------------------------- */
        $diaFin.prop('disabled', !diaInicioVal);               // sólo día fin
        $horaInicio.prop('disabled', !diaFinVal);              // sólo hora inicio
        $horaFin.prop('disabled', !(diaFinVal && horaInicioVal)); // hora fin

        /* --- 3. Filtrar opciones de Día Fin ------------------------- */
        $diaFin.find('option').show();                         // mostrar todo
        if (diaInicioVal) {
            const diasOrden = ['', 'L', 'M', 'X', 'J', 'V', 'S', 'D']; // '' para la opción vacía
            const idxInicio = diasOrden.indexOf(diaInicioVal);
            $diaFin.find('option').each(function () {
                const idx = diasOrden.indexOf(this.value);
                if (idx !== 0 && idx <= idxInicio) $(this).hide();
            });
        }

        /* --- 4. Filtrar opciones de Hora Fin ------------------------ */
        $horaFin.find('option').each(function () {
            if (!this.value) { $(this).prop('disabled', false).show(); return; }
            if (horaInicioVal && this.value <= horaInicioVal) {
                $(this).prop('disabled', true).hide();         // anteriores o iguales → fuera
            } else {
                $(this).prop('disabled', false).show();
            }
        });
    }

    /* Asignar listeners (una sola vez) */
    ['#diaInicio', '#diaFin', '#horaInicio', '#horaFin'].forEach(sel => {
        $(document).on('change', sel, armarHorario);
    });
</script>


<script>
    // Mostrar/ocultar campo de monto
    function toggleMonto() {
        const apoyo = document.getElementById('apoyoEconomico').value;
        const grupoMonto = document.getElementById('grupoMonto');
        const montoInput = document.getElementById('montoApoyo');
        grupoMonto.style.display = (apoyo === 'Sí') ? 'block' : 'none';
        if (apoyo !== 'Sí') montoInput.value = '';
    }

    // Aplicar máscara al escribir
    document.addEventListener('DOMContentLoaded', function () {
        const montoInput = document.getElementById('montoApoyo');

        montoInput.addEventListener('input', function (e) {
            let val = e.target.value.replace(/\D/g, '');
            if (val === '') {
                e.target.value = '';
                return;
            }

            let num = parseFloat(val) / 100;
            let formatted = num.toLocaleString('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            });

            e.target.value = formatted;
        });

        // Opcional: al copiar/pegar o dejar el campo
        montoInput.addEventListener('blur', function (e) {
            if (!e.target.value) return;
            let val = e.target.value.replace(/\D/g, '');
            let num = parseFloat(val) / 100;
            e.target.value = num.toLocaleString('es-MX', {
                style: 'currency',
                currency: 'MXN',
                minimumFractionDigits: 2
            });
        });
    });

    document.getElementById('btnSolicitarPract').addEventListener('click', function () {
        $('#solicitarPractModal').modal('show');
    });
</script>