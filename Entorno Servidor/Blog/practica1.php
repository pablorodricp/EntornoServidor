<?php
session_start();
$conexion = new mysqli('localhost', 'root', '', 'daw');

// COMPROBAR SI LA CONEXION A LA BASE DE DATOS ES CORRECTA
if ($conexion->connect_error) {
    die('Error de Conexión (' . $conexion->connect_errno . ') '
            . $conexion->connect_error);
}

// COMPRUEBA SI HAY UNA SESION INICIADA
if (isset($_SESSION['login'])) {
    echo 'Conectado a la cuenta de: '.$_SESSION['login'];
}

// LOGIN
if (isset($_POST['usuario']) && isset($_POST['pass'])) {
    $usuario = $_POST['usuario'];
    $pass = md5($_POST['pass']);
    $consulta = "SELECT * FROM usuarios WHERE user='".$usuario."'";
    $result= $conexion->query($consulta);
    if($result->num_rows>0) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        
        if(strcmp($pass , $row['pass']) === 0) {
            header('Location: index.php');
            $_SESSION['login'] = $usuario;
        }else {
            echo 'Usuario o contraseña incorrecto';
        }
    }
}


// LOGOUT
if (isset($_POST['logout'])) {
    header("Refresh:0");
    unset($_SESSION['login']);
}

// REGISTRO

if (isset($_POST['userNuevo']) && isset($_POST['passNuevo'])) {
    $usuarioN = $_POST['userNuevo'];
    $passN = md5($_POST['passNuevo']);
    $consulta = "SELECT * FROM usuarios WHERE user='".$usuarioN."'";
    $result= $conexion->query($consulta);

    if($result->num_rows>0) {
        echo 'Este usuario ya existe. Por favor escoja otro nombre';
    }else {
        if ($usuarioN != '' && $passN != '') {
        $query = "INSERT INTO usuarios (user,pass)
                    VALUES ('".$usuarioN."','".$passN."')";
        $result= $conexion->query($query);
        }else {
            echo 'Ha introducido algun campo vacio';
        }

        if($result) {
            echo $usuarioN.' Se ha registrado con exito';
        }else {
            echo 'Ha habido un error';
        }
    }
    
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Practica1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php

    if (isset($_POST['register'])){

    echo "<link rel='stylesheet' type='text/css' media='screen' href='css/estiloRegistro.css' />";

    }else {
    echo "<link rel='stylesheet' type='text/css' media='screen' href='css/estilos.css' />";
        
    }
    ?>
</head>
<body>


<!-- FORMULARIO REGISTRO -->
<div class='formRegistro'>
<h1>Registro</h1>
<form action='' method='POST'>
Usuario: <input type='text' class='celdafor' name='userNuevo'>
Contraseña: <input type='password' class='celdafor' name='passNuevo'>
<input type='submit' class='boton2' value='Enviar' name='enviarRegistro'>
</form>
</div>

<!-- FORMULARIO LOGIN -->
<div class='formulario'>
<h1>Formulario</h1>
<form action='' method='POST'>
Usuario: <input type='text' class='celdafor' name='usuario'>
Contraseña : <input type='password' class='celdafor' name='pass'>
<input type='submit' class='boton2' value='Enviar' name='login'>
<input type='submit' class='boton2' value='Registrarse' name='register'>
</form>


<form action='' method='POST'>

<?php 

if(isset($_SESSION['login'])) {
    echo "<input type='submit' class='boton2' value='Logout' name='logout'>";
}

?>

</form>

</div>
    
</body>
</html>