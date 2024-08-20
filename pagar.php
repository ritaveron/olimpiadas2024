<?php 
include("template/cabecera.php"); 
include("global/config.php"); 
include("carrito.php"); 
include("administrador/config/bd.php"); 

$total = 0;
if($_POST){
    $SID = session_id();
    $Correo = $_POST['email'];

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
    }

    $sentencia = $conexion->prepare("INSERT INTO tblventas (ID, ClaveTransaccion, PaypalDatos, Fecha, Correo, Total, `status`) VALUES (NULL, :ClaveTransaccion, '', NOW(), :Correo, :Total, 'pendiente');");
    $sentencia->bindParam(":ClaveTransaccion", $SID);
    $sentencia->bindParam(":Correo", $Correo);
    $sentencia->bindParam(":Total", $total);
    $sentencia->execute();
    $idVenta = $conexion->lastInsertId();

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $sentencia = $conexion->prepare("INSERT INTO tbldetalleventa (IDVENTA, IDPRODUCTO, PRECIOUNITARIO, CANTIDAD) VALUES (:IDVENTA, :IDPRODUCTO, :PRECIOUNITARIO, :CANTIDAD);");
        $sentencia->bindParam(":IDVENTA", $idVenta);
        $sentencia->bindParam(":IDPRODUCTO", $producto['ID']);
        $sentencia->bindParam(":PRECIOUNITARIO", $producto['PRECIO']);
        $sentencia->bindParam(":CANTIDAD", $producto['CANTIDAD']);
        $sentencia->execute();
    }
}
?>
<script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>
<style>
  .center-content {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    min-height: 100vh; 
    text-align: center; 
  }
  .logout-button {
    margin-bottom: 20px;
  }
</style>
<div class="center-content">
    <div class="jumbotron">
        <h1 class="display-4">¡Paso Final!</h1>
        <hr class="my-4">
        <p class="lead">Estas a punto de pagar con Paypal la cantidad de:
            <h4>$<?php echo number_format($total,2); ?></h4>
            <div id="paypal-button-container"></div>
        </p>
        <p>Los productos podran ser descargados una vez que se procece el pago.<br/>
            <strong>(Para aclaraciones :ritaveron40@gmail.com)</strong>
        </p>
    </div>
    <!-- Botón de Cerrar Sesión -->
    <form action="cerrar_sesion.php" method="post" class="logout-button">
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PayPal Checkout Integration | Button Styles</title> 
</head>
<body>
    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            style: {
                color:  'blue',
                shape:  'pill',
                label:  'pay',
                height: 40
            },
            createOrder: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/create/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },
            onApprove: function(data, actions) {
                return fetch('/demo/checkout/api/paypal/order/' + data.orderID + '/capture/', {
                    method: 'post'
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];
                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart();
                    }
                    if (errorDetail) {
                        var msg = 'Sorry, your transaction could not be processed.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        return alert(msg);
                    }
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>

<?php include("template/pie.php");?>
