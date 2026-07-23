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

<title>Dashboard</title>

<style>

body{

    font-family:Arial;
    background:#f4f4f4;
    margin:30px;

}

h1{

    margin-bottom:30px;

}

.contenedor{

    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;

}

.tarjeta{

    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.15);
    text-align:center;

}

.numero{

    font-size:40px;
    font-weight:bold;
    margin-top:15px;

}

.menu{

    margin-top:40px;

}

.menu a{

    text-decoration:none;
    margin-right:10px;

}

button{

    padding:10px 20px;
    cursor:pointer;

}

</style>

</head>

<body>

<h1>Panel Administrador</h1>

<div class="contenedor">

<div class="tarjeta">

<h2>Productos</h2>

<div class="numero">

<?php echo $productos["total"]; ?>

</div>

</div>

<div class="tarjeta">

<h2>Categorías</h2>

<div class="numero">

<?php echo $categorias["total"]; ?>

</div>

</div>

<div class="tarjeta">

<h2>Usuarios</h2>

<div class="numero">

<?php echo $usuarios["total"]; ?>

</div>

</div>

<div class="tarjeta">

<h2>Ventas</h2>

<div class="numero">

<?php echo $ventas["total"]; ?>

</div>

</div>

<div class="tarjeta">

<h2>Ingresos</h2>

<div class="numero">

$<?php echo number_format($ingresos["total"]); ?>

</div>

</div>

</div>

<div class="menu">

<a href="categorias/listar.php">
<button>Categorías</button>
</a>

<a href="productos/listar.php">
<button>Productos</button>
</a>

<a href="ventas/listar.php">
<button>Ventas</button>
</a>

<a href="../auth/logout.php">
<button>Cerrar sesión</button>
</a>

</div>

</body>

</html>