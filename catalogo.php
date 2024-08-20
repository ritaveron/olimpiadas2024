<?php include("template/cabecera.php"); ?>
<div class="d-flex flex-column min-vh-100">
    <?php include("administrador/config/bd.php"); ?>

    <?php
    $sentenciaCategorias = $conexion->prepare("SELECT * FROM categorias");
    $sentenciaCategorias->execute();
    $listaCategorias = $sentenciaCategorias->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container flex-grow-1">
        <div class="jumbotron">
            <h1 class="display-3">Catálogo</h1>
            <p class="lead">Encontrarás productos por categorías con la opción de comprarlo de la manera que quieras.</p>
            <hr class="my-2">
            <div class="container">
                <div class="row">
                    <?php foreach($listaCategorias as $categoria) { ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $categoria['nombre']; ?></h4>
                                    <a href="productos_por_categoria.php?id_categoria=<?php echo $categoria['id_categoria']; ?>" class="btn btn-primary">Ver Productos</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("ayuda.php"); ?>
    <?php include("template/pie.php"); ?>
</div>