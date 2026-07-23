<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$sql = "SELECT

productos.*,

categorias.nombre AS categoria

FROM productos

INNER JOIN categorias

ON productos.categoria_id = categorias.id";

$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Productos</title>

<style>

body{

font-family:Arial;

margin:30px;

background:#f4f4f4;

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

padding:8px 15px;

cursor:pointer;

}

a{

text-decoration:none;

}

</style>

</head>

<body>

<h1>Productos</h1>

<a href="crear.php">

<button>

Nuevo producto

</button>

<a class="volver" href="../dashboard.php">

<button>Volver al panel</button>

</a>

</a>

<br><br>

<table>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Categoría</th>

<th>Precio</th>

<th>Stock</th>

<th>Editar</th>

<th>Eliminar</th>

</tr>

<?php while($producto=mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $producto["id"]; ?></td>

<td><?php echo $producto["nombre"]; ?></td>

<td><?php echo $producto["categoria"]; ?></td>

<td>$<?php echo number_format($producto["precio"]); ?></td>

<td><?php echo $producto["stock"]; ?></td>

<td>

<a href="editar.php?id=<?php echo $producto["id"]; ?>">

Editar

</a>

</td>

<td>

<a href="eliminar.php?id=<?php echo $producto["id"]; ?>">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>