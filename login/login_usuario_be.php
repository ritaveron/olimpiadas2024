<?php

include '../login/conexion_be.php';

$correo = $_POST['correo'];
$contrasena_ingresada = $_POST['contrasena'];

// Encriptar la contraseña ingresada
$contrasena_encriptada = hash('sha512', $contrasena_ingresada);

// Validar el login
$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena_encriptada'");

session_start();

if (mysqli_num_rows($validar_login) > 0) {
    // Usuario válido, establecer sesión y redirigir al carrito
    $_SESSION['usuario'] = $correo;
    header("location: ../mostrarCarrito.php"); // Redirige al carrito
    exit;
} else {
    // Usuario o contraseña incorrectos
    echo '
    <script>
    alert("Usuario o contraseña incorrectos");
    window.location = "../login.php";
    </script>
    ';
    exit;
}

?>
