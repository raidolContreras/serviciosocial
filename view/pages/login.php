<?php
// -------------------------------------------------------------------
// 1) Lectura de cookies para prellenar campos si “Remember me” fue marcado
// -------------------------------------------------------------------
$cookieMail = isset($_COOKIE['email']) ? $_COOKIE['email'] : '';
$cookiePass = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';

$mail = (isset($_GET['mail']) && $_GET['mail'] !== '') ? $_GET['mail'] : $cookieMail;
$password = (isset($_GET['password']) && $_GET['password'] !== '') ? $_GET['password'] : $cookiePass;
$rememberChecked = !empty($cookieMail);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Iniciar sesión</title>
    <script src="https://kit.fontawesome.com/f4781c35cc.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --page-bg: #f2f5f5;
            --card-bg: #ffffff;
            --text-color: #333333;
            --input-underline: #cccccc;
            --input-focus: #333333;
            --accent-blue: rgb(24, 90, 7);
            --accent-blue-hover: rgb(41, 122, 38);
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: var(--page-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-card {
            position: relative;
            background-color: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            max-width: 800px;
            width: 100%;
            overflow: hidden;
        }

        .login-card .left-side {
            flex: 1 1 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-card .left-side img {
            max-width: 100%;
            height: auto;
        }

        .login-card .right-side {
            flex: 1 1 50%;
            padding: 2rem;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-card .right-side h3 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .input-group-underline {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group-underline input {
            width: 100%;
            border: none;
            border-bottom: 1px dashed var(--input-underline);
            padding: 0.75rem 2.5rem 0.25rem 2.5rem;
            background: transparent;
            font-size: 1rem;
            color: var(--text-color);
            outline: none;
        }

        .input-group-underline input:focus {
            border-bottom: 1px solid var(--input-focus);
        }

        .input-group-underline .icon-left,
        .input-group-underline .icon-right {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #888888;
        }

        .icon-left {
            left: 0.5rem;
        }

        .icon-right {
            right: 0.5rem;
            cursor: pointer;
        }

        .form-check-custom {
            display: flex;
            align-items: center;
            margin-bottom: 1.75rem;
        }

        .form-check-custom input {
            accent-color: var(--input-focus);
            margin-right: 0.5rem;
            width: 1rem;
            height: 1rem;
        }

        .form-check-custom label {
            font-size: 0.9rem;
            color: #555555;
        }

        .btn-login {
            width: 100%;
            background-color: var(--accent-blue);
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 500;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-login:hover {
            background-color: var(--accent-blue-hover);
        }

        /* ==== NUEVO: selector ligero ==== */
        .register-select {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
            justify-content: center;
        }

        .register-select select {
            flex: 1;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
            outline: none;
            background: #fff;
            color: var(--text-color);
        }

        .btn-go {
            padding: 0.75rem 1.5rem;
            background-color: var(--accent-blue);
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-go:hover {
            background-color: var(--accent-blue-hover);
        }

        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
            }

            .left-side {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .register-select {
                flex-direction: column;
            }

            .btn-go {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">

            <!-- logo -->
            <div style="position:absolute; top:1rem; left:1rem;">
                <img src="view/assets/images/logo-color.png" alt="Logo" style="max-width:150px">
            </div>

            <!-- ILUSTRACIÓN -->
            <div class="left-side">
                <img src="view/assets/images/login-ilustration.jpg" alt="Ilustración">
            </div>

            <!-- FORMULARIO -->
            <div class="right-side">
                <h3>Iniciar sesión</h3>
                <form id="loginForm" autocomplete="off">
                    <div class="input-group-underline">
                        <i class="fas fa-user icon-left"></i>
                        <input
                            type="text"
                            id="email"
                            name="email"
                            placeholder="Correo institucional"
                            value="<?php echo htmlspecialchars($mail, ENT_QUOTES, 'UTF-8'); ?>"
                            required>
                    </div>
                    <div class="input-group-underline">
                        <i class="fas fa-lock icon-left"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Contraseña"
                            value="<?php echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8'); ?>"
                            required>
                    </div>
                    <div class="form-check-custom">
                        <input
                            type="checkbox"
                            id="rememberMe"
                            name="remember_me"
                            <?php echo $rememberChecked ? 'checked' : ''; ?>>
                        <label for="rememberMe">Recuérdame</label>
                    </div>
                    <button type="submit" class="btn-login">Iniciar sesión</button>

                    <center style="margin-top: 1rem; font-size: 0.9rem; color: #555; text-align: center;"></ce>
                        ¿No tienes cuenta?
                    </center>

                    <!-- SELECT UN SOLO CONTROL -->
                    <div class="register-select">
                        <select id="registerSelect">
                            <option value="">— Regístrate —</option>
                            <option value="inscripcionServicio">Servicio Social</option>
                            <option value="inscripcionPracticas">Prácticas Profesionales</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // cookies
        function setCookie(n, v, a) {
            document.cookie = n + "=" + encodeURIComponent(v) + "; max-age=" + a + "; path=/";
        }

        function deleteCookie(n) {
            document.cookie = n + "=; max-age=0; path=/";
        }

        $(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var remember = $('#rememberMe').is(':checked');
                var data = $(this).serialize();
                $.post('controller/ajax/ajax.login.php', data)
                    .done(function(resp) {
                        if (resp.trim() === 'success') {
                            if (remember) {
                                setCookie('email', $('#email').val(), 60 * 60 * 24 * 30);
                                setCookie('password', $('#password').val(), 60 * 60 * 24 * 30);
                            } else {
                                deleteCookie('email');
                                deleteCookie('password');
                            }
                            location.href = './';
                        } else {
                            alert('Correo o contraseña incorrectos');
                        }
                    })
                    .fail(function() {
                        alert('Error en la petición. Intenta de nuevo.');
                    });
            });

            $('#registerSelect').on('change', function() {
                var url = $(this).val();
                if (url) {
                    window.open(url, '_blank');
                }
            });
        });
    </script>
</body>

</html>