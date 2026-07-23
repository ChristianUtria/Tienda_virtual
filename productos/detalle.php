<?php

session_start();

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

AND stock > 0

LIMIT 4";

$relacionados = mysqli_query($conexion, $sqlRelacionados);

if(mysqli_num_rows($relacionados)==0){

    $sqlRelacionados = "SELECT *

    FROM productos

    WHERE id!='".$producto["id"]."'

    AND stock > 0

    LIMIT 4";

    $relacionados = mysqli_query($conexion, $sqlRelacionados);

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title><?php echo $producto["nombre"]; ?></title>

<link rel="stylesheet" href="../assets/css/estilos_detalle_producto.css">

</head>

<body>

<div class="contenedor_detalle">

<div class="caja_detalle_producto">

<h1><?php echo $producto["nombre"]; ?></h1>

<p><strong>Categoría:</strong> <?php echo $producto["categoria"]; ?></p>

<p><?php echo $producto["descripcion"]; ?></p>

<p class="precio_producto">
$<?php echo number_format($producto["precio"]); ?>
</p>

<p class="texto_stock">
<?php if($producto["stock"] > 0){ ?>

Stock disponible: <?php echo $producto["stock"]; ?>

<?php }else{ ?>

<span style="color:red;">Agotado</span>

<?php } ?>
</p>

<?php if(isset($_SESSION["carrito_msg"])){ ?>

<p style="color:red;font-weight:bold;">

<?php echo $_SESSION["carrito_msg"]; unset($_SESSION["carrito_msg"]); ?>

</p>

<?php } ?>

<?php if($producto["stock"] > 0){ ?>

<a href="../carrito/agregar.php?id=<?php echo $producto["id"]; ?>">

<button>

<i class="bi bi-cart3"></i> Agregar al carrito

</button>

</a>

<?php }else{ ?>

<button disabled style="background:#999;cursor:not-allowed;">

<i class="bi bi-x-circle"></i> Agotado

</button>

<?php } ?>

<br>

<a class="enlace_volver" href="../index.php">

<i class="bi bi-arrow-left"></i> Volver a la tienda

</a>

</div>

<div class="caja_relacionados">

<h2><i class="bi bi-box-seam"></i> Productos relacionados</h2>

<?php while($fila=mysqli_fetch_assoc($relacionados)){ ?>

<div class="tarjeta_relacionado">

<h3><?php echo $fila["nombre"]; ?></h3>

<p>$<?php echo number_format($fila["precio"]); ?></p>

<a href="detalle.php?id=<?php echo $fila["id"]; ?>">

<i class="bi bi-eye"></i> Ver producto

</a>

</div>

<?php } ?>

</div>

</div>

</body>

</html>