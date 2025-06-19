<!-- CSS -->
<style>
	.floating-btn {
		position: fixed;
		bottom: 20px;
		right: 20px;
		width: 48px;
		height: 48px;
		background: #e9de10;
		color: #333;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		cursor: pointer;
		transition: transform 0.2s, background 0.2s;
		z-index: 1000;
	}

	.floating-btn:hover {
		background: #ffdd57;
		transform: translateY(-2px);
	}

	.floating-btn .badge {
		position: absolute;
		top: 4px;
		right: 4px;
		background: #dc3545;
		color: #fff;
		border-radius: 50%;
		width: 20px;
		height: 20px;
		font-size: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.dropdown-list {
		position: fixed;
		bottom: 80px;
		right: 20px;
		width: 280px;
		max-height: 320px;
		background: #fff;
		border-radius: 8px;
		box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
		overflow-y: auto;
		display: none;
		z-index: 999;
	}

	.dropdown-list.show {
		display: block;
	}

	.dropdown-list ul {
		list-style: none;
		margin: 0;
		padding: 0;
	}

	.dropdown-list li {
		padding: 10px 12px;
		border-bottom: 1px solid #f0f0f0;
	}

	.dropdown-list li:last-child {
		border-bottom: none;
	}

	.dropdown-list .time {
		display: block;
		font-size: 12px;
		color: #888;
		margin-top: 4px;
	}
</style>

<!-- HTML -->
<a href="#" class="floating-btn">
	<i class="far fa-bell fa-lg"></i>
	<span class="badge"></span>
</a>
<div class="dropdown-list">
	<ul>
	</ul>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn       = document.querySelector('.floating-btn');
    const dropdown  = document.querySelector('.dropdown-list');
    const list      = document.querySelector('.dropdown-list ul');
    const badge     = document.querySelector('.floating-btn .badge');

    // Mostrar/ocultar dropdown al click en la campana
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.classList.toggle('show');
    });
    document.addEventListener('click', function () {
        dropdown.classList.remove('show');
    });

    // Delegación de eventos en la lista
    list.addEventListener('click', function (e) {
        // 1) Click en el enlace de la notificación
        const link = e.target.closest('.notif-link');
        if (link) {
            e.preventDefault();
            const li = link.closest('li');
            const id = li.dataset.id;
            // Marca como leída
            $.post('controller/notifications.php', { action: 'markAsRead', id }, function (resp) {
                if (resp.success) {
                    li.classList.remove('unread');
                    // Actualiza badge (asumiendo que contenga texto numérico)
                    const cnt = Math.max(0, parseInt(badge.textContent||0,10) - 1);
                    badge.textContent = cnt;
                    badge.style.display = cnt ? 'flex' : 'none';
                }
                // Navega al destino
                window.location = link.href;
            }, 'json');
            return;
        }

        // 2) Click en el botón de eliminar
        const delBtn = e.target.closest('.delete-btn');
        if (delBtn) {
            e.stopPropagation();
            const id = delBtn.dataset.id;
            $.post('controller/notifications.php', { action: 'deleteNotification', id }, function (resp) {
                if (resp.success) {
                    notification(); // recarga lista completa
                }
            }, 'json');
        }
    });

    // Primera carga y refresco periódico
    notification();
    // setInterval(notification, 5000);
});

// Formatea "hace X" a partir de timestamp
function getTimeAgo(createdAtStr) {
    const createdAt = new Date(createdAtStr);
    const now       = new Date();
    const diffMs    = now - createdAt;
    const diffMins  = Math.floor(diffMs / 60000);
    if (diffMins < 1) {
        return 'Justo ahora';
    } else if (diffMins < 60) {
        return `${diffMins} min${diffMins > 1 ? 's' : ''} atrás`;
    } else if (diffMins < 1440) {
        const hours = Math.floor(diffMins / 60);
        return `${hours} hora${hours > 1 ? 's' : ''} atrás`;
    } else {
        const days = Math.floor(diffMins / 1440);
        return `${days} día${days > 1 ? 's' : ''} atrás`;
    }
}

// Carga notificaciones y actualiza UI
function notification() {
    const btn   = document.querySelector('.floating-btn');
    const badge = document.querySelector('.floating-btn .badge');
    const list  = document.querySelector('.dropdown-list ul');

    $.ajax({
        url: 'controller/notifications.php',
        method: 'POST',
        data: { action: 'getNotifications' },
        dataType: 'json',
        success: function (data) {
            // Vacía la lista
            list.innerHTML = '';

            // Actualiza badge con las no leídas
            const unreadCount = data.filter(n => !n.is_read).length;
            badge.textContent = unreadCount;
            badge.style.display = unreadCount ? 'flex' : 'none';
            btn.style.display   = data.length ? 'flex' : 'none';

            if (!data.length) {
                list.innerHTML = '<li>No hay notificaciones</li>';
                return;
            }

            // Renderiza cada notificación
            data.forEach(n => {
                const li = document.createElement('li');
                li.dataset.id = n.id;
				li.classList.add('row');
                if (!n.is_read) li.classList.add('unread');

				const timeAgo = getTimeAgo(n.created_at);
				// Si no está leída, resalta el fondo y el texto
				if (!n.is_read) {
					li.style.background = '#f5f5a5'; // Fondo más oscuro para no leídas
					li.style.fontWeight = 'bold';
					li.style.color = '#222';
				}
				if (n.url) {
					li.innerHTML = `
						<a href="${n.url}" class="notif-link col-10" style="display:block;text-decoration:none;color:inherit;">
							${n.message}
							<span class="time">${timeAgo}</span>
						</a>
						<button class="delete-btn col-2" data-id="${n.id}" title="Eliminar" 
							style="float:right;background:none;border:none;color:#dc3545;cursor:pointer;">
							<i class="fas fa-trash-alt"></i>
						</button>
					`;
				} else {
					li.innerHTML = `
						<span class="notif-text col-10">
							${n.message}
							<span class="time">${timeAgo}</span>
						</span>
						<button class="delete-btn col-2" data-id="${n.id}" title="Eliminar" 
							style="float:right;background:none;border:none;color:#dc3545;cursor:pointer;">
							<i class="fas fa-trash-alt"></i>
						</button>
					`;
				}
                list.appendChild(li);
            });
        },
        error: function () {
            console.error('Error al cargar las notificaciones');
        }
    });
}
</script>
