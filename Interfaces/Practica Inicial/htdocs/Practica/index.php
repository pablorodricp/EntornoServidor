<?php
session_start();

$conexion = mysqli_connect("localhost","root","","practica1");

ob_start();
    include('html/header.html');
    $header = ob_get_contents();
    ob_end_clean();

ob_start();
    include('html/footer.html');
    $footer = ob_get_contents();
    ob_end_clean();


ob_start();
    include('html/inicio.html');
    $html_plantilla = ob_get_contents();
    ob_end_clean();

ob_start();
    include('html/nolog.html');
    $nolog = ob_get_contents();
    ob_end_clean();

ob_start();
    include('html/navuser.html');
    $navusuario = ob_get_contents();
    ob_end_clean();

ob_start();
    include('html/nav.html');
    $navinvitado = ob_get_contents();
    ob_end_clean();

mysqli_close($conexion);




echo $header;

if (isset($_SESSION['nombreusuario'])) {
    echo $navusuario;
	echo $html_plantilla;
}else {
    echo $navinvitado;
	echo $nolog;
}

echo $footer;

?>	


