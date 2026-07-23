<?php

$host = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "tienda";
$puerto = 3307;
$conexion = mysqli_connect($host, $usuario, $password, $baseDatos, $puerto);

if (!$conexion) {

    die("Error de conexión: " . mysqli_connect_error());

}