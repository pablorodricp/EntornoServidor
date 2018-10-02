<?php

include('producto.php');

$conexion = mysqli_connect("localhost","root","","practica1");

$consulta = "SELECT carro.codigo,usuario.nombre as usuario,carro.codigoprod as producto,productos.nombre,cantidad,precio,img
			FROM carro
			INNER JOIN usuario ON carro.codigo = usuario.codigo
			INNER JOIN productos on carro.codigoprod = productos.codigoprod";
$result = $conexion->query($consulta);


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

	<div class="inicio">
		<a href="../index.php">Inicio</a>
	</div>

	<?php
	if (isset($_SESSION['nombreusuario']))
		echo '<div class="conectado">'.$_SESSION['nombreusuario'].'</div>'

	 ?>

	<div class="section2">

		<div class="carrito">
			<?php 
			if (isset($_SESSION['nombreusuario'])) {
			while($u = $result->fetch_assoc()) {
				if ($_SESSION['nombreusuario'] == $u['usuario']){


			echo 
			'<table>
				<tr>
					
					<th></th>

					<th>Producto</th>
						
					<th>Cantidad</th>

					<th>Precio</th>

					<th></th>

				</tr>
				<tr>
					<td>

					<div>
					<img src="data:image/jpeg;base64,'.base64_encode($u['img']) .'" />

					</div>

					</td>
					
					<td>'.$u['nombre'].'</td>
					<td>'.$u['cantidad'].'</td>
					<td>'.$u['precio'].'€</td>
					<td>

					<input type="hidden" name='.$u['producto'].' id="quita'.$u['producto'].'" value='.$u['producto'].'>
						<input type="image" width="10%" name='.$u['producto'].' alt="borrar" src="../img/boton.png" onclick="eliminado($(quita'.$u['producto'].').val())">

						
						<input type="hidden" name=anadir'.$u['nombre'].' id="anadi'.$u['producto'].'" value='.$u['producto'].'>
						<input type="image" width="10%" name="'.$u['producto'].'" alt="borrar" src="../img/add.png" onclick="anadir($(anadi'.$u['producto'].').val())">

						
						<input type="hidden" name=reducir'.$u['producto'].' id="reduci'.$u['producto'].'" value='.$u['producto'].'>
						<input type="image" width="10%" name='.$u['producto'].' alt="borrar" src="../img/minus.png" onclick="reducir($(reduci'.$u['producto'].').val())"></td>
					
				</tr>
			</table>';
		    }
		    }

		}else {


			$consulta = "SELECT * FROM productos";

			$resultado = $conexion->query($consulta);

			$row = $resultado->fetch_all(MYSQLI_ASSOC);

			mysqli_free_result($resultado);

			

			for ($contador = 0;$contador<sizeof($aCarrito);$contador++) {

				$index = $aCarrito[$contador]['codigo'] -1;

			echo 
			'<table>
				<tr>

					<th></th>

					<th>Producto</th>
						
					<th>Cantidad</th>

					<th>Precio</th>

					<th></th>
				</tr>
				<tr>

					<td>

					<div>
					<img src="data:image/jpeg;base64,'.base64_encode($row[$index]['img']) .'" />

					</div>

					</td>

					<td>'.$aCarrito[$contador]['nombre'].'</td>
					<td>'.$aCarrito[$contador]['cantidad'].'</td>
					<td>'.$aCarrito[$contador]['precio'].'€</td>
					<td>
					<td>

						<input type="hidden" name='.$aCarrito[$contador]['codigo'].' id="quita'.$aCarrito[$contador]['codigo'].'" value='.$aCarrito[$contador]['codigo'].'>
						<input type="image" width="10%" name='.$aCarrito[$contador]['codigo'].' alt="borrar" src="../img/boton.png" onclick="eliminado($(quita'.$aCarrito[$contador]['codigo'].').val())">

						
						<input type="hidden" name=anadir'.$aCarrito[$contador]['nombre'].' id="anadi'.$aCarrito[$contador]['codigo'].'" value='.$aCarrito[$contador]['codigo'].'>
						<input type="image" width="10%" name="'.$aCarrito[$contador]['codigo'].'" alt="borrar" src="../img/add.png" onclick="anadir($(anadi'.$aCarrito[$contador]['codigo'].').val())">

						
						<input type="hidden" name=reducir'.$aCarrito[$contador]['codigo'].' id="reduci'.$aCarrito[$contador]['codigo'].'" value='.$aCarrito[$contador]['codigo'].'>
						<input type="image" width="10%" name='.$aCarrito[$contador]['codigo'].' alt="borrar" src="../img/minus.png" onclick="reducir($(reduci'.$aCarrito[$contador]['codigo'].').val())"></td>
					
				</tr>
			</table>';
		}
	}
		    mysqli_free_result($result);

		    ?>
		</div>
		<br>
		<form action="exportarPDF.php" method="post">
			<input type="submit" name="boton" class="button" value="Finalizar Compra">
		</form>
	</div>

<?php echo $footer; ?>


</body>
</html>