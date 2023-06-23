<?php
include("./datosConexionBase.php");

$codArt = $_POST['codArt'];
$familia = $_POST['familia'];
$descripcion = $_POST['descripcion'];
$um = $_POST['um'];
$fechaAlta = $_POST['fechaAlta'];
$saldoStock = $_POST['saldoStock'];
//$documentoPdf = $_POST['documentoPdf'];


$respuesta_estado = "";


try {
	$dsn = "mysql:host=$host;dbname=$dbname"; /*dsn es una variable de tipo texto que contiene toda la información necesaria para conectarse a una 
                                             	fuente de datos  */
	$dbh = new PDO($dsn, $user, $password);	/*el metodo constructor PDO crea una instancia de conexión a una fuente de datos tambien llamada Database Handle*/
	$respuesta_estado = $respuesta_estado .  "\nconexion exitosa";
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
}




$respuesta_estado=$respuesta_estado . "\nRespuesta del servidor al alta. Entradas recibidas en el req http:";
$respuesta_estado=$respuesta_estado . "\ncodArt: " . $codArt;
$respuesta_estado=$respuesta_estado . "\nfamilia: " . $familia;
$respuesta_estado=$respuesta_estado . "\ndescripcion: " . $descripcion;
$respuesta_estado=$respuesta_estado . "\num: " . $um;
$respuesta_estado=$respuesta_estado . "\nfechaAlta: " . $fechaAlta;
$respuesta_estado=$respuesta_estado . "\nsaldoStock: " . $saldoStock;


$sql="insert into articulos (codArt,familia,descripcion,um,fechaAlta,saldoStock) values (:codArt,:familia,:descripcion,:um,:fechaAlta,:saldoStock);";


$stmt = $dbh->prepare($sql);

$stmt->bindParam(':codArt', $codArt);
$stmt->bindParam(':familia', $familia);
$stmt->bindParam(':descripcion', $descripcion);
$stmt->bindParam(':um', $um);
$stmt->bindParam(':fechaAlta', $fechaAlta);
$stmt->bindParam(':saldoStock', $saldoStock);

//$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();


//Si viene documento! Sigue abajo

	$codArt = $dbh->lastInsertId(); //Para el caso de una tabla de movimientos donde la clave primaria sea autoincremental.


	if (empty($_FILES['documentoPdf']['name'])) {
		$respuesta_estado = $respuesta_estado . "<br />No ha sido seleccionado ningun file para enviar!";		
	}
	else {
		$respuesta_estado=$respuesta_estado . "Trae documentoPdf asociado a codArt: " . $codArt;
		
		$contenidoPdf = file_get_contents($_FILES['documentoPdf']['tmp_name']);	
		//EL type de $_FILES['documentoPdf'] no es
		//una variable simple que contiene el nombre
		//del archivo subido desde el input de java script con nombre documentoPdf sino un array (para verlo se 
		//puede usar var_dump(). El elemento name en la 2da dimension de $_FILES si contiene el nombre de archivo 
	 	//original)	


		$sql="update articulos set documentoPdf=:contenidoPdf where codArt=:codArt;";

		try {
			$stmt = $dbh->prepare($sql);	
			$respuesta_estado = $respuesta_estado .  "\n<br />preparacion exitosa";
		} 
		catch (PDOException $e) {
			$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
		}



		try {
			$stmt->bindParam(':codArt', $codArt);
			$stmt->bindParam(':contenidoPdf', $contenidoPdf);
	
			$respuesta_estado = $respuesta_estado .  "\n<br /> bind exitosa";
		} catch (PDOException $e) {
			$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
		}



		try {
			$stmt->execute();	
			$respuesta_estado = $respuesta_estado .  "\n<br /> ejecucion exitosa";
		} catch (PDOException $e) {
			$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
		}


		//$fila=$stmt->fetch();

	}


/*
$salidaJson = json_encode($respuesta_estado,JSON_INVALID_UTF8_SUBSTITUTE);
//El segundo parametro es para que la función no falle con los caracteres utf8 como acentos y ñ's'
echo $salidaJson;
*/


$dbh = null; /*para cerrar la conexion*/


echo $respuesta_estado;
?>




