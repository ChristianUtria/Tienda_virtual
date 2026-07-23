<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

if(!isset($_GET["id"])){

    header("Location: listar.php");
    exit();

}

$id = $_GET["id"];

$sql = "SELECT * FROM productos WHERE id='$id'";
$resultado = mysqli_query($conexion, $sql);

if(mysqli_num_rows($resultado) == 0){

    header("Location: listar.php");
    exit();

}

$sql = "DELETE FROM productos WHERE id='$id'";

if(mysqli_query($conexion, $sql)){

    header("Location: listar.php");
    exit();

}else{

    echo "Error al eliminar el producto.";

}

?>