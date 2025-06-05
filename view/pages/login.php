<?php
    $mail = (isset($_GET['mail'])) ? $_GET['mail'] : '';
    $password = (isset($_GET['password'])) ? $_GET['password'] : '';
?>
<style>
    .card {
        border-radius: 20px;
        box-shadow: none; /* Elimina la sombra */
        border: none; /* Elimina el borde */
    }

    .card-header {
        border-radius: 20px 20px 0 0; /* Redondea esquinas superiores */
        background-color: transparent;
        border-bottom: 3px solid #01643D;
        font-size: 2rem;
        font-weight: bold;
        padding: 20px;
    }

    .card-body {
        padding: 20px;
    }

    /* Centrado del logo y ajuste de margen */
    .text-center {
        text-align: center;
    }

    .btn-primary {
        margin-top: 1.1rem; /* Ajusta el margen superior del botón */
    }
</style>
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="text-left">
                <img src="view/assets/images/logo-color.png" alt="Logo de Unimo" class="img-fluid" style="max-width: 200px;">
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header text-center mx-2">
                    Iniciar sesión
                </div>
                <div class="card-body">
                    <form class="my-4" id="loginForm">
                        <div class="form-group ">
                            <input type="email" class="form-control mb-3" name="email" aria-describedby="emailHelp" placeholder="Correo electrónico" aria-label="Correo electrónico" value="<?php echo $mail ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Contraseña" aria-label="Contraseña" value="<?php echo $password ?>">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'controller/ajax/ajax.login.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'success') {
                            window.location.href = './';
                        } else {
                            alert('Correo o contraseña incorrectos');
                        }
                    }
                });
            });
        });
    </script>