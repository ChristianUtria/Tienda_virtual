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

// Obtener categorías
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

<title>Editar Producto</title>

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

    width:450px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.2);

}

h1{

    text-align:center;

}

input,
textarea,
select{

    width:100%;
    padding:10px;
    margin-top:12px;
    box-sizing:border-box;

}

textarea{

    resize:vertical;
    height:100px;

}

button{

    width:100%;
    padding:12px;
    margin-top:20px;
    background:#111;
    color:white;
    border:none;
    cursor:pointer;

}

.error{

    color:red;
    text-align:center;
    margin-bottom:15px;

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

<h1>Editar Producto</h1>

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

Actualizar producto

</button>

</form>

<a href="listar.php">

Volver

</a>

</div>

</body>

</html>