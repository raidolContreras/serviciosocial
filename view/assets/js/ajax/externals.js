// view/assets/js/externals_complete.js

$(document).ready(function() {
    // 1) Inicializar DataTable
    var table = $('#externalsTable').DataTable({
        ajax: {
            url: 'controller/ajax/externals.php',
            type: 'POST',
            data: { action: 'get_externals' },
            dataType: 'json',
            dataSrc: ''
        },
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: ''
            },
            { 
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            { data: 'empresa', name: 'empresa' },
            { data: 'ciudad',  name: 'ciudad' },
            { data: 'email',   name: 'email' },
            {
                data: 'isActive',
                name: 'estado',
                render: function(value) {
                    return value == 1
                        ? '<span class="badge badge-success">Activo</span>'
                        : '<span class="badge badge-secondary">Inactivo</span>';
                }
            },
            {
                data: null,
                orderable: false,
                render: function(data, type, row) {
                    if (row.isAcepted == 0) {
                        return `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-success accept-external" data-id="${row.id}">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-sm btn-warning reject-external" data-id="${row.id}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                    } else if (row.isAcepted == 1) {
                        return `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary edit-external" data-id="${row.id}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger disable-external" data-id="${row.id}">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        `;
                    } else {
                        return '';
                    }
                }
            }
        ],
        responsive: {
            details: {
                type: 'column',
                target: 'td.dt-control'
            }
        },
        order: [[1, 'asc']],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        }
    });

    function formatDetails(d) {
    return `
    <div class="p-3 bg-light">
      <div class="row">
        <div class="col-md-6">
          <dl class="row mb-2">
            <dt class="col-sm-5">Tipo Persona:</dt>
            <dd class="col-sm-7">${d.tipo_persona}</dd>

            <dt class="col-sm-5">Giro:</dt>
            <dd class="col-sm-7">${d.giro}</dd>

            <dt class="col-sm-5">Fecha Constitución:</dt>
            <dd class="col-sm-7">${d.fecha_constitucion}</dd>

            <dt class="col-sm-5">Web:</dt>
            <dd class="col-sm-7">
              <a href="${d.web}" target="_blank">${d.web}</a>
            </dd>

            <dt class="col-sm-5">Calle:</dt>
            <dd class="col-sm-7">${d.calle}</dd>
          </dl>
        </div>
        <div class="col-md-6">
          <dl class="row mb-2">
            <dt class="col-sm-5">CP:</dt>
            <dd class="col-sm-7">${d.cp}</dd>

            <dt class="col-sm-5">Colonia:</dt>
            <dd class="col-sm-7">${d.colonia}</dd>

            <dt class="col-sm-5">Teléfonos:</dt>
            <dd class="col-sm-7">${d.telefonos}</dd>

            <dt class="col-sm-5">Contacto:</dt>
            <dd class="col-sm-7">${d.nombre_contacto}</dd>

            <dt class="col-sm-5">Celular:</dt>
            <dd class="col-sm-7">${d.celular}</dd>
          </dl>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-6">
          <dl class="row mb-0">
            <dt class="col-sm-5">Rep. Legal:</dt>
            <dd class="col-sm-7">${d.rep_legal}</dd>

            <dt class="col-sm-5">Cargo Legal:</dt>
            <dd class="col-sm-7">${d.cargo_legal}</dd>
          </dl>
        </div>
        <div class="col-md-6">
          <dl class="row mb-0">
            <dt class="col-sm-5">Email Legal:</dt>
            <dd class="col-sm-7">${d.email_legal}</dd>

            <dt class="col-sm-5">Tel. Oficina:</dt>
            <dd class="col-sm-7">${d.tel_oficina}</dd>

            <dt class="col-sm-5">Actividades:</dt>
            <dd class="col-sm-7">${d.actividades}</dd>
          </dl>
        </div>
      </div>
    </div>
    `;
}

    // 3) Toggle detalles
    $('#externalsTable tbody').on('click', 'td.dt-control', function() {
        var tr  = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(formatDetails(row.data())).show();
            tr.addClass('shown');
        }
    });

    // 4) Función genérica de confirmación
    function showConfirmation(message, callback) {
        $('#confirmationModal .modal-body').text(message);
        $('#confirmationModal').modal('show');
        $('#confirmBtn').off('click').on('click', function() {
            $('#confirmationModal').modal('hide');
            callback();
        });
    }

    // 5) Handlers con confirmación para todas las acciones (menos editar)
    $('#externalsTable').on('click', '.accept-external, .reject-external, .disable-external, .delete-external', function(e){
        e.preventDefault();
        var btn    = $(this);
        var id     = btn.data('id');
        var action = btn.hasClass('accept-external') ? 'aceptar'
                   : btn.hasClass('reject-external') ? 'rechazar'
                   : btn.hasClass('disable-external') ? 'inhabilitar'
                   : 'eliminar';
        var message = `¿Estás seguro que deseas ${action} este organismo externo?`;

        showConfirmation(message, function(){
            var url, data;
            if (action === 'aceptar') {
                url  = 'controller/ajax/externals.php';
                data = { action: 'accept_external', id: id };
            } else if (action === 'rechazar') {
                url  = 'controller/ajax/externals.php';
                data = { action: 'reject_external', id: id };
            } else if (action === 'inhabilitar') {
                url  = 'controller/ajax/externals.php';
                data = { action: 'disable_external', id: id };
            } else { // eliminar
                url  = 'ajax/deleteExternal.php';
                data = { id: id };
            }
            $.post(url, data, function(res){
                if (res) {
                    table.ajax.reload(null, false);
                } else {
                    alert('Error: ' + res.error);
                }
            }, 'json');
        });
    });

    // 6) Abrir modal de edición y cargar datos
    $('#externalsTable').on('click', '.edit-external', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.getJSON('controller/ajax/externals.php', { action: 'get_external', id: id }, function(data) {
            $('#editId').val(data.id);
            $('#editEmpresa').val(data.empresa);
            $('#editCiudad').val(data.ciudad);
            $('#editEmail').val(data.email);
            $('#editEstado').val(data.isActive);
            $('#editExternalModal').modal('show');
        });
    });

    // 7) Guardar cambios de edición
    $('#saveEditBtn').on('click', function() {
        var payload = {
            action: 'update_external',
            id: $('#editId').val(),
            empresa: $('#editEmpresa').val(),
            ciudad: $('#editCiudad').val(),
            email: $('#editEmail').val(),
            isActive: $('#editEstado').val()
        };
        $.post('controller/ajax/externals.php', payload, function(res) {
            if (res.success) {
                $('#editExternalModal').modal('hide');
                table.ajax.reload(null, false);
            } else {
                alert('Error al guardar: ' + res.error);
            }
        }, 'json');
    });

});
