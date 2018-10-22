<?php
$conexion = new mysqli('localhost', 'root', '', 'daw');

if (isset($_POST['enviarArticulo'])) {
    if (isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['img'])) {
        $consulta = "INSERT INTO articulos (articulo,titulo,img) VALUES('".$_POST['desc']."','".$_POST['title']."','".$_POST['img']."')";
        $result= $conexion->query($consulta);
        header('Location: index.php');
    }else {
        echo 'Falta algun campo';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Añade Articulo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' type='text/css' media='screen' href='css/estiloRegistro.css' />
</head>
<body>
<div class='formRegistro'>
<h1>Añadir Articulo</h1>
<form action='' method='POST'>
Titulo: <input type='text' class='celdafor' name='title'>
Descripcion: <input type='text' class='celdafor' name='desc'>
Imagen(url): <input type='text' class='celdafor' name='img'>
<input type='submit' class='boton2' value='Enviar' name='enviarArticulo'>
</form>
</div>
</body>
</html>