<?php

session_start();

include "../config/conexion.php";

if(!isset($_SESSION["id"])){

    header("Location: ../auth/login.php");
    exit();

}

$usuario = $_SESSION["id"];

$sql = "SELECT

ventas.id,
ventas.fecha,
ventas.total

FROM ventas

WHERE ventas.usuario_id='$usuario'

ORDER BY ventas.id DESC";

$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Mis compras</title>

<link rel="stylesheet" href="../assets/css/estilos_historial_compras.css">

</head>

<body>

<h1><i class="bi bi-clock-history"></i> Mis compras</h1>

<a href="../index.php">

<button><i class="bi bi-arrow-left"></i> Volver a la tienda</button>

</a>

<br><br>

<?php if(mysqli_num_rows($resultado) == 0){ ?>

<p class="mensaje_vacio">

Todavía no has realizado ninguna compra.

</p>

<?php }else{ ?>

<table>

<tr>

<th>ID</th>
<th>Fecha</th>
<th>Total</th>
<th>Detalle</th>

</tr>

<?php while($venta = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $venta["id"]; ?></td>

<td><?php echo $venta["fecha"]; ?></td>

<td>$<?php echo number_format($venta["total"]); ?></td>

<td>

<a href="detalle.php?id=<?php echo $venta["id"]; ?>">

<button><i class="bi bi-eye"></i> Ver</button>

</a>

</td>

</tr>

<?php } ?>

</table>

<?php } ?>

</body>

</html>
