<?php

include "../config/seguridad.php";
include "../config/conexion.php";

$productos = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM productos")
);

$categorias = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM categorias")
);

$usuarios = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM usuarios")
);

$ventas = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT COUNT(*) AS total FROM ventas")
);

$ingresos = mysqli_fetch_assoc(
    mysqli_query($conexion, "SELECT IFNULL(SUM(total),0) AS total FROM ventas")
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Dashboard</title>

<link rel="stylesheet" href="../assets/css/estilos_panel_admin.css">

</head>

<body>

<h1><i class="bi bi-speedometer2"></i> Panel Administrador</h1>

<div class="contenedor_tarjetas">

<div class="tarjeta_resumen">

<h2><i class="bi bi-box-seam"></i> Productos</h2>

<div class="numero_total">

<?php echo $productos["total"]; ?>

</div>

</div>

<div class="tarjeta_resumen">

<h2><i class="bi bi-tag"></i> Categorías</h2>

<div class="numero_total">

<?php echo $categorias["total"]; ?>

</div>

</div>

<div class="tarjeta_resumen">

<h2><i class="bi bi-people"></i> Usuarios</h2>

<div class="numero_total">

<?php echo $usuarios["total"]; ?>

</div>

</div>

<div class="tarjeta_resumen">

<h2><i class="bi bi-cash-stack"></i> Ventas</h2>

<div class="numero_total">

<?php echo $ventas["total"]; ?>

</div>

</div>

<div class="tarjeta_resumen">

<h2><i class="bi bi-currency-dollar"></i> Ingresos</h2>

<div class="numero_total">

$<?php echo number_format($ingresos["total"]); ?>

</div>

</div>

</div>

<div class="menu_opciones">

<a href="categorias/listar.php">
<button><i class="bi bi-tag"></i> Categorías</button>
</a>

<a href="productos/listar.php">
<button><i class="bi bi-box-seam"></i> Productos</button>
</a>

<a href="ventas/listar.php">
<button><i class="bi bi-cash-stack"></i> Ventas</button>
</a>

<a href="../index.php">
<button><i class="bi bi-arrow-left"></i> Volver a la tienda</button>
</a>

<a href="../auth/logout.php">
<button><i class="bi bi-box-arrow-right"></i> Cerrar sesión</button>
</a>

</div>

</body>

</html>