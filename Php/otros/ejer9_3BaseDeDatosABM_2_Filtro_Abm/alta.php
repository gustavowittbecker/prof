<?php

include("./datosConexionBase.inc");

sleep(1);
#Se instancia el objeto mysqli
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$loginDeUsuario = $_POST['loginDeUsuario'];
$apellido = $_POST['apellido'];
$nombres = $_POST['nombres'];
$area = $_POST['area'];
$fechaNac = $_POST['fechaNac'];

global $idUsuario;
global $respuesta;

if (!($sentencia = $mysqli->prepare("insert into usuarios (loginDeUsuario,apellido,nombres,area,fechaNac) values (?,?,?,?,?);"))) {
    $respuesta = "Alta simple: Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
}
else {
	#Vinculación de la sentencia preparada:
	if (!$sentencia->bind_param('sssss', $loginDeUsuario, $apellido, $nombres, $area, $fechaNac)) {
    	$respuesta =  "Alta Simple: Falló la vinculación de parámetros simples: (" . $sentencia->errno . ") " . $sentencia->error;
	}

	else {
		#Ejecución de la sentencia vinculada
		if (!$sentencia->execute()) {
    		$respuesta = "Alta simple: Falló la ejecución sentencia simple: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
			
			$sql = "SELECT * FROM usuarios ORDER BY idUsuario  DESC LIMIT 1" ;
			$resultado = $mysqli->query($sql);
			$usuario = $resultado->fetch_assoc();
			$idUsuario=$usuario['idUsuario'];
			
			/*$respuesta = select LAST_INSERT_ID();*/
			$respuesta =  $idUsuario . " Alta simple realizada correctamente!";		
		}
	}

}


if(isset($_POST['traeClave'])) {
	$clave = $_POST['clave'];
	$clave = sha1($clave);

		$respuesta = $respuesta . "trae clave" . $idUsuario;
	if (!($sentencia = $mysqli->prepare("update usuarios set clave=? where idUsuario=?;"))) {
    	$respuesta = $respuesta . $idUsuario . " modi clave Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    }
	else {
		#Vinculación de la sentencia preparada:
		if (!$sentencia->bind_param('si',$clave,$idUsuario)) {
   		 	$respuesta = $respuesta . " modi clave Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
					#Ejecución de la sentencia vinculada
			if (!$sentencia->execute()) {
    			$respuesta = $respuesta . " modi clave Falló la ejecución sentencia: (" . $sentencia->errno . ") " . $sentencia->error;
			}
			else {
				//$target_file = $carpeta . "/curriculum.pdf";
				$respuesta =  $respuesta . " Alta clave realizada correctamente!";		
			}
		}	

	}
}




if(isset($_POST['traeCurriculum'])) {
	$curriculum = file_get_contents($_FILES['curriculum']['tmp_name']);

	$respuesta = $respuesta . "trae curriculum" . $idUsuario;
	if (!($sentencia = $mysqli->prepare("update usuarios set curriculum=? where idUsuario=?;"))) {
    	$respuesta = "Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    }
	else {
		#Vinculación de la sentencia preparada:
		if (!$sentencia->bind_param('si',$curriculum,$idUsuario)) {
   		 	$respuesta = $idUsuario . " Curri Falló la vinculación de parámetros en curriculum: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
					#Ejecución de la sentencia vinculada
			if (!$sentencia->execute()) {
    			$respuesta = " Curri Falló la ejecución sentencia en curriculum: (" . $sentencia->errno . ") " . $sentencia->error;
			}
			else {
				//$target_file = $carpeta . "/curriculum.pdf";
				$respuesta = $respuesta . " Alta de curreculum realizada correctamente!";
	
			}
		}	

	}
}







echo $respuesta;


mysqli_close($mysqli);

?>




