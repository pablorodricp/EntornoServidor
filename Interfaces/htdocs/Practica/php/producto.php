<?php
session_start(); //Inicio sesion 

$conexion = mysqli_connect("localhost","root","","practica1");


if (isset($_SESSION['nombreusuario'])) {
	$usuario = $_SESSION['codigo'];
}else {

	$aCarrito = array();
	$sHTML = '';	

	if(isset($_COOKIE['cesta2'])) {
			$aCarrito = unserialize($_COOKIE['cesta2']);
	}
}

?>