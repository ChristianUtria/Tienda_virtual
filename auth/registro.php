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

<title>Crear cuenta</title>

<style>

body{

    font-family: Arial;
    background:#f4f4f4;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;

}

.registro{

    width:350px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.2);

}

h1{

    text-align:center;

}

input{

    width:100%;
    padding:10px;
    margin-top:10px;
    box-sizing:border-box;

}

button{

    width:100%;
    padding:10px;
    margin-top:20px;
    background:#111;
    color:white;
    border:none;
    cursor:pointer;

}

button:hover{

    background:#333;

}

.error{

    color:red;
    text-align:center;
    margin-bottom:15px;

}

.success{

    color:green;
    text-align:center;
    margin-bottom:15px;

}

.login{

    text-align:center;
    margin-top:20px;

}

a{

    text-decoration:none;

}

</style>

</head>

<body>

<div class="registro">

<h1>Crear cuenta</h1>

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

Registrarse

</button>

</form>

<div class="login">

¿Ya tienes una cuenta?

<br><br>

<a href="login.php">

Iniciar sesión

</a>

</div>

</div>

</body>

</html>