<?php

//conectar a la base de datos
$conexion=mysqli_connect("localhost","root","", "practica1");
$usuario=$_POST['nombre'];
$clave=$_POST['clave'];
$clave2=$_POST['clave2'];
$consulta="SELECT * FROM usuario WHERE nombre='".$usuario . "'";
$resultado= $conexion->query($consulta);


 $row = $resultado->fetch_array(MYSQLI_ASSOC);

 	$faltacampo = 0;

 	if($usuario==NULL) {
	echo '<script language="javascript">
	alert("Ingrese un Usuario");
	window.location.href="registrarse.php";
	</script>';
	$faltacampo = 1;
	}

	if($clave==NULL) {
	echo '<script language="javascript">
	alert("Ingrese una clave");
	window.location.href="registrarse.php";
	</script>';
	$faltacampo = 1;
	}

	if($clave2==NULL) {
	echo '<script language="javascript">
	alert("Ingrese la clave de confirmacion");
	window.location.href="registrarse.php";
	</script>';
	$faltacampo = 1;
	}

	$noigual = 0;
 	if (isset($_POST['boton'])) {
			if ($_POST['clave'] != $_POST['clave2']) {
			echo '<script language="javascript">
			alert("Las claves introducidas no son iguales");
			window.location.href="registrarse.php";
			</script>';
			$noigual = 1;
			}
		}

 	if(strcmp($usuario, $row['nombre']) === 0){
 	echo '<script language="javascript">
	alert("El usuario ya esta escogido");
	window.location.href="registrarse.php";
	</script>';
	$registro = 1;

	}else {
	$registro = 0;
}


	if ($noigual == 0 && $faltacampo != 1) {

	if($registro == 0) {
		$query = "INSERT INTO usuario (nombre,clave)
					VALUES ('". $usuario ."', '" . md5($_POST['clave']) . "')";

		$resultado2 = $conexion->query($query);
		if (!$resultado2) {
	    $hecho = 0;
		}else {
		$hecho = 1;
		}
	}else {
		$hecho = 0;
	}
}

mysqli_free_result($resultado);
mysqli_close($conexion);

ob_start();
    include('../html/header.html');
    $header = ob_get_contents();
    ob_end_clean();

ob_start();
    include('../html/footer.html');
    $footer = ob_get_contents();
    ob_end_clean();

echo $header;
?>


	<div class="section">
		<?php

		if ($noigual == 0) {

			if ($hecho == 1) {
			
			echo $usuario.', se ha registrado correctamente';
			}
}
		?>
		<br>
		<a href="/Practica/index.php">Volver</a>		
	</div>

<?php echo $footer; ?>
