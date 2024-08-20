<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesion para entrar en la página.</p>
                    <button id="btn__iniciar-sesion">Iniciar sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión.</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>
            <div class="contenedor__login-register">

<form action="login/login_usuario_be.php" method="POST" class="formulario__login">
    <h2>Inicia sesión</h2>
    <input type="text" name="correo" placeholder="Correo Electrónico"required>
    <input type="password" name="contrasena" placeholder="Contraseña"required>
    <button>Entrar</button>
</form>



<form action="login/registro_usuario_be.php" method="POST" class="formulario__register">
    <h2>Registrarse</h2>
    <input type="text" name="nombre_completo" placeholder="Nombre Completo" required>
        <input type="text" name="correo" placeholder="Correo Electrónico" required>
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <input type="password" name="confirmar_contrasena" placeholder="Confirmar Contraseña" required>
        <button type="submit">Registrarse</button>
</form>

            </div>
        </div>
    </main>
    <script src="./javascript/login.js"></script>
</body>
</html>