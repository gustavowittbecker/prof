<?php

include("./datosConexionBase.php");


$bindCodArt = $_GET['codArt'];

$respuesta_estado= "codArt: " . $bindCodArt;

try {
	$dsn = "mysql:host=$host;dbname=$dbname";
	$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
	$respuesta_estado = $respuesta_estado .  "\n<br />conexion exitosa";
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
}





$sql="select documentoPdf from articulos where codArt = :codArt";

$respuesta_estado = $respuesta_estado . $sql . "<br />";



try {
	$stmt = $dbh->prepare($sql);	
	$respuesta_estado = $respuesta_estado .  "\n<br />preparacion exitosa";
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
}


try {
	$stmt->bindParam(':codArt', $bindCodArt);
	
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



$fila=$stmt->fetch();
$objArticulo = new stdClass();
//recordemos que $fila['documentoPdf'] es el elemento asociativo que contiene el documento en formato binario



$objArticulo->documentoPdf=base64_encode($fila['documentoPdf']);

//$objArticulo->documentoPdf=$fila['documentoPdf'];

$salidaJson = json_encode($objArticulo,JSON_INVALID_UTF8_SUBSTITUTE);
/*El parámetro adicionado como 2do argumento es para evitar que el codificador json agregue caracteres que esten fuera de los valores posibles para base64*/
$dbh = null; /*para cerrar la conexion*/

echo $salidaJson;
//echo $respuesta;
?>


