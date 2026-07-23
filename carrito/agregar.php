<?php

session_start();

include "../config/conexion.php";

if(!isset($_SESSION["id"])){

    header("Location: ../auth/login.php");
    exit();

}

$usuario = $_SESSION["id"];
$producto = $_GET["id"];

$sqlStock = "SELECT stock FROM productos WHERE id='$producto'";
$resultadoStock = mysqli_query($conexion, $sqlStock);

if(mysqli_num_rows($resultadoStock) == 0){

    header("Location: ../index.php");
    exit();

}

$stockDisponible = mysqli_fetch_assoc($resultadoStock)["stock"];

if($stockDisponible <= 0){

    $_SESSION["carrito_msg"] = "Este producto está agotado.";
    header("Location: ../productos/detalle.php?id=$producto");
    exit();

}

$sql = "SELECT * FROM carrito
WHERE usuario_id='$usuario'
AND producto_id='$producto'";

$resultado = mysqli_query($conexion,$sql);

if(mysqli_num_rows($resultado)>0){

    $cantidadActual = mysqli_fetch_assoc($resultado)["cantidad"];

    if($cantidadActual + 1 > $stockDisponible){

        $_SESSION["carrito_msg"] = "No hay más stock disponible de este producto (máximo $stockDisponible).";
        header("Location: ../productos/detalle.php?id=$producto");
        exit();

    }

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