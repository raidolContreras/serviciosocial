<?php if ($_SESSION["user"]['role'] === 'admin'): ?>
  <div class="container">
    <h2>Organismos Externos Registrados</h2>

    <div class="table-responsive">
      <table id="externalsTable" class="table table-hover nowrap" style="width:100%">
        <thead>
          <tr>
            <th></th> <!-- columna “+” responsive -->
            <th>#</th>
            <th>Empresa</th>
            <th>Ciudad</th>
            <th>Email</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Confirmar acción</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Estás seguro?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="confirmBtn" class="btn btn-primary">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit External Modal -->
  <div class="modal fade" id="editExternalModal" tabindex="-1" aria-labelledby="editExternalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editExternalModalLabel">Editar Organismo Externo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="editExternalForm">
            <input type="hidden" id="editId" name="id">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="editEmpresa">Empresa</label>
                <input type="text" class="form-control" id="editEmpresa" name="empresa" required>
              </div>
              <div class="form-group col-md-6">
                <label for="editCiudad">Ciudad</label>
                <input type="text" class="form-control" id="editCiudad" name="ciudad" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="editEmail">Email</label>
                <input type="email" class="form-control" id="editEmail" name="email" required>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" id="saveEditBtn" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>

  <script src="view/assets/js/ajax/externals.js"></script>
  <?php
else:
  header("Location: ./");
  exit;
endif; ?>