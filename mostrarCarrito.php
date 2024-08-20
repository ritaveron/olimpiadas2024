<?php include("template/cabecera.php"); ?>
<div class="d-flex flex-column min-vh-100">
<?php include("global/config.php"); ?>
<?php include("carrito.php"); ?>

<?php if(!isset($_SESSION['usuario']) || !$_SESSION['usuario']) { ?>
    <script>
        alert("¡Debes iniciar sesión o registrarte para poder comprar!");
        window.location.href = "login.php"; 
    </script>
    
<?php } else { ?>
    <div class="jumbotron">
        <h1 class="display-3">Carrito</h1>
        <?php if(!empty($_SESSION['CARRITO'])){ ?>
        <p class="lead">Gracias por utilizar nuestra aplicación. Estamos dispuestos a ayudarte y brindar una experiencia de lujo.</p>
        <hr class="my-2">

        <table class="table table-light">
            <tbody>
                <tr>
                    <td width="40%">Nombre</td>
                    <th width="15%" class="text-center">Cantidad</th>
                    <th width="20%" class="text-center">Precio</th>
                    <th width="20%" class="text-center">Total</th>
                    <th width="5%">--</th>
                </tr>
                <?php $total=0; ?>
                <?php foreach($_SESSION['CARRITO'] as $indice=>$producto){ ?>
                <tr>
                    <td width="40%"><?php echo $producto['NOMBRE']; ?></td>
                    <td width="15%" class="text-center"><?php echo $producto['CANTIDAD']; ?></td>
                    <td width="20%" class="text-center">$<?php echo $producto['PRECIO']; ?></td>
                    <td width="20%" class="text-center">$<?php echo number_format($producto['PRECIO']*$producto['CANTIDAD'],2); ?></td>
                    <td width="5%">
                        <form action="" method="post">
                            <input type="hidden" name="id" id="id" value="<?php echo $producto['ID']; ?>">
                            <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php $total=$total+($producto['PRECIO']*$producto['CANTIDAD']); ?>
                <?php } ?>
                <tr>
                    <td colspan="3" align="right"><h3>Total</h3></td>
                    <td align="right"><h3>$<?php echo number_format($total,2); ?></h3></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <form action="" method="post">
                            <button class="btn btn-warning btn-lg btn-block" type="submit" name="btnAccion" value="Vaciar">Vaciar carrito</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <form action="pagar.php" method="post">
                            <div class="alert alert-success">
                                <div class="form-group">
                                    <label for="my-input">Correo de contacto:</label>
                                    <input id="email" name="email" class="form-control" type="email" placeholder="Por favor escribe tu correo" required>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">
                                    Los productos se enviarán a este correo
                                </small>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit" value="proceder" name="btnAccion">Proceder a pagar >></button>
                        </form>
                    </td>
                </tr>
                
            </tbody>
        </table>
        <?php } else { ?>
            <div class="alert alert-success">
                No hay productos en el carrito...
            </div>
        <?php } ?>
        <?php include("ayuda.php"); ?>
    </div>
<?php } ?>

<?php include("template/pie.php"); ?>
</div>
