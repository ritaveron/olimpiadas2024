<!--INCLUIR CABECERA-->
<?php include("../template/cabecera.php");?>

<!--Captura los valores enviados desde el formulario HTML utilizando el método POST y asigna estos valores a variables-->
<?php
$txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
$txtNombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
$txtImagen = isset($_FILES['txtImagen']['name']) ? $_FILES['txtImagen']['name'] : "";
$txtCategoria = isset($_POST['txtCategoria']) ? $_POST['txtCategoria'] : "";
$accion = isset($_POST['acciones']) ? $_POST['acciones'] : "";

// Incluir la conexion con la base de datos
include("../config/bd.php");

switch ($accion) {
    case 'Agregar':
        // Código para agregar un nuevo registro en la base de datos
        // Preparar la sentencia SQL para insertar un nuevo producto con nombre, imagen y categoría
        $sentenciaSQL = $conexion->prepare("INSERT INTO producto (nombre, imagen, id_categoria) VALUES (:nombre, :imagen, :id_categoria);");
        $sentenciaSQL->bindParam(':nombre', $txtNombre); // Vincular el parámetro nombre
        $sentenciaSQL->bindParam(':id_categoria', $txtCategoria);

        // Adjuntar imagen a la carpeta img
        $fecha = new DateTime();
        // Si hay una imagen tomamos esa imagen y también la hora
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
        // Almacenar el nombre temporal de la imagen
        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if ($tmpImagen != "") {
            // Si esa imagen no está vacía que la mueva a la carpeta img con el nuevo nombre del archivo
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen', $nombreArchivo); // Vincular el parámetro imagen
        $sentenciaSQL->execute(); // Ejecutar la sentencia SQL
        header("Location: producto.php"); // Redirigir a producto.php
        break;

    case 'Modificar':
        // Código para modificar un registro existente en la base de datos
        // Preparar la sentencia SQL para actualizar el nombre del producto según el id
        $sentenciaSQL = $conexion->prepare("UPDATE producto SET nombre=:nombre, id_categoria=:id_categoria WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre', $txtNombre); // Vincular el parámetro nombre
        $sentenciaSQL->bindParam(':id_categoria', $txtCategoria);
        $sentenciaSQL->bindParam(':id', $txtID); // Vincular el parámetro id
        $sentenciaSQL->execute(); // Ejecutar la sentencia SQL

        if ($txtImagen != "") {
            // Si hay una imagen tomamos esa imagen y también la hora
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo); // Mover la nueva imagen a la carpeta img
            // Obtener el nombre de la imagen actual del producto
            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM producto WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            // Eliminar la imagen anterior si existe y no es 'imagen.jpg'
            if (isset($producto["imagen"]) && ($producto["imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $producto["imagen"])) {
                    unlink("../../img/" . $producto["imagen"]);
                }
            }
            // Actualizar el registro con el nuevo nombre de imagen
            $sentenciaSQL = $conexion->prepare("UPDATE producto SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }
        header("Location: producto.php"); // Redirigir a producto.php
        break;

    case 'Cancelar':
        // Código para manejar la acción de cancelar
        header("Location: producto.php"); // Redirigir a producto.php
        break;

    case 'seleccionar':
        // Código para manejar la acción de seleccionar un registro
        // Preparar la sentencia SQL para seleccionar un producto por id
        $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID); // Vincular el parámetro id
        $sentenciaSQL->execute(); // Ejecutar la sentencia SQL
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY); // Obtener el registro
        // Asignar los valores del registro a las variables
        $txtNombre = $producto['nombre'];
        $txtImagen = $producto['imagen'];
        $txtCategoria = $producto['id_categoria'];
        break;

    case 'borrar':
        // Código para manejar la acción de borrar un registro
        // Obtener el nombre de la imagen del producto a borrar
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM producto WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID); // Vincular el parámetro id
        $sentenciaSQL->execute(); // Ejecutar la sentencia SQL
        $producto = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        // Eliminar la imagen del servidor si existe y no es 'imagen.jpg'
        if (isset($producto["imagen"]) && ($producto["imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $producto["imagen"])) {
                unlink("../../img/" . $producto["imagen"]);
            }
        }

        // Preparar la sentencia SQL para borrar el registro del producto por id
        $sentenciaSQL = $conexion->prepare("DELETE FROM producto WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID); // Vincular el parámetro id
        $sentenciaSQL->execute(); // Ejecutar la sentencia SQL
        header("Location: producto.php"); // Redirigir a producto.php
        break;
}

// Preparar y ejecutar la sentencia SQL para seleccionar todos los registros de la tabla producto
$sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
$sentenciaSQL->execute();
// Para guardar la información creo la variable $listamueble y el método fetchAll que recupera los registros
$listaProducto = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaCategorias = $conexion->prepare("SELECT * FROM categorias");
$sentenciaCategorias->execute();
$listaCategorias = $sentenciaCategorias->fetchAll(PDO::FETCH_ASSOC);
?>

<!--preparación del crud-->
<div class="col-md-5">
    <!--FORMULARIO DE AGREGAR PRODUCTO-->
    <div class="card">
        <div class="card-header">
            Datos del producto
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                </div>
                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del producto">
                </div>
                <div class="form-group">
                    <label for="txtCategoria">Categoría:</label>
                    <select class="form-control" name="txtCategoria" id="txtCategoria">
                        <?php foreach ($listaCategorias as $categoria) { ?>
                            <option value="<?php echo $categoria['id_categoria']; ?>" <?php echo ($txtCategoria == $categoria['id_categoria']) ? 'selected' : ''; ?>><?php echo $categoria['nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtNombre">Imagen:</label>
                    <?php if ($txtImagen != "") { ?>
                        <br />
                        <?php
    $rutaImagen = '../../img/' . htmlspecialchars($txtImagen);
    echo "Ruta generada: " . $rutaImagen;
?>

                        <<img class="img-thumbnail rounded" src="../../img/<?php echo htmlspecialchars($txtImagen); ?>" width="50" alt="">

                    <?php } ?>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="acciones" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="acciones" value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="acciones" value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaProducto as $producto) { ?>

            <tr>
                <td><?php echo $producto['id'];?></td>
                <td><?php echo $producto['nombre'];?></td><!--estos datos tienen que coincidir con la base de datos-->
                <td><?php
                        foreach ($listaCategorias as $categoria) {
                            if ($categoria['id_categoria'] == $producto['id_categoria']) {
                                echo $categoria['nombre'];
                                break;
                            }
                        }
                    ?></td>
                <td>
                    <img src="../../img/<?php echo $producto['imagen'];?>" width="50" alt="" srcset="">
                    </td>
                
                
                
                <td>
                <form method="post">
                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['id'];?>"/>
                    <input type="submit" name="acciones"value="seleccionar" class= "btn btn-primary"/>
                    <input type="submit" name="acciones"value="borrar" class= "btn btn-danger"/>

                </form> 
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie.php"); ?>