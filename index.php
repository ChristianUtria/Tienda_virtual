<?php

session_start();

include "config/conexion.php";


$sql = "SELECT 
productos.*,
categorias.nombre AS categoria

FROM productos

INNER JOIN categorias

ON productos.categoria_id = categorias.id";


$resultado = mysqli_query($conexion,$sql);


?>


<!DOCTYPE html>
<html lang="es">


<head>

<meta charset="UTF-8">

<title></title>


<style>


body{

    font-family: Arial;
    background:#f4f4f4;
    margin:0;

}


header{

    background:#111;
    color:white;
    padding:20px;
    display:flex;
    justify-content:space-between;

}


header a{

    color:white;
    text-decoration:none;
    margin-left:15px;

}



.contenedor{

    display:flex;
    flex-wrap:wrap;
    padding:20px;

}



.producto{


    background:white;

    width:250px;

    margin:15px;

    padding:20px;

    border-radius:10px;

    box-shadow:0 0 10px #ccc;


}



.producto h2{

    color:#333;

}



.precio{

    color:green;

    font-size:20px;

    font-weight:bold;

}



button{

    background:#111;

    color:white;

    border:none;

    padding:10px;

    cursor:pointer;

    border-radius:5px;

}



</style>


</head>



<body>



<header>


<h1>
Mi Tienda
</h1>



<div>


<?php if(isset($_SESSION["id"])){ ?>


Hola 
<?php echo $_SESSION["nombre"]; ?>


<a href="auth/logout.php">
Cerrar sesión
</a>


<?php }else{ ?>


<a href="auth/login.php">
Login
</a>


<a href="auth/registro.php">
Registrarse
</a>


<?php } ?>


</div>



</header>





<h2 style="text-align:center">

Productos disponibles

</h2>




<div class="contenedor">



<?php while($producto = mysqli_fetch_assoc($resultado)){ ?>



<div class="producto">


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




<p class="precio">

$

<?php echo number_format($producto["precio"]); ?>

</p>



<p>

Stock:

<?php echo $producto["stock"]; ?>

</p>




<a href="productos/detalle.php?id=<?php echo $producto["id"]; ?>">


<button>

Ver producto

</button>


</a>



</div>



<?php } ?>



</div>



</body>


</html>