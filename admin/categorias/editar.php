<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$id = $_GET["id"];

$sql = "SELECT * FROM categorias WHERE id='$id'";
$resultado = mysqli_query($conexion, $sql);

$categoria = mysqli_fetch_assoc($resultado);

if(isset($_POST["actualizar"])){

    $nombre = trim($_POST["nombre"]);

    if(!empty($nombre)){

        $sql = "UPDATE categorias
                SET nombre='$nombre'
                WHERE id='$id'";

        mysqli_query($conexion, $sql);

        header("Location: listar.php");
        exit();

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar categoría</title>

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

<h2>Editar categoría</h2>

<form method="POST">

<input
type="text"
name="nombre"
value="<?php echo $categoria["nombre"]; ?>">

<button
type="submit"
name="actualizar">

Actualizar

</button>

</form>

<a href="listar.php">

Volver

</a>

</div>

</body>

</html>