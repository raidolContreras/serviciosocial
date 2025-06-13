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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solicitarPractLabel">Solicitud de Practicantes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="controller/ajax/solicitar_practicantes.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="areaPractica">Área de Práctica</label>
                        <input type="text" class="form-control" id="areaPractica" name="areaPractica" required>
                    </div>
                    <div class="form-group">
                        <label for="numPract">Número de Practicantes</label>
                        <input type="number" class="form-control" id="numPract" name="numPract" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnSolicitarPract').addEventListener('click', function () {
        $('#solicitarPractModal').modal('show');
    });
</script>