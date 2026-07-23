<?php

session_start();

include "config/conexion.php";


$buscar = isset($_GET["buscar"]) ? trim($_GET["buscar"]) : "";

$sql = "SELECT 
productos.*,
categorias.nombre AS categoria

FROM productos

INNER JOIN categorias

ON productos.categoria_id = categorias.id

WHERE productos.stock > 0";

if(!empty($buscar)){

    $buscarEscapado = mysqli_real_escape_string($conexion, $buscar);

    $sql .= " AND productos.nombre LIKE '%$buscarEscapado%'";

}


$resultado = mysqli_query($conexion,$sql);


?>


<!DOCTYPE html>
<html lang="es">


<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Tienda Online</title>


<link rel="stylesheet" href="assets/css/estilos_inicio.css">


</head>



<body>



<header>


<h1>
<i class="bi bi-cart3"></i> Mi Tienda
</h1>



<div>


<a href="carrito/ver.php" class="enlace_carrito" title="Ver carrito">
<i class="bi bi-cart3"></i>
</a>


<?php if(isset($_SESSION["id"])){ ?>


Hola 
<?php echo $_SESSION["nombre"]; ?>


<a href="pedidos/historial.php">
<i class="bi bi-clock-history"></i> Mis compras
</a>


<a href="auth/logout.php">
<i class="bi bi-box-arrow-right"></i> Cerrar sesión
</a>


<?php }else{ ?>


<a href="auth/login.php">
<i class="bi bi-key"></i> Login
</a>


<a href="auth/registro.php">
<i class="bi bi-pencil-square"></i> Registrarse
</a>


<?php } ?>


</div>



</header>





<div class="caja_buscador">

<form method="GET" action="index.php" style="display:flex;width:100%;max-width:400px;">

<input
type="text"
name="buscar"
placeholder="Buscar producto..."
value="<?php echo htmlspecialchars($buscar); ?>">

<button type="submit">
<i class="bi bi-search"></i>
</button>

</form>

</div>


<h2 style="text-align:center">

<i class="bi bi-box-seam"></i> Productos disponibles

</h2>

<?php if(!empty($buscar)){ ?>

<p style="text-align:center">

Resultados para: "<?php echo htmlspecialchars($buscar); ?>"
&nbsp;
<a href="index.php">
<i class="bi bi-x-circle"></i> Quitar filtro
</a>

</p>

<?php } ?>




<div class="contenedor_productos">



<?php if(mysqli_num_rows($resultado) == 0){ ?>

<p style="width:100%;text-align:center;padding:30px;">

No se encontraron productos.

</p>

<?php } ?>



<?php while($producto = mysqli_fetch_assoc($resultado)){ ?>



<div class="tarjeta_producto">


<h2>

<?php echo $producto["nombre"]; ?>

</h2>



<p>

Categoría:

<b>
<?php echo $producto["categoria"]; ?>
</b>

</p>



<p>

<?php echo $producto["descripcion"]; ?>

</p>




<p class="precio_producto">

$

<?php echo number_format($producto["precio"]); ?>

</p>



<p>

Stock:

<?php echo $producto["stock"]; ?>

</p>




<a href="productos/detalle.php?id=<?php echo $producto["id"]; ?>">


<button>

<i class="bi bi-eye"></i> Ver producto

</button>


</a>



</div>



<?php } ?>



</div>



</body>


</html>