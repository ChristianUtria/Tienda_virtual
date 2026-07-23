<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$mensaje = "";
$tipo = "";

$id = $_GET["id"];

$sqlProducto = "SELECT * FROM productos WHERE id='$id'";
$resultadoProducto = mysqli_query($conexion, $sqlProducto);

if(mysqli_num_rows($resultadoProducto) == 0){

    die("Producto no encontrado.");

}

$producto = mysqli_fetch_assoc($resultadoProducto);

$sqlCategorias = "SELECT * FROM categorias";
$categorias = mysqli_query($conexion, $sqlCategorias);

if(isset($_POST["actualizar"])){

    $nombre = trim($_POST["nombre"]);
    $descripcion = trim($_POST["descripcion"]);
    $precio = trim($_POST["precio"]);
    $stock = trim($_POST["stock"]);
    $categoria = $_POST["categoria"];

    if(
        empty($nombre) ||
        empty($descripcion) ||
        empty($precio) ||
        empty($stock) ||
        empty($categoria)
    ){

        $mensaje = "Todos los campos son obligatorios.";
        $tipo = "error";

    }else{

        $sql = "UPDATE productos SET

        nombre='$nombre',
        descripcion='$descripcion',
        precio='$precio',
        stock='$stock',
        categoria_id='$categoria'

        WHERE id='$id'";

        if(mysqli_query($conexion,$sql)){

            header("Location: listar.php");
            exit();

        }else{

            $mensaje = "Error al actualizar.";
            $tipo = "error";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Editar Producto</title>

<link rel="stylesheet" href="../../assets/css/estilos_editar_producto.css">

</head>

<body>

<div class="caja_formulario">

<h1><i class="bi bi-pencil"></i> Editar Producto</h1>

<?php

if($mensaje != ""){

    echo "<p class='$tipo'>$mensaje</p>";

}

?>

<form method="POST">

<input
type="text"
name="nombre"
value="<?php

echo isset($nombre)
? $nombre
: $producto["nombre"];

?>">

<textarea
name="descripcion"><?php

echo isset($descripcion)
? $descripcion
: $producto["descripcion"];

?></textarea>

<input
type="number"
name="precio"
value="<?php

echo isset($precio)
? $precio
: $producto["precio"];

?>">

<input
type="number"
name="stock"
value="<?php

echo isset($stock)
? $stock
: $producto["stock"];

?>">

<select name="categoria">

<?php

while($cat=mysqli_fetch_assoc($categorias)){

?>

<option

value="<?php echo $cat["id"]; ?>"

<?php

$seleccionada = isset($categoria)
? $categoria
: $producto["categoria_id"];

if($seleccionada == $cat["id"]){

echo "selected";

}

?>

>

<?php echo $cat["nombre"]; ?>

</option>

<?php } ?>

</select>

<button
type="submit"
name="actualizar">

<i class="bi bi-save"></i> Actualizar producto

</button>

</form>

<a href="listar.php">

<i class="bi bi-arrow-left"></i> Volver

</a>

</div>

</body>

</html>