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

<title>Nueva categoría</title>

<style>

body{

    font-family:Arial;
    background:#f4f4f4;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;

}

.formulario{

    width:350px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.2);

}

input{

    width:100%;
    padding:10px;
    margin-top:15px;
    box-sizing:border-box;

}

button{

    width:100%;
    padding:10px;
    margin-top:20px;
    background:#111;
    color:white;
    border:none;
    cursor:pointer;

}

a{

    display:block;
    text-align:center;
    margin-top:20px;
    text-decoration:none;

}

</style>

</head>

<body>

<div class="formulario">

<h2>Nueva categoría</h2>

<form method="POST">

<input
type="text"
name="nombre"
placeholder="Nombre de la categoría"
required>

<button
type="submit"
name="guardar">

Guardar

</button>

</form>

<a href="listar.php">

Volver

</a>

</div>

</body>

</html>