<?php 

include '../login/conexion_be.php';

$nombre_completo = $_POST['nombre_completo'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Encriptamiento
$contrasena = hash('sha512', $contrasena);

// Consulta para insertar el nuevo usuario
$query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
          VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";

// Verificar si el correo ya existe
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

if(mysqli_num_rows($verificar_correo) > 0){
    echo '
    <script>
    alert("Este correo ya existe, intenta con otro diferente");
    window.location = "../login.php";
    </script>
    ';
    exit();
}

// Verificar si el usuario ya existe
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");

if(mysqli_num_rows($verificar_usuario) > 0){
    echo '
    <script>
    alert("Este usuario ya existe, intenta con otro diferente");
    window.location = "../login.php";
    </script>
    ';
    exit();
}

// Ejecutar la consulta de registro
$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    // Iniciar sesión automáticamente y redirigir al carrito
    session_start();
    $_SESSION['usuario'] = $correo;
    echo '
    <script>
    alert("Usuario registrado exitosamente");
    window.location = "../mostrarCarrito.php";
    </script>
    ';
}else{
    echo '
    <script>
    alert("No se pudo registrar, intentalo de nuevo");
    window.location = "../login.php";
    </script>
    ';
}

mysqli_close($conexion);

?>
