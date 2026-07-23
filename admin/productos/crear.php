<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$mensaje = "";
$tipo = "";

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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Nuevo Producto</title>

<link rel="stylesheet" href="../../assets/css/estilos_nuevo_producto.css">

</head>

<body>

<div class="caja_formulario">

<h1><i class="bi bi-plus-lg"></i> Nuevo Producto</h1>

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

<i class="bi bi-save"></i> Guardar producto

</button>

</form>

<a href="listar.php">

<i class="bi bi-arrow-left"></i> Volver al listado

</a>

</div>

</body>

</html>