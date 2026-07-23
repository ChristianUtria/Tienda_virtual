<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$mensaje = "";
$tipo = "";

// Obtener categorías
$sqlCategorias = "SELECT * FROM categorias";
$categorias = mysqli_query($conexion, $sqlCategorias);

if(isset($_POST["guardar"])){

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

        $sql = "INSERT INTO productos
        (
            nombre,
            descripcion,
            precio,
            stock,
            categoria_id
        )
        VALUES
        (
            '$nombre',
            '$descripcion',
            '$precio',
            '$stock',
            '$categoria'
        )";

        if(mysqli_query($conexion,$sql)){

            header("Location: listar.php");
            exit();

        }else{

            $mensaje = "Error al guardar el producto.";
            $tipo = "error";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Nuevo Producto</title>

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
    margin-bottom:20px;

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

button:hover{

    background:#333;

}

.error{

    color:red;
    text-align:center;
    margin-bottom:15px;

}

a{

    text-decoration:none;
    display:block;
    text-align:center;
    margin-top:20px;

}

</style>

</head>

<body>

<div class="formulario">

<h1>Nuevo Producto</h1>

<?php

if($mensaje != ""){

    echo "<p class='$tipo'>$mensaje</p>";

}

?>

<form method="POST">

<input
type="text"
name="nombre"
placeholder="Nombre del producto"
value="<?php echo isset($nombre) ? $nombre : ''; ?>">

<textarea
name="descripcion"
placeholder="Descripción"><?php echo isset($descripcion) ? $descripcion : ''; ?></textarea>

<input
type="number"
name="precio"
placeholder="Precio"
value="<?php echo isset($precio) ? $precio : ''; ?>">

<input
type="number"
name="stock"
placeholder="Stock"
value="<?php echo isset($stock) ? $stock : ''; ?>">

<select name="categoria">

<option value="">Seleccione una categoría</option>

<?php

mysqli_data_seek($categorias,0);

while($cat = mysqli_fetch_assoc($categorias)){

?>

<option
value="<?php echo $cat["id"]; ?>"

<?php

if(isset($categoria) && $categoria == $cat["id"]){

    echo "selected";

}

?>

>

<?php echo $cat["nombre"]; ?>

</option>

<?php

}

?>

</select>

<button
type="submit"
name="guardar">

Guardar producto

</button>

</form>

<a href="listar.php">

Volver al listado

</a>

</div>

</body>

</html>