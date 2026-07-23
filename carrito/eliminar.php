<?php

session_start();

include "../config/conexion.php";

$id = $_GET["id"];

mysqli_query($conexion,

"DELETE FROM carrito

WHERE id='$id'");

header("Location: ver.php");

exit();

?>