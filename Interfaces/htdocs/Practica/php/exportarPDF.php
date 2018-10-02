<?php

include('producto.php');

$conexion = mysqli_connect("localhost","root","","practica1");

if (isset($_SESSION['nombreusuario'])) {

if (isset($_POST['boton'])) {

$usuario = $_SESSION['codigo'];

$consulta = "SELECT productos.nombre,cantidad,precio FROM carro INNER JOIN productos ON carro.codigoprod = productos.codigoprod WHERE carro.codigo ='".$usuario. "'";
$result = $conexion->query($consulta);


require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',20);

		$pdf->Cell(30,12,'CESTA');


$pdf->SetFont('Arial','B',12);
	
		$pdf->Cell(30,12,'----------------------------------------------------------------------------------------');

		$suma = 0;



while($rows = mysqli_fetch_assoc($result)) {
$pdf->SetFont('Arial','',12);
$pdf->Ln();


		$aux = $rows['precio'];
		

		$pdf->SetFont('Arial','',12);
		$pdf->Ln();

		
		$pdf->Cell(30,12,'Producto:');
		$pdf->Cell(30,12,$rows['nombre']);
		$pdf->Cell(30,12,'Cantidad:');
		$pdf->Cell(30,12,$rows['cantidad']);
		$pdf->Cell(30,12,'Precio:');
		$pdf->Cell(5,12,$rows['precio']);
		$pdf->Cell(30,12,chr(128));
		$pdf->Ln();

		
		$suma += $aux;

}

	$pdf->Cell(30,12,'-------------------------------------------------------------------------------------------------------------');
		$pdf->Ln();
		$pdf->Cell(133,12,'Total:','','','R');
		$pdf->Cell(21,12,$suma,'','','R');
		$pdf->Cell(20,12,chr(128));

		$pdf->Ln();
$pdf->Output();

MYSQLI_FREE_RESULT($result);

}
}else {

require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',20);

		$pdf->Cell(30,12,'CESTA');


$pdf->SetFont('Arial','B',12);
	
		$pdf->Cell(30,12,'----------------------------------------------------------------------------------------');

		$suma = 0;
for ($i = 0;$i<sizeof($aCarrito);$i++) {
	for ($j = 0;$j<sizeof($aCarrito[$i]);$j++) {
		$j = 4;

		$aux = $aCarrito[$i]['precio'];
		

		$pdf->SetFont('Arial','',12);
		$pdf->Ln();

		
		$pdf->Cell(30,12,'Producto:');
		$pdf->Cell(30,12,$aCarrito[$i]['nombre']);
		$pdf->Cell(30,12,'Cantidad:');
		$pdf->Cell(30,12,$aCarrito[$i]['cantidad']);
		$pdf->Cell(30,12,'Precio:');
		$pdf->Cell(5,12,$aCarrito[$i]['precio']);
		$pdf->Cell(30,12,chr(128));
		$pdf->Ln();

		
		$suma += $aux;
}
}
		$pdf->Cell(30,12,'-------------------------------------------------------------------------------------------------------------');
		$pdf->Ln();
		$pdf->Cell(133,12,'Total:','','','R');
		$pdf->Cell(21,12,$suma,'','','R');
		$pdf->Cell(20,12,chr(128));

		$pdf->Ln();


$pdf->Output();
}

$consulta = "SELECT nombre FROM usuario";
$result = $conexion->query($consulta);

require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
while ($field_info = mysqli_fetch_field($result)) {
$pdf->Cell(47,12,$field_info->name,1);
}
while($rows = mysqli_fetch_assoc($result)) {
$pdf->SetFont('Arial','',12);
$pdf->Ln();
foreach($rows as $column) {
$pdf->Cell(47,12,$column,1);
}
}
$pdf->Output();


?>