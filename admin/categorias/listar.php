<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$sql = "SELECT * FROM categorias";

$resultado = mysqli_query($conexion,$sql);

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Categorías</title>

<link rel="stylesheet" href="../../assets/css/estilos_lista_categorias.css">

</head>

<body>

<h1><i class="bi bi-tag"></i> Categorías</h1>

<br>

<a href="crear.php">

<button><i class="bi bi-plus-lg"></i> Nueva categoría</button>

</a>

<a href="../dashboard.php">

<button><i class="bi bi-arrow-left"></i> Volver al panel</button>

</a>

<br><br>

<table>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Editar</th>

<th>Eliminar</th>

</tr>

<?php while($categoria = mysqli_fetch_assoc($resultado)){ ?>

<tr>

<td><?php echo $categoria["id"]; ?></td>

<td><?php echo $categoria["nombre"]; ?></td>

<td>

<a href="editar.php?id=<?php echo $categoria["id"]; ?>">

<i class="bi bi-pencil"></i> Editar

</a>

</td>

<td>

<a href="eliminar.php?id=<?php echo $categoria["id"]; ?>">

<i class="bi bi-trash"></i> Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>