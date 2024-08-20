<?php
$host="localhost";
$bd="prod_carrito";
$usuario='root';
$contrasenia="";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    //creo la variable pdo me comunica con la bd,nombre del host, db
    if($conexion){echo "";}// pregunto si la conexion se hizo y que imprima onectado
} 
catch (Exception $ex) {
    //si existe un error, toma el error y muestra el mensaje
    echo $ex->getmessage();
}