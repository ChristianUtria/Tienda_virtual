<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

if(isset($_POST["guardar"])){

    $nombre = trim($_POST["nombre"]);

    if(!empty($nombre)){

        mysqli_query($conexion,

        "INSERT INTO categorias(nombre)

        VALUES('$nombre')");

        header("Location: listar.php");
        exit();

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Nueva categoría</title>

<link rel="stylesheet" href="../../assets/css/estilos_nueva_categoria.css">

</head>

<body>

<div class="caja_formulario">

<h2><i class="bi bi-plus-lg"></i> Nueva categoría</h2>

<form method="POST">

<input
type="text"
name="nombre"
placeholder="Nombre de la categoría"
required>

<button
type="submit"
name="guardar">

<i class="bi bi-save"></i> Guardar

</button>

</form>

<a href="listar.php">

<i class="bi bi-arrow-left"></i> Volver

</a>

</div>

</body>

</html>