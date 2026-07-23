<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$id = $_GET["id"];

$sql = "SELECT

productos.nombre,
detalle_ventas.cantidad,
detalle_ventas.precio,
detalle_ventas.subtotal

FROM detalle_ventas

INNER JOIN productos

ON detalle_ventas.producto_id = productos.id

WHERE detalle_ventas.venta_id='$id'";

$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Detalle venta</title>

<style>

body{

    font-family:Arial;
    background:#f5f5f5;
    margin:30px;

}

table{

    width:100%;
    border-collapse:collapse;
    background:white;

}

th{

    background:#222;
    color:white;
    padding:12px;

}

td{

    padding:12px;
    border-bottom:1px solid #ddd;

}

button{

    padding:10px;

}

</style>

</head>

<body>

<h1>Detalle de la venta</h1>

<table>

<tr>

<th>Producto</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Subtotal</th>

</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $fila["nombre"]; ?></td>

<td><?php echo $fila["cantidad"]; ?></td>

<td>$<?php echo number_format($fila["precio"]); ?></td>

<td>$<?php echo number_format($fila["subtotal"]); ?></td>

</tr>

<?php } ?>

</table>

<br>

<a href="listar.php">

<button>Volver</button>

</a>

</body>

</html>