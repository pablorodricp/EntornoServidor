<?php

include('../producto.php');

if (isset($_POST['producto'])) {

	$producto = $_POST['producto'];

	$consulta = "SELECT * FROM productos WHERE nombre='$producto'";
	$resultado = $conexion->query($consulta);

	$row = $resultado->fetch_array(MYSQLI_ASSOC);

	$codigo = $row['codigoprod'];

	$nombreprod = $row['nombre'];

	$precio = $row['precio'];

	mysqli_free_result($resultado);

	//Usuario identificado
	if (isset($_SESSION['nombreusuario'])) {
		

	$consulta2 = "SELECT * FROM carro WHERE codigo='". $usuario ."'AND codigoprod='".$codigo."'";
	$resultado = $conexion->query($consulta2);

	if ($resultado->num_rows > 0) {
	$sql = "UPDATE carro SET cantidad = cantidad + 1 WHERE codigoprod='".$codigo."'AND codigo='".$usuario."'";
	}else{
	$sql = "INSERT INTO carro (codigoprod,cantidad,codigo)
		VALUES ('".$codigo."', 1, '".$usuario."')";
	
	}
	$insercion = $conexion->query($sql);


	//Usuario no identificado
	}else {

	$boolean = false;

	for ($contador = 0;$contador<sizeof($aCarrito);$contador++) {
		if ($aCarrito[$contador]['nombre'] == $nombreprod) {
			$aCarrito[$contador]['cantidad'] += 1;
			$boolean = true;
	}
}

	if ($boolean == false) {
			$iUltimaPos = count($aCarrito);
			$aCarrito[$iUltimaPos]['nombre'] = $nombreprod;
			$aCarrito[$iUltimaPos]['precio'] = $precio;
			$aCarrito[$iUltimaPos]['codigo'] = $codigo;
			$aCarrito[$iUltimaPos]['cantidad'] = 1;
		}
	
	$iTemCad = time() + (60 * 60);
	setcookie('cesta2', serialize($aCarrito), $iTemCad,'/');

	

		foreach ($aCarrito as $key => $value) {
			$sHTML .= '-> ' . $value['nombre'] . ' ' . $value['precio'] . ' ' . $value['cantidad']. ' '. $value['codigo']. '<br>';
		}


	}
}
?>