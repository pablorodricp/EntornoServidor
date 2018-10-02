<?php
session_start();


$conexion = mysqli_connect("localhost","root","","practica1");
$consulta = "SELECT nombre FROM usuario";
$result = $conexion->query($consulta);


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


	<div class="nav">
		<a href="/Practica/index.php">Inicio</a>
	</div>

	<div class="nav">
		<a href="identificacion.php">Login</a>

	</div>

	<div class="section2">

		
	<div class="formulario">
		<h1>Panel Registro</h1>
		<br>
		<form action="registrar.php" method="post">
    	Nombre: <input type="text" class="celdafor" name="nombre"><br>
    	Contraseña: <input type="password" class="celdafor" name="clave"><br>
    	Confirmar contraseña: <input type="password" class="celdafor" name="clave2"><br>
    	<input type="submit" class="boton2" value="Registrar" name="boton">
		</form>
	</div>

	</div>

<?php echo $footer; ?>