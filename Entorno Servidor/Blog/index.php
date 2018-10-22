<?php
session_start();
$conexion = new mysqli('localhost', 'root', '', 'daw');

if(isset($_SESSION['login'])) {
    //echo 'Hola '.$_SESSION['login'];
} 

if(isset($_POST['logout'])) {
    header("Location: practica1.php");
    unset($_SESSION['login']);
}

// COMPROBAR SI LA CONEXION A LA BASE DE DATOS ES CORRECTA
if ($conexion->connect_error) {
    die('Error de Conexión (' . $conexion->connect_errno . ') '
            . $conexion->connect_error);
}


$css = ['css/estilos1.css','css/estilos2.css','css/estilos3.css'];
$indice = 0;

//SACA UN ARTICULO
$consulta = "SELECT * FROM articulos";
$result= $conexion->query($consulta);
$row = $result->fetch_all(MYSQLI_ASSOC);

// Añadir articulo

if (isset($_POST['añadeArticulo'])) {
    header('Location: add.php');
}

// Enviar comentario
if (isset($_POST['comentar'])) {
    $consulta = "INSERT INTO comentarios (id,comentario) VALUES('".$_POST['id']."','".$_POST['texto']."')";
    $result= $conexion->query($consulta);
}

// Sacar los comentarios

$consulta= "SELECT * FROM comentarios";
$result= $conexion->query($consulta);
$rowComentarios = $result->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pagina Principal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (isset($_POST['valor'])) {
        $indice = $_POST['valor'];
    }
    echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$css[$indice].'"/>'
    ?>  
</head>
<body>
<a href="practica1.php">Login</a>

<br>

<?php

if (isset($_SESSION['login'])) {

echo "<form method='POST'>

<input type='submit' value='Logout' name='logout'>

</form>";

}

$j = 0;
for ($i=0;$i<sizeof($row);$i++) {
    echo '<br>';
    echo '<h1>'.$row[$i]['titulo'].'</h1>'.'<br>';
    echo '<p>'.$row[$i]['articulo'].'</p>';
    echo '<img src="'.$row[$i]['img'].'" height="200" width="200">';
    echo '<br>';
    echo 'Comentarios: ';
    echo '<br>';
    do {
        if (isset($rowComentarios[$j]['id'])) {
            if ($rowComentarios[$j]['id'] == $i) {
                echo $rowComentarios[$j]['comentario'];
                echo '<br>';
                $j++;
            }
        }
    }while(isset($rowComentarios[$j]['id']) && $rowComentarios[$j]['id'] == $i);
    

    echo '<form method="POST">
        <input type="text" name="texto">
        <input type="hidden" name="id" value="'.$i.'">
        <input type="submit" name="comentar" value="Comentar">
        </form>';
}

?>

<form method='POST'>

<input type='hidden' value='0' name='valor'>
<input type='submit' value='Boton 1'>

</form>

<form method='POST'>
<input type='hidden' value='1' name='valor'>
<input type='submit' value='Boton 2'>

</form>

<form method='POST'>
<input type='hidden' value='2' name='valor'>
<input type='submit' value='Boton 3'>

</form>

<form method='POST'>
<input type='hidden' name='añadeArticulo'>
<input type='submit' value='Añadir articulo'>

</form>

</body>
</html>