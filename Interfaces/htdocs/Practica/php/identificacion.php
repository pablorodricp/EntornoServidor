<?php
session_start();


$conexion = mysqli_connect("localhost","root","","practica1");
$consulta = "SELECT * FROM usuario";
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

echo $header
?>


	<div class="nav">
		<a href="/Practica/index.php">Inicio</a>
	</div>

	<div class="registro">
		<a href="registrarse.php">Registrarse</a>

	</div>

	<div class="section2">
		<div class="formulario">
		<h1>Identificarse</h1>
		<form action="login.php" method="post">
    	Nombre: <input type="text" class="celdafor" name="nombre"><br>
    	Contraseña: <input type="password" class="celdafor" name="clave"><br>
    	<input type="submit" class="boton2" value="Ingresar" name="boton">
		</form>
		</div>
	</div>

	<?php echo $footer; ?>