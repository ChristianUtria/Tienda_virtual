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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Productos</title>

<link rel="stylesheet" href="../../assets/css/estilos_lista_productos.css">

</head>

<body>

<h1><i class="bi bi-box-seam"></i> Productos</h1>

<a href="crear.php">

<button>

<i class="bi bi-plus-lg"></i> Nuevo producto

</button>

</a>

<a href="../dashboard.php">

<button>

<i class="bi bi-arrow-left"></i> Volver al panel

</button>

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

<i class="bi bi-pencil"></i> Editar

</a>

</td>

<td>

<a href="eliminar.php?id=<?php echo $producto["id"]; ?>">

<i class="bi bi-trash"></i> Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>