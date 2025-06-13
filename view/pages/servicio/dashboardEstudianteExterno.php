<!-- Tabla de Organismos Receptores para Estudiantes (no universidad) -->
<div class="row mb-4">
    <div class="col-12">
        <strong id="namePage">Sistema de Servicio Social</strong>
    </div>
</div>

<div class="mt-4">
    <table id="tblOrganismosReceptores" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Organismo Receptor</th>
                <th>Responsable</th>
                <th>Domicilio</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <!-- Se llenará dinámicamente -->
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        let table = $('#tblOrganismosReceptores').DataTable({
            columns: [
                { data: 'idUR', title: 'ID' },
                { data: 'nameUR', title: 'Organismo Receptor' },
                { data: 'responsable', title: 'Responsable' },
                { data: 'domicilio', title: 'Domicilio' },
                {
                    data: null,
                    title: 'Acción',
                    render: function (data, type, row) {
                        return `<button class="btn btn-sm btn-primary select-btn"
                                            data-id="${row.idUR}"
                                            data-name="${row.nameUR}"
                                            data-responsable="${row.responsable}"
                                            data-domicilio="${row.domicilio}">
                                            Seleccionar
                                        </button>`;
                    }
                }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            },
            pageLength: 10,
            lengthChange: false
        });

        function organismosReceptores() {
            $.ajax({
                url: 'controller/ajax/ajax.forms.php',
                type: 'POST',
                data: { search: 'organismos_receptores' },
                dataType: 'json',
                success: function (response) {
                    table.clear().rows.add(response).draw();
                },
                error: function (xhr, status, error) {
                    console.error('Error al obtener organismos:', error);
                }
            });
        }
        organismosReceptores();

        $('#tblOrganismosReceptores tbody').on('click', '.select-btn', function () {
            const id = $(this).data('id');
            const nombre = $(this).data('name');
            const responsable = $(this).data('responsable');
            const domicilio = $(this).data('domicilio');

            if (!confirm(`¿Está seguro de elegir la unidad receptora:\n\n${nombre}?`)) {
                return;
            }

            const $form = $('<form>', {
                action: 'controller/ajax/generarCartaPresentacion.php',
                method: 'POST',
                target: '_blank'
            }).append(
                $('<input>', { type: 'hidden', name: 'idUR', value: id }),
                $('<input>', { type: 'hidden', name: 'nameUR', value: nombre }),
                $('<input>', { type: 'hidden', name: 'responsable', value: responsable }),
                $('<input>', { type: 'hidden', name: 'domicilio', value: domicilio })
            );

            $('body').append($form);
            $form.submit();
            $form.remove();
        });
    });
</script>