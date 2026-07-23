<?php

session_start();

include "../config/conexion.php";

if (!isset($_SESSION["id"])) {
    header("Location: ../auth/login.php");
    exit();
}

$usuario = $_SESSION["id"];

$sql = "SELECT

carrito.producto_id,
carrito.cantidad,

productos.nombre,
productos.precio,
productos.stock

FROM carrito

INNER JOIN productos

ON carrito.producto_id = productos.id

WHERE carrito.usuario_id='$usuario'";

$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 0) {
    header("Location: ver.php");
    exit();
}

$total = 0;
$productos = [];

while ($fila = mysqli_fetch_assoc($resultado)) {

    if ($fila["cantidad"] > $fila["stock"]) {

        die("No hay suficiente stock para el producto: " . $fila["nombre"]);

    }

    $fila["subtotal"] = $fila["precio"] * $fila["cantidad"];

    $total += $fila["subtotal"];

    $productos[] = $fila;
}

$sqlVenta = "INSERT INTO ventas
(usuario_id,fecha,total)
VALUES
('$usuario',NOW(),'$total')";

mysqli_query($conexion, $sqlVenta);

$venta_id = mysqli_insert_id($conexion);

foreach ($productos as $producto) {

    $producto_id = $producto["producto_id"];
    $cantidad = $producto["cantidad"];
    $precio = $producto["precio"];
    $subtotal = $producto["subtotal"];

    mysqli_query(
        $conexion,
        "INSERT INTO detalle_ventas
        (venta_id,producto_id,cantidad,precio,subtotal)
        VALUES
        (
        '$venta_id',
        '$producto_id',
        '$cantidad',
        '$precio',
        '$subtotal'
        )"
    );

    mysqli_query(
        $conexion,
        "UPDATE productos
        SET stock = stock - $cantidad
        WHERE id='$producto_id'"
    );
}

mysqli_query(
    $conexion,
    "DELETE FROM carrito
    WHERE usuario_id='$usuario'"
);

header("Location: ../index.php");
exit();

?>