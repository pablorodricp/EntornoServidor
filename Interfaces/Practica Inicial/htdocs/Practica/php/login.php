<?php
session_start();


//conectar a la base de datos
$conexion=mysqli_connect("localhost","root","", "practica1");
$usuario=$_POST['nombre'];
$clave=md5($_POST['clave']);
$clavesin=($_POST['clave']);
$consulta="SELECT * FROM usuario WHERE nombre='".$usuario . "'";
$resultado= $conexion->query($consulta);

$faltacampo = 0;

 	if($usuario==NULL) {
	echo '<script language="javascript">
	alert("Ingrese un Usuario");
	window.location.href="identificacion.php";
	</script>';
	$faltacampo = 1;
	}

	if($clavesin==NULL) {
	echo '<script language="javascript">
	alert("Ingrese una clave");
	window.location.href="identificacion.php";
	</script>';
	$faltacampo = 1;
	}

if ($faltacampo != 1) {

if ($resultado->num_rows > 0) {     
 
 $row = $resultado->fetch_array(MYSQLI_ASSOC);
	

 	if(strcmp($clave, $row['clave']) === 0){

	$_SESSION['nombreusuario'] = $_POST['nombre'];
	$_SESSION['codigo'] = $row['codigo'];

	}

}

}

if (isset($_SESSION['nombreusuario'])) {
	header('Location: /Practica/index.php');
}else {
	echo '<script language="javascript">
	alert("Ha introducido un usuario o contraseña incorrecto");
	window.location.href="identificacion.php";
	</script>';
}



mysqli_free_result($resultado);
mysqli_close($conexion);
?>