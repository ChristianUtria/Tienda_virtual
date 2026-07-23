<?php

include "../config/conexion.php";

$id = $_GET["id"];

$sql = "SELECT
productos.*,
categorias.nombre AS categoria

FROM productos

INNER JOIN categorias

ON productos.categoria_id = categorias.id

WHERE productos.id='$id'";

$resultado = mysqli_query($conexion, $sql);

$producto = mysqli_fetch_assoc($resultado);

$sqlRelacionados = "SELECT *

FROM productos

WHERE categoria_id='".$producto["categoria_id"]."'

AND id!='".$producto["id"]."'

LIMIT 4";

$relacionados = mysqli_query($conexion, $sqlRelacionados);

if(mysqli_num_rows($relacionados)==0){

    $sqlRelacionados = "SELECT *

    FROM productos

    WHERE id!='".$producto["id"]."'

    LIMIT 4";

    $relacionados = mysqli_query($conexion, $sqlRelacionados);

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title><?php echo $producto["nombre"]; ?></title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:Arial;
    background:#f4f4f4;
    padding:40px;

}

.contenedor{

    max-width:1200px;
    margin:auto;
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:30px;

}

.detalle{

    background:white;
    padding:35px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.15);

}

.detalle h1{

    margin-bottom:20px;

}

.detalle p{

    margin:15px 0;
    line-height:1.6;

}

.precio{

    font-size:32px;
    color:green;
    font-weight:bold;

}

.stock{

    font-weight:bold;

}

button{

    margin-top:20px;
    padding:12px 25px;
    background:#111;
    color:white;
    border:none;
    cursor:pointer;
    border-radius:5px;

}

button:hover{

    background:#333;

}

.relacionados{

    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.15);

}

.relacionados h2{

    margin-bottom:20px;

}

.card{

    border-bottom:1px solid #ddd;
    padding:15px 0;

}

.card:last-child{

    border:none;

}

.card h3{

    margin-bottom:10px;
    font-size:18px;

}

.card p{

    color:green;
    font-weight:bold;
    margin-bottom:10px;

}

.card a{

    text-decoration:none;
    color:#0066cc;

}

.volver{

    display:inline-block;
    margin-top:25px;
    text-decoration:none;

}

</style>

</head>

<body>

<div class="contenedor">

<div class="detalle">

<h1><?php echo $producto["nombre"]; ?></h1>

<p><strong>Categoría:</strong> <?php echo $producto["categoria"]; ?></p>

<p><?php echo $producto["descripcion"]; ?></p>

<p class="precio">
$<?php echo number_format($producto["precio"]); ?>
</p>

<p class="stock">
Stock disponible: <?php echo $producto["stock"]; ?>
</p>

<a href="../carrito/agregar.php?id=<?php echo $producto["id"]; ?>">

<button>

Agregar al carrito

</button>

</a>

<br>

<a class="volver" href="../index.php">

← Volver a la tienda

</a>

</div>

<div class="relacionados">

<h2>Productos relacionados</h2>

<?php while($fila=mysqli_fetch_assoc($relacionados)){ ?>

<div class="card">

<h3><?php echo $fila["nombre"]; ?></h3>

<p>$<?php echo number_format($fila["precio"]); ?></p>

<a href="detalle.php?id=<?php echo $fila["id"]; ?>">

Ver producto

</a>

</div>

<?php } ?>

</div>

</div>

</body>

</html>