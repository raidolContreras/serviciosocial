$(function() {
    // Establecer fecha mínima para registro y edición de eventos
    var minDate = getMinDate();
    setMinDate('#date', minDate);
    setMinDate('#editDate', minDate);

    // Obtener usuarios y áreas encargadas
    getUsers();
    areaEncargada();

    // Inicializar DataTables
    var table = initializeDataTable();
    var tableTypesEvents = initializeDataTableTypesEvents();

    // Manejar el envío del formulario de registro de eventos
    $('#registerEventForm').on('submit', function(event) {
        handleFormSubmission(event, table, 'controller/ajax/ajax.addEvent.php', '#registerEventForm', '#registerEventModal', 'start_time', 'end_time');
    });

    // Manejar el envío del formulario de edición de eventos
    $('#editEventForm').on('submit', function(event) {
        handleFormSubmission(event, table, 'controller/ajax/ajax.updateEvent.php', '#editEventForm', '#editEventModal', 'editStartTime', 'editEndTime');
    });

    // Mostrar modal de registro de eventos
    $('.registerEventModal').on('click', function() {
        $('#registerEventModal').modal('show');
        options();
    });

    // Mostrar modal de registro de tipos de eventos
    $('.registerEventTypeModal').on('click', function() {
        $('#registerEventTypeModal').modal('show');
    });

    // Manejar el envío del formulario de registro de tipos de eventos
    $('#registerEventTypeForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'controller/ajax/ajax.forms.php',
            method: 'POST',
            data: $('#registerEventTypeForm').serialize(),
            success: function(response) {
                $('#eventTypesTable').DataTable().ajax.reload();
            }
        });
    });

    // Manejar el envío del formulario de edición de tipos de eventos
    $('#editEventTypeForm').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'controller/ajax/ajax.forms.php',
            method: 'POST',
            data: $('#editEventTypeForm').serialize(),
            success: function(response) {
                toggleForms();
                $('#eventTypesTable').DataTable().ajax.reload();
            }
        });
    });

    // Actualizar puntos al cambiar el tipo de evento
    $('#eventTypeId, #editEventTypeId').on('change', function() {
        var eventTypeId = $(this).val();
        var pointsField = $(this).attr('id') === 'eventTypeId' ? '#points' : '#editPoints';
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.forms.php',
            data: { search: 'event_types', eventType: eventTypeId },
            dataType: 'json',
            success: function(response) {
                $(pointsField).val(response.pointsPerEvent);
            }
        });
    });
});

function getMinDate() {
    var today = new Date();
    var tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    var dd = String(tomorrow.getDate()).padStart(2, '0');
    var mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
    var yyyy = tomorrow.getFullYear();
    return yyyy + '-' + mm + '-' + dd;
}

function setMinDate(selector, minDate) {
    $(selector).attr('min', minDate);
}

function handleFormSubmission(event, table, url, formSelector, modalSelector, startTimeName, endTimeName) {
    event.preventDefault();
    var form = $(formSelector);
    var startTime = form.find(`[name="${startTimeName}"]`).val();
    var endTime = form.find(`[name="${endTimeName}"]`).val();

    if (startTime >= endTime) {
        alert('La hora de fin debe ser mayor que la hora de inicio y no pueden ser iguales.');
        return false;
    }

    $.ajax({
        url: url,
        method: 'POST',
        data: form.serialize(),
        success: function(response) {
            if (response === 'success') {
                alert('El evento se ha guardado correctamente.');
                form[0].reset();
                $(modalSelector).modal('hide');
                table.ajax.reload();
            } else {
                alert('Hubo un error al guardar el evento.');
            }
        }
    });
}

function initializeDataTable() {
    return $('#eventsTable').DataTable({
        ajax: {
            url: "controller/ajax/ajax.getEvents.php",
            dataSrc: ''
        },
        columns: [
            { "data": null, render: function (data, type, row, meta) { return meta.row + 1; } },
            { "data": "name" },
            { "data": "eventName" },
            { "data": null, render: function (data) { return formatDateTime(data.date + ' ' + data.start_time); } },
            { "data": "location" },
            { "data": "points" },
            { "data": "vacancies_available" },
            {
                // boton para abrir el modal de la description
                "data": null,
                "render": function (data) {
                    return `<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDescriptionModal" onclick="showDescription('${data.description}')">descripción</button>`;
                }
             },
            {
                "data": null,
                "render": function (data) {
                    return `
                        <div class="btn-group btn-block" role="group" aria-label="Acciones">
                            <button type="button" class="btn btn-primary" onclick="editEvent(${data.idEvent})"><i class="fad fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="deleteEvent(${data.idEvent})"><i class="fad fa-trash-alt"></i></button>
                        </div>`;
                }
            }
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });
}

function showDescription(description) {
    $('#descriptionContainer').html(description);
}

function initializeDataTableTypesEvents() {
    return $('#eventTypesTable').DataTable({
        ajax: {
            type: 'POST',
            url: "controller/ajax/ajax.forms.php",
            dataSrc: '',
            data: { search: 'event_types' }
        },
        columns: [
            { "data": "idEventType" },
            { "data": "name" },
            { "data": "nameArea" },
            { "data": "pointsPerEvent" },
            { "data": "benefitsPerYear" },
            {
                "data": null,
                "render": function (data) {
                    return `
                        <div class="btn-group" role="group" aria-label="Acciones">
                            <button type="button" class="btn btn-primary" onclick="editTypeEvent(${data.idEventType}, '${data.name}', ${data.idArea}, ${data.pointsPerEvent}, ${data.benefitsPerYear})"><i class="fad fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="deleteTypeEvent(${data.idEventType})"><i class="fad fa-trash-alt"></i></button>
                        </div>`;
                }
            }
        ],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        }
    });
}

