<?php include("template/cabecera.php"); ?>
<?php include("global/config.php"); ?>
<?php include("carrito.php"); ?>
<?php include("administrador/config/bd.php"); 

$idCategoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : "";

if (empty($idCategoria)) {
    echo "<div class='alert alert-danger'>ID de categoría no proporcionado</div>";
    exit;
}

try {
    $sentenciaSQL = $conexion->prepare("SELECT id, nombre, imagen, precio FROM producto WHERE id_categoria = :id_categoria");
    $sentenciaSQL->bindParam(':id_categoria', $idCategoria, PDO::PARAM_INT);
    $sentenciaSQL->execute();
    $listaProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    if (empty($listaProducto)) {
        echo "<div class='alert alert-warning'>No hay productos para esta categoría</div>";
        exit;
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Error en la consulta: " . htmlspecialchars($e->getMessage()) . "</div>";
    exit;
}
?>

<div class="container">
    <h1>Productos</h1>
    <?php if($mensaje!=""){?>
    <div class="alert alert-success">
    <?php echo $mensaje;?>
        <a href="mostrarCarrito.php" class="badge badge-success">Ver carrito</a>
    </div>
    <?php } ?>
    <div class="row">
    <?php foreach ($listaProducto as $producto) { 
        // Verificar si los campos existen en el array
        if (!isset($producto['imagen']) || !isset($producto['nombre']) || !isset($producto['id']) || !isset($producto['precio'])) {
            echo "<div class='alert alert-danger'>Error: Producto incompleto</div>";
            continue;
        }

        // Construir la ruta completa de la imagen
        $rutaImagen = "./img/" . htmlspecialchars($producto['imagen']);
    ?>
    <div class="col-md-3">
        <div class="card">
            <img class="card-img-top" src="<?php echo $rutaImagen; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" onerror="this.src='./img/default.png';">
            
            <div class="card-body">
                <h4 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h4>
                <p class="card-text"><strong></strong> $<?php echo number_format($producto['precio'], 2); ?></p>

                <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo $producto['id'];?>">
                      <input type="hidden" name="nombre" id="nombre" value="<?php echo $producto['nombre'];?>">
                      <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio'];?>">
                      <input type="number" name="cantidad" value="1" min="1" class="form-control mb-2">

                    <button type="submit" class="btn btn-primary" name="btnAccion" value="Agregar">Agregar al Carrito</button>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
    </div>
</div>

<?php include("template/pie.php"); ?>
