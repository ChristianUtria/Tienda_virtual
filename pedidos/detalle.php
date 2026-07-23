<?php

session_start();

include "../config/conexion.php";

if(!isset($_SESSION["id"])){

    header("Location: ../auth/login.php");
    exit();

}

$usuario = $_SESSION["id"];
$id = $_GET["id"];

$sqlVenta = "SELECT * FROM ventas WHERE id='$id' AND usuario_id='$usuario'";
$resultadoVenta = mysqli_query($conexion, $sqlVenta);

if(mysqli_num_rows($resultadoVenta) == 0){

    header("Location: historial.php");
    exit();

}

$venta = mysqli_fetch_assoc($resultadoVenta);

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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Detalle de compra</title>

<link rel="stylesheet" href="../assets/css/estilos_detalle_pedido.css">

</head>

<body>

<h1><i class="bi bi-receipt"></i> Detalle de la compra #<?php echo $venta["id"]; ?></h1>

<p class="texto_fecha">

Fecha: <?php echo $venta["fecha"]; ?>

</p>

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

<p class="texto_total">

Total: $<?php echo number_format($venta["total"]); ?>

</p>

<br>

<a href="historial.php">

<button><i class="bi bi-arrow-left"></i> Volver a mis compras</button>

</a>

</body>

</html>
