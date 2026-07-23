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

<title>Iniciar sesión</title>

<style>

body{

    font-family: Arial;
    background:#f4f4f4;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;

}

.login{

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

.registro{

    text-align:center;
    margin-top:20px;

}

a{

    text-decoration:none;

}

</style>

</head>

<body>

<div class="login">

<h1>Iniciar sesión</h1>

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

Entrar

</button>

</form>

<div class="registro">

¿No tienes una cuenta?

<br><br>

<a href="registro.php">

Crear cuenta

</a>

</div>

</div>

</body>

</html>