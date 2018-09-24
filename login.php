<?php

$usuarios['user']=array('Pablo','Antonio','Jose','Fran','Ruben','Antonio2');
$usuarios['pass']=array('P','A1','J','F','R','A2');

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .formulario {
		background-color: lightgrey;
		border: 3px solid gray;
		width: 35%;
		margin-left: 28.6%;
		margin-top: 12.5%;
		padding: 3%;
		box-shadow: 1px 1px 10px black;
        font-family: arial;
        text-align: center;
    }

    .celdafor {
		width: 100%;
		margin: 2% 0;
		padding: 1% 1%;
		text-align: center;
    }
    
    .boton2 {
	    background-color: white;
	    border: 1px solid gray;
	    color: black;
	    padding: 10px 15px;
	    text-align: center;
	    text-decoration: none;
	    display: inline-block;
	    font-size: 16px;
        margin: 4px 2px;
        margin-bottom: 15px;
	    cursor: pointer;
    }

    .boton2:hover {
		background-color: lightgray;
	}
      
    </style>
</head>
<body>
    <div class="formulario">
		<h1>Identificarse</h1>
		<form action="" method="post">
    	Nombre: <input type="text" class="celdafor" name="nombre"><br>
    	Contraseña: <input type="password" class="celdafor" name="clave"><br>
    	<input type="submit" class="boton2" value="Ingresar" name="boton">
        </form>
        
        <?php

        if (isset($_POST['boton'])) {
            if($_POST['nombre'] == NULL) {
                echo 'Debe introducir un usuario';
                echo '<br>';
            }
            if($_POST['clave'] == NULL){
                echo 'Debe introducir una contraseña';
            }

            if ($_POST['nombre'] != NULL && $_POST['clave'] != NULL) {

                $posUser = array_search($_POST['nombre'], $usuarios['user']);
                $posPass = array_search($_POST['clave'], $usuarios['pass']);

                if ($posUser == $posPass && ($posUser !== FALSE && $posPass !== FALSE)) {
                    echo 'Bienvenido '.$_POST['nombre'];
                }else {
                    echo 'Usuario o contraseña incorrecto';
                }          
            }
        }

        ?>
    </div>
</body>
</html>