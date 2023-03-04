<?php

include("./datosConexionBase.inc");
//sleep(1);
#Se instancia el objeto mysqli
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}




//Carga datos recibidos en variables
global $codArt;
global $respuesta;

$respuesta="Datos recibidos para la modificación: ";

//Muestra el charset actual seteado por default:
//$respuesta = $respuesta . "<br />Nombre del charset: " . $mysqli->character_set_name();

//Luego se especifica el charset que deseo usar para enviar datos hacia y desde la base de datos.
//$mysqli -> set_charset("utf8");



$codArt=$_POST['codArt'];
$familia = $_POST['familia'];
$descripcion = $_POST['descripcion'];
$um = $_POST['um'];
$fechaAlta = $_POST['fechaAlta'];
$saldoStock = $_POST['saldoStock'];

$respuesta = $respuesta . "<br />codArt: " . $codArt;
$respuesta = $respuesta . "<br />familia: " . $familia;
$respuesta = $respuesta . "<br />descripcion: " . $descripcion;
$respuesta = $respuesta . "<br />um: " . $um;
$respuesta = $respuesta . "<br />fechaAlta: " . $fechaAlta;
$respuesta = $respuesta . "<br />saldoStock: " . $saldoStock;


/*Caso sin protección contra inyeccion

$sql = "update articulos set codArt='$codArt',familia='$familia',descripcion='$descripcion',um='$um',fechaAlta='$fechaAlta' where codArt='$codArt'";

$respuesta = $respuesta . "<p>sentencia sql: " . $sql . "</p>";

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



if (!($sentencia = $mysqli->prepare("update articulos set codArt=?,familia=?,descripcion=?,um=?,fechaAlta=?,saldoStock=? where codArt=?;"))) {
    $respuesta = $respuesta . "<br />Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
}
else {
	#Vinculación de la sentencia preparada:

	if (!$sentencia->bind_param('sssssis', $codArt,$familia,$descripcion,$um,$fechaAlta,$saldoStock,$codArt)) {
    	$respuesta = $respuesta . "<br />Falló la vinculación de parámetros simples: (" . $sentencia->errno . ") " . $sentencia->error;
	}

	else {
		#Ejecución de la sentencia vinculada
		if (!$sentencia->execute()) {
    		$respuesta = $respuesta . "<br />Falló la ejecución de parametros simples: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
			$respuesta = $respuesta . "<br />Datos simples  actualizados correctamente!";		
		}
	}

}

//Si viene documento! Sigue abajo
//$respuesta = var_dump($_FILES['documentoPdf']);//No es una variable simple sino un array

if(isset($_FILES['documentoPdf'])) {

	if(!empty($_FILES['documentoPdf']['name'])) {  //EL type de $_FILES['documentoPdf'] no es
													//una variable simple que contiene el nombre
		//del archivo subido desde el input de java script con nombre documentoPdf sino un array (para verlo se 
		//puede usar var_dump(). El elemento name en la 2da dimension de $_FILES si contiene el nombre de archivo 
 		//original)
		$respuesta = $respuesta . "<br />Nombre original del archivo subido: " . $_FILES['documentoPdf']['name'];
		$contenidoPdf = file_get_contents($_FILES['documentoPdf']['tmp_name']);
	}
	$respuesta = $respuesta . "<br />Trae documentoPdf asociado a codArt: " . $codArt;
	if (!($sentencia = $mysqli->prepare("update articulos set documentoPdf=? where codArt=?;"))) {
    	$respuesta = "<br />Subida documento pdf falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    }
	else {
		#Vinculación de la sentencia preparada:
		if (!$sentencia->bind_param('ss',$contenidoPdf,$codArt)) {
   		 	$respuesta = $respuesta . "<br /> " . $codArt . "<br />Subida doc falló la vinculación de parámetros en documentoPdf: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
					#Ejecución de la sentencia vinculada
			if (!$sentencia->execute()) {
    			$respuesta = $respuesta . "<br /> " . $codArt . "<br />Subida doc falló la ejecución sentencia en documentoPdf: (" . $sentencia->errno . ") " . $sentencia->error;
			}
			else {
				//$target_file = $carpeta . "/curriculum.pdf";
				$respuesta . "<br /> " . $codArt . " Alta de documentoPdf realizada correctamente!";
	
			}
		}	

	}
}

echo $respuesta;

$mysqli->close();

?>