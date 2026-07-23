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
productos.stock,
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Carrito</title>

<link rel="stylesheet" href="../assets/css/estilos_carrito.css">

</head>

<body>

<h1><i class="bi bi-cart3"></i> Mi carrito</h1>

<?php if(isset($_SESSION["carrito_msg"])){ ?>

<p style="color:red;font-weight:bold;">

<?php echo $_SESSION["carrito_msg"]; unset($_SESSION["carrito_msg"]); ?>

</p>

<?php } ?>

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

<td>

<?php echo $fila["cantidad"]; ?>

<?php if($fila["cantidad"] > $fila["stock"]){ ?>

<br><small style="color:red;">Solo quedan <?php echo $fila["stock"]; ?> en stock</small>

<?php } ?>

</td>

<td>$<?php echo number_format($fila["subtotal"]); ?></td>

<td>

<a href="eliminar.php?id=<?php echo $fila["id"]; ?>">

<button><i class="bi bi-trash"></i> Eliminar</button>

</a>

</td>

</tr>

<?php } ?>

</table>

<p class="texto_total">

Total:
$<?php echo number_format($total); ?>

</p>

<br>

<a href="../index.php">

<button><i class="bi bi-arrow-left"></i> Seguir comprando</button>

</a>

<a href="comprar.php">

<button><i class="bi bi-check-circle"></i> Finalizar compra</button>

</a>

</body>

</html>