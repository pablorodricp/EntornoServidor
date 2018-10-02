<?php

$conexion = mysqli_connect("localhost","root","","practica1");
$consulta = "SELECT nombre FROM usuario";
$result = $conexion->query($consulta);

if ($result->num_rows > 0) {

	$delimitador = ",";
	$nombrearchivo = "Usuarios_". date('d-m-Y').".csv";

	$f = fopen('php://memory', 'w');

	$filas = array('nombre');
    fputcsv($f, $filas, $delimitador);

    while($row = $result->fetch_assoc()){
        $datos = array($row['nombre']);
        fputcsv($f, $datos, $delimitador);
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $nombrearchivo . '";');

    fpassthru($f);
}

?>