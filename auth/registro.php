<?php

include "../config/conexion.php";

$mensaje = "";
$tipo = "";

if(isset($_POST["registrar"])){

    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    if(empty($nombre) || empty($correo) || empty($password)){

        $mensaje = "Todos los campos son obligatorios.";
        $tipo = "error";

    }else{

        $verificar = "SELECT * FROM usuarios WHERE correo='$correo'";
        $consulta = mysqli_query($conexion, $verificar);

        if(mysqli_num_rows($consulta) > 0){

            $mensaje = "El correo ya está registrado.";
            $tipo = "error";

        }else{

            $rol = "usuario";

            $sql = "INSERT INTO usuarios
            (nombre, correo, password, rol)
            VALUES
            ('$nombre','$correo','$password','$rol')";

            $resultado = mysqli_query($conexion, $sql);

            if($resultado){

                $mensaje = "Usuario registrado correctamente.";
                $tipo = "success";

            }else{

                $mensaje = "Error al registrar el usuario.";
                $tipo = "error";

            }

        }

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Crear cuenta</title>

<link rel="stylesheet" href="../assets/css/estilos_crear_cuenta.css">

</head>

<body>

<div class="caja_crear_cuenta">

<h1><i class="bi bi-pencil-square"></i> Crear cuenta</h1>

<?php

if($mensaje != ""){

    echo "<p class='$tipo'>$mensaje</p>";

}

?>

<form method="POST">

<input
type="text"
name="nombre"
placeholder="Nombre completo"
value="<?php echo isset($nombre) ? $nombre : ''; ?>">

<input
type="email"
name="correo"
placeholder="Correo electrónico"
value="<?php echo isset($correo) ? $correo : ''; ?>">

<input
type="password"
name="password"
placeholder="Contraseña">

<button type="submit" name="registrar">

<i class="bi bi-check-circle"></i> Registrarse

</button>

</form>

<div class="seccion_iniciar_sesion">

¿Ya tienes una cuenta?

<br><br>

<a href="login.php">

<i class="bi bi-key"></i> Iniciar sesión

</a>

</div>

<div class="seccion_iniciar_sesion">

<a href="../index.php">

<i class="bi bi-arrow-left"></i> Volver a la tienda

</a>

</div>

</div>

</body>

</html>