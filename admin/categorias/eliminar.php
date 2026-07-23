<?php

include "../../config/seguridad.php";
include "../../config/conexion.php";

$id = $_GET["id"];

$sql = "DELETE FROM categorias
        WHERE id='$id'";

mysqli_query($conexion, $sql);

header("Location: listar.php");
exit();

?>