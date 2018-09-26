<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ejercicio 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php

$url['correo']='http://www.gmail.com';
$url['blog']='https://hardzone.es/';
$url['yt']='https://www.youtube.com/watch?v=vryU0eJ8cQ4';

if(isset($_POST['select'])) {
    //$eleccion=$_POST['select'];
    header('Location: '.$url[$_POST['select']]);
}
?>

<form method="POST">
<select name="select">
  <option value="correo">Mi correo</option> 
  <option value="blog" selected>Mi blog</option>
  <option value="yt">Mi youtuber</option>
</select>

<input type='submit'>
</form>

</body>
</html>