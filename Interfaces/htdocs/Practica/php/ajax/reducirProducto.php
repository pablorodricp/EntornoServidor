<?php

include('../producto.php');

if (isset($_POST['reducir'])) {

	$producto = $_POST['reducir'];


	//Usuario identificado
	if (isset($_SESSION['nombreusuario'])) {
	
	$consulta = "SELECT * FROM carro WHERE codigo='". $usuario ."'AND codigoprod='$producto'";
	$resultado = $conexion->query($consulta);

	$row = $resultado -> fetch_array(MYSQLI_ASSOC);

	mysqli_free_result($resultado);

	if ($row['cantidad'] > 1) {

	$consulta = "UPDATE carro set cantidad = cantidad-1 WHERE id = '".$row['id']."' AND codigoprod = '$producto' AND codigo ='".$usuario."'";

	$insercion = $conexion->query($consulta);
	}
	//Usuario no identificado
	}else {
			for ($contador = 0;$contador<sizeof($aCarrito);$contador++) {
		if ($aCarrito[$contador]['codigo'] == $producto) {
			if ($aCarrito[$contador]['cantidad'] > 1)
			$aCarrito[$contador]['cantidad'] -= 1;

			$iTemCad = time() + (60 * 60);
			setcookie('cesta2', serialize($aCarrito), $iTemCad, '/');
		}
	}
	
}

}

?>