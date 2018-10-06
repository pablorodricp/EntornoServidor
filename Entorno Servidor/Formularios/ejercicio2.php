<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ejercicio 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    form {
        float:left;
        margin:10px;
    }

    </style>
</head>
<body>

<?php

$url['rojo']='background-color: red';
$url['verde']='background-color: green';
$url['azul']='background-color: blue';

if(isset($_POST['seleccion'])) {
    //$eleccion=$_POST['select'];
    echo '<style>*{'.$url[$_POST['seleccion']].'}</style>';
}
?>

<!--BOTON 1 -->

<form method="POST">

<h1>ROJO</h1>
<input type='hidden' name='seleccion' value='rojo'>
<input type='submit'>
<br>
<br>

</form>

<!--BOTON 2 -->

<form method="POST">

<img src='http://i65.tinypic.com/2cfcy1k.jpg' width='55' height='55'>
<br>
<br>
<input type='hidden' name='seleccion' value='verde'>
<input type='submit'>

</form>

<!--BOTON 3 -->

<form method="POST">

<p>Este boton cambiara el fondo de la pagina a un color azul</p>
<input type='hidden' name='seleccion' value='azul'>
<br>
<input type='submit'>

</form>

</body>
</html>