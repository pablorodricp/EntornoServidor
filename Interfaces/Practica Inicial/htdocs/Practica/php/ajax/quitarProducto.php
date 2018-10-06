<?php

include('../producto.php');

if (isset($_POST['quita'])) {

	$producto = $_POST['quita'];


	//Usuario identificado
	if (isset($_SESSION['nombreusuario'])) {
	$consulta = "SELECT * FROM carro WHERE codigo='". $usuario ."'AND codigoprod='$producto'";
	$resultado = $conexion->query($consulta);

	$row = $resultado -> fetch_array(MYSQLI_ASSOC);

	mysqli_free_result($resultado);

	$consulta = "DELETE FROM carro WHERE id = '". $row['id'] ."' AND codigoprod = $producto AND codigo ='". $usuario ."'";

	$insercion = $conexion->query($consulta);

	//Usuario no identificado	
	}else {
		for ($contador = 0;$contador<sizeof($aCarrito);$contador++) {
		if ($aCarrito[$contador]['codigo'] == $producto) {
			unset($aCarrito[$contador]);
			$aCarrito = array_merge($aCarrito);

			$iTemCad = time() + (60 * 60);
			setcookie('cesta2', serialize($aCarrito), $iTemCad, '/');
		}
	}
	
	}
	}

?>