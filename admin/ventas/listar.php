<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$sql = "SELECT

ventas.id,
ventas.fecha,
ventas.total,
usuarios.nombre

FROM ventas

INNER JOIN usuarios

ON ventas.usuario_id = usuarios.id

ORDER BY ventas.id DESC";

$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Ventas</title>

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

a{

    text-decoration:none;

}

button{

    padding:8px 15px;
    cursor:pointer;

}

</style>

</head>

<body>

<h1>Ventas</h1>

<a class="volver" href="../dashboard.php">

<button>Volver al panel</button>

</a>
<table>

<tr>

<th>ID</th>
<th>Cliente</th>
<th>Fecha</th>
<th>Total</th>
<th>Detalle</th>

</tr>

<?php while($venta = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $venta["id"]; ?></td>

<td><?php echo $venta["nombre"]; ?></td>

<td><?php echo $venta["fecha"]; ?></td>

<td>$<?php echo number_format($venta["total"]); ?></td>

<td>

<a href="detalle.php?id=<?php echo $venta["id"]; ?>">

<button>Ver</button>

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>