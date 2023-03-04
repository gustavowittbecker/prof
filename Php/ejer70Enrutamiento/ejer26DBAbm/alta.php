<?php
include("../manejoSesion.inc");
include("./datosConexionBase.inc");

//sleep(1);
#Se instancia el objeto mysqli
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


$mysqli -> set_charset("utf8");

global $codArt;
global $respuesta;

$respuesta="<br />Datos recibidos para el alta: ";


$codArt = $_POST['codArt'];
$familia = $_POST['familia'];
$descripcion = $_POST['descripcion'];
$um = $_POST['um'];
$fechaAlta = $_POST['fechaAlta'];
$saldoStock = $_POST['saldoStock'];
//$documentoPdf = $_POST['documentoPdf'];

$respuesta = $respuesta . "<br />codArt: " . $codArt;
$respuesta = $respuesta . "<br />familia: " . $familia;
$respuesta = $respuesta . "<br />descripcion: " . $descripcion;
$respuesta = $respuesta . "<br />um: " . $um;
$respuesta = $respuesta . "<br />fechaAlta: " . $fechaAlta;
$respuesta = $respuesta . "<br />saldoStock: " . $saldoStock;


/*
$sql = "insert into articulos (codArt,familia,descripcion,um,fechaAlta,saldoStock) values ($codArt,$familia,$descripcion,$um,$fechaAlta,$saldoStock);";
$respuesta = $sql;
*/
$respuesta = $respuesta . "<br />insert into articulos (codArt,familia,descripcion,um,fechaAlta,saldoStock) values (?,?,?,?,?,?);";

if (!($sentencia = $mysqli->prepare("insert into articulos (codArt,familia,descripcion,um,fechaAlta,saldoStock) values (?,?,?,?,?,?);"))) {
    $respuesta = $respuesta . "<br />Alta simple: Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
}
else {
	#Vinculación de la sentencia preparada:
	if (!$sentencia->bind_param('sssssi', $codArt, $familia, $descripcion, $um, $fechaAlta, $saldoStock)) {
    	$respuesta =  $respuesta . "<br />Alta Simple: Falló la vinculación de parámetros simples: (" . $sentencia->errno . ") " . $sentencia->error;
	}

	else {
		#Ejecución de la sentencia vinculada
		if (!$sentencia->execute()) {
    		$respuesta = $respuesta . "<br />Alta simple: Falló la ejecución sentencia simple: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
			
			$respuesta =  $respuesta . "<br />Alta simple realizada correctamente! CodArt: " . $codArt;		
		}
	}

}




// Si viene un file lo almaceno aqui abajo!


/*
if(isset($_FILES['documentoPdf'])) {
	if(!empty($_FILES['documentoPdf']['name'])) {  //Es extraño pero type de $_FILES['documentoPdf'] no es
													//una variable simple sino un array (para verlo se puede usar
													// var_dump(). El elemento name si contiene el nombre de archivo)
		$respuesta = $respuesta . "<br />Nombre original del archivo subido: " . $_FILES['documentoPdf']['name'];
		$contenidoPdf = file_get_contents($_FILES['documentoPdf']['tmp_name']);
	}
	//$respuesta = $respuesta . "<br />Trae documentoPdf asociado a codArt: " . $codArt;
	if (!($sentencia = $mysqli->prepare("update articulos set documentoPdf=? where codArt=?;"))) {
    	$respuesta = "Subida documento pdf falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
    }
	else {
		#Vinculación de la sentencia preparada:
		if (!$sentencia->bind_param('ss',$documentoPdf,$codArt)) {
   		 	$respuesta = $respuesta . "<br /> " . $codArt . " Subida doc falló la vinculación de parámetros en documentoPdf: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		else {
					#Ejecución de la sentencia vinculada
			if (!$sentencia->execute()) {
    			$respuesta = $respuesta . "<br /> " . $codArt . " Subida doc falló la ejecución sentencia en documentoPdf: (" . $sentencia->errno . ") " . $sentencia->error;
			}
			else {
				//$target_file = $carpeta . "/curriculum.pdf";
				$respuesta . "<br /> " . $codArt . " Alta de documentoPdf realizada correctamente!";
	
			}
		}	

	}
}
*/

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
    	$respuesta = $respuesta . "<br />Subida documento pdf falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
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
				$respuesta = $respuesta . "<br /> " . $codArt . "<br />Alta de documentoPdf realizada correctamente!";
	
			}
		}	

	}
}



echo "Respuesta del servicor: <br />" . $respuesta;


mysqli_close($mysqli);

?>




