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

<title>Categorías</title>

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

<h1>Categorías</h1>

<br>

<a href="crear.php">

<button>Nueva categoría</button>

</a>

<a class="volver" href="../dashboard.php">

<button>Volver al panel</button>

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

Editar

</a>

</td>

<td>

<a href="eliminar.php?id=<?php echo $categoria["id"]; ?>">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>