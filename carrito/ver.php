<?php

session_start();

include "../config/conexion.php";

if(!isset($_SESSION["id"])){

    header("Location: ../auth/login.php");
    exit();

}

$usuario = $_SESSION["id"];

$sql = "SELECT
carrito.id,
carrito.cantidad,
productos.nombre,
productos.precio,
(productos.precio * carrito.cantidad) AS subtotal

FROM carrito

INNER JOIN productos

ON carrito.producto_id = productos.id

WHERE carrito.usuario_id = '$usuario'";

$resultado = mysqli_query($conexion, $sql);

$total = 0;

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<title>Carrito</title>

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

.total{

    font-size:22px;
    margin-top:20px;
    font-weight:bold;

}

a{

    text-decoration:none;

}

button{

    padding:10px;
    cursor:pointer;

}

</style>

</head>

<body>

<h1>Mi carrito</h1>

<table>

<tr>

<th>Producto</th>

<th>Precio</th>

<th>Cantidad</th>

<th>Subtotal</th>

<th>Acción</th>

</tr>

<?php

while($fila = mysqli_fetch_assoc($resultado)){

$total += $fila["subtotal"];

?>

<tr>

<td><?php echo $fila["nombre"]; ?></td>

<td>$<?php echo number_format($fila["precio"]); ?></td>

<td><?php echo $fila["cantidad"]; ?></td>

<td>$<?php echo number_format($fila["subtotal"]); ?></td>

<td>

<a href="eliminar.php?id=<?php echo $fila["id"]; ?>">

<button>Eliminar</button>

</a>

</td>

</tr>

<?php } ?>

</table>

<p class="total">

Total:
$<?php echo number_format($total); ?>

</p>

<br>

<a href="../index.php">

<button>Seguir comprando</button>

</a>

<a href="comprar.php">

<button>Finalizar compra</button>

</a>

</body>

</html>