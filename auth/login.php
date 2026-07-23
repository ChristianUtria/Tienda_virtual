<?php

session_start();

include "../config/conexion.php";

$mensaje = "";

if(isset($_POST["login"])){

    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    if(empty($correo) || empty($password)){

        $mensaje = "Todos los campos son obligatorios.";

    }else{

        $sql = "SELECT * FROM usuarios
                WHERE correo='$correo'
                AND password='$password'";

        $resultado = mysqli_query($conexion,$sql);

        if(mysqli_num_rows($resultado) > 0){

            $usuario = mysqli_fetch_assoc($resultado);

            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["rol"] = $usuario["rol"];

            if($usuario["rol"] == "admin"){

                header("Location: ../admin/dashboard.php");
                exit();

            }else{

                header("Location: ../index.php");
                exit();

            }

        }else{

            $mensaje = "Correo o contraseña incorrectos.";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<title>Iniciar sesión</title>

<link rel="stylesheet" href="../assets/css/estilos_iniciar_sesion.css">

</head>

<body>

<div class="caja_iniciar_sesion">

<h1><i class="bi bi-key"></i> Iniciar sesión</h1>

<?php

if($mensaje != ""){

    echo "<p class='error'>$mensaje</p>";

}

?>

<form method="POST">

<input
type="email"
name="correo"
placeholder="Correo"
value="<?php echo isset($correo) ? $correo : ''; ?>">

<input
type="password"
name="password"
placeholder="Contraseña">

<button type="submit" name="login">

<i class="bi bi-box-arrow-in-right"></i> Entrar

</button>

</form>

<div class="seccion_crear_cuenta">

¿No tienes una cuenta?

<br><br>

<a href="registro.php">

<i class="bi bi-pencil-square"></i> Crear cuenta

</a>

</div>

<div class="seccion_crear_cuenta">

<a href="../index.php">

<i class="bi bi-arrow-left"></i> Volver a la tienda

</a>

</div>

</div>

</body>

</html>