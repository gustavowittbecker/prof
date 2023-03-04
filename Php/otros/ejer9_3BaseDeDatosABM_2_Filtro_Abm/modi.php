<?php

include("./datosConexionBase.inc");
sleep(1);
#Se instancia el objeto mysqli
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

//Muestra como llegan los datos
//Recordar que la clave no se modifica en este procedimiento
//Carga datos recibidos en variables


global $idUsuario;
global $respuesta;

$idUsuario=$_POST['idUsuario'];
$loginDeUsuario = $_POST['loginDeUsuario'];
$apellido = $_POST['apellido'];
$nombres = $_POST['nombres'];
$area = $_POST['area'];
$fechaNac = $_POST['fechaNac'];

$respuesta = "idUsuario: " . $idUsuario;



/*Caso sin protección contra inyeccion

$sql = "update usuarios set apellido='$apellido',loginDeUsuario='$loginDeUsuario',nombres='$nombres',area='$area',fechaNac='$fechaNac', curriculum='$curriculum' where idUsuario='$idUsuario'";


echo "sql: " . $sql;


if (!($resultado = $mysqli->query($sql))) {
	$respuesta = "Error en la consulta sql";
}
else {
	$respuesta = "Modificación realizada correctamente";
}

*/




//Caso proteccion contra inyeccion

#Los pasos para tomar los datos de la base para evitar la inyeccion sql son los siguientes:
#Preparacion de la sentencia (define un template de sentencia):
#Las siglas son: s string, i integer, d doble, b blob


//Trae varibles simples: 

if (!($sentencia = $mysqli->prepare("update usuarios set loginDeUsuario=?,apellido=?,nombres=?,area=?,fechaNac=? where idUsuario=?;"))) {
    $respuesta = $respuesta . "Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
}
else {
	#Vinculación de la sentencia preparada:

	if (!$sentencia->bind_param('sssssi', $loginDeUsuario,$apellido,$nombres,$area,$fechaNac,$idUsuario)) {
    	$respuesta = $respuesta . "Falló la vinculación de parámetros simples: (" . $sentencia->errno . ") " . $sentencia->error;
	}

	else {
		#Ejecución de la sentencia vinculada
		if (!$sentencia->execute()) {
    		$respuesta = $respuesta . "Falló la ejecución de parametros simples: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
			$respuesta = $respuesta . "Datos simples  actualizados correctamente!";		
		}
	}

}


// Trae clave
if(isset($_POST['traeClave'])) {
	$clave = $_POST['clave'];
	$clave = sha1($clave);

	if (!($sentencia = $mysqli->prepare("update usuarios set clave=? where idUsuario=?;"))) {
    	$respuesta = $respuesta . "Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    }
	else {
		#Vinculación de la sentencia preparada:
		if (!$sentencia->bind_param('si',$clave,$idUsuario)) {
   		 	$respuesta =  $respuesta . "Falló la vinculación de parámetros en clave: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
					#Ejecución de la sentencia vinculada
			if (!$sentencia->execute()) {
    			$respuesta = $respuesta . "Falló la ejecución sentencia en clave: (" . $sentencia->errno . ") " . $sentencia->error;
			}
			else {
				$respuesta =  $respuesta . "Modificación de clave realizada correctamente!";		
			}
		}	

	}
}



//Trae Curriculum

if(isset($_POST['traeCurriculum'])) {
	$curriculum = file_get_contents($_FILES['curriculum']['tmp_name']);
	if (!($sentencia = $mysqli->prepare("update usuarios set curriculum=? where idUsuario=?;"))) {
    	$respuesta = $respuesta . "Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    }
	else {
		#Vinculación de la sentencia preparada:
		if (!$sentencia->bind_param('si',$curriculum,$idUsuario)) {
   		 	$respuesta =  $respuesta  . "Falló la vinculación de parámetros en curriculum: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
					#Ejecución de la sentencia vinculada
			if (!$sentencia->execute()) {
    			$respuesta = $respuesta . "Falló la ejecución sentencia en curriculum: (" . $sentencia->errno . ") " . $sentencia->error;
			}
			else {
				//$target_file = $carpeta . "/curriculum.pdf";

				$respuesta =  $respuesta . "Modificación de curriculum realizada correctamente!";		
			}
		}	

	}
}






echo $respuesta;


$mysqli->close();

?>