function editEvent(idEvent) {
    $.ajax({
        url: 'controller/ajax/ajax.getEvent.php',
        method: 'POST',
        data: { idEvent: idEvent },
        dataType: 'json',
        success: function(event) {
            options(event.eventTypeId);
            $('#editEventId').val(event.idEvent);
            $('#editEventName').val(event.eventName);
            $('#editDate').val(event.date);
            $('#editLocation').val(event.location);
            $('#editStartTime').val(event.start_time);
            $('#editEndTime').val(event.end_time);
            $('#editPoints').val(event.points);
            $('#editVacanciesAvailable').val(event.vacancies_available);
            
            // Establecer el contenido en CKEditor para la descripción
            if (editEditor) {
                editEditor.setData(event.description);
            }

            $('#editEventModal').modal('show');
        }
    });
}

function deleteEvent(idEvent) {
    if (confirm('¿Estás seguro de que quieres eliminar este evento?')) {
        $.ajax({
            url: 'controller/ajax/ajax.deleteEvent.php',
            method: 'POST',
            data: { idEvent: idEvent },
            success: function(response) {
                if (response === 'success') {
                    alert('El evento ha sido eliminado correctamente.');
                    $('#eventsTable').DataTable().ajax.reload();
                } else {
                    alert('Hubo un error al eliminar el evento.');
                }
            }
        });
    }
}

function options(selectedEventTypeId) {
    $.ajax({
        url: 'controller/ajax/ajax.forms.php',
        dataType: 'json',
        type: 'POST',
        data: { search: 'event_types' },
        success: function(response) {
            var options = '<option value="">Seleccione un tipo de evento</option>';
            response.forEach(function(typeEvent) {
                options += '<option value="' + typeEvent.idEventType + '">' + typeEvent.name + '</option>';
            });
            $('#eventTypeId, #editEventTypeId').html(options);
            if (selectedEventTypeId) {
                $('#editEventTypeId').val(selectedEventTypeId);
            }
        }
    });
}

function areaEncargada() {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.forms.php',
        data: { search: 'areas' },
        dataType: 'json',
        success: function(response) {
            var select = $('#areaEncargada');
            var editSelect = $('#editAreaEncargada');
            select.empty().append('<option value="">Seleccione un área</option>');
            editSelect.empty().append('<option value="">Seleccione un área</option>');
            response.forEach(function(area) {
                select.append(`<option value="${area.idArea}">${area.nameArea}</option>`);
                editSelect.append(`<option value="${area.idArea}">${area.nameArea}</option>`);
            });
        }
    });
}

function deleteTypeEvent(idEventType) {
    if (confirm('¿Estás seguro de que quieres eliminar este tipo de evento?')) {
        $.ajax({
            url: 'controller/ajax/ajax.forms.php',
            method: 'POST',
            data: { 
                search: 'event_types',
                deleteEventType: idEventType 
            },
            success: function(response) {
                $('#eventTypesTable').DataTable().ajax.reload();
            }
        });
    }
}

function editTypeEvent(idEventType, name, idArea, pointsPerEvent, benefitsPerYear) {
    $('#editEventType').val(idEventType);
    $('#editEventTypeName').val(name);
    $('#editAreaEncargada').val(idArea);
    $('#editEventTypePoints').val(pointsPerEvent);
    $('#editEventTypeBenefits').val(benefitsPerYear);
    toggleForms();
}

function toggleForms() {
    $('#registerEventTypeForm, #editEventTypeForm').toggleClass('d-none');
}

function getUsers() {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.forms.php',
        data: { search: 'users' },
        dataType: 'json',
        success: function(response) {
            var select = $('#eventUser');
            select.empty().append('<option value="">Selecciona al encargado</option>');
            response.forEach(function(user) {
                select.append(`<option value="${user.id}">${user.firstname} ${user.lastname}</option>`);
            });
        }
    });
}

function formatDateTime(dateTimeString) {
    const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    const date = new Date(dateTimeString);
    const day = date.getDate();
    const month = months[date.getMonth()];
    const year = date.getFullYear();
    let hours = date.getHours();
    const minutes = date.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12;
    const minutesFormatted = minutes < 10 ? '0' + minutes : minutes;
    return `${day} de ${month} del ${year}, ${hours}:${minutesFormatted} ${ampm}`;
}
