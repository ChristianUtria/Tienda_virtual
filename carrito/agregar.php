<?php

session_start();

include "../config/conexion.php";

if(!isset($_SESSION["id"])){

    header("Location: ../auth/login.php");
    exit();

}

$usuario = $_SESSION["id"];
$producto = $_GET["id"];

/*
¿Ya existe el producto en el carrito?
*/

$sql = "SELECT * FROM carrito
WHERE usuario_id='$usuario'
AND producto_id='$producto'";

$resultado = mysqli_query($conexion,$sql);

if(mysqli_num_rows($resultado)>0){

    mysqli_query($conexion,

    "UPDATE carrito

    SET cantidad = cantidad + 1

    WHERE usuario_id='$usuario'

    AND producto_id='$producto'");

}else{

    mysqli_query($conexion,

    "INSERT INTO carrito

    (usuario_id,producto_id,cantidad)

    VALUES

    ('$usuario','$producto',1)");

}

header("Location: ver.php");
exit();

?>