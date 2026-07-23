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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Editar categoría</title>

<link rel="stylesheet" href="../../assets/css/estilos_editar_categoria.css">

</head>

<body>

<div class="caja_formulario">

<h2><i class="bi bi-pencil"></i> Editar categoría</h2>

<form method="POST">

<input
type="text"
name="nombre"
value="<?php echo $categoria["nombre"]; ?>">

<button
type="submit"
name="actualizar">

<i class="bi bi-save"></i> Actualizar

</button>

</form>

<a href="listar.php">

<i class="bi bi-arrow-left"></i> Volver

</a>

</div>

</body>

</html>