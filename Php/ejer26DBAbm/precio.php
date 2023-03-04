<?php
sleep(1);
//Este script trae un solo articulo
//Luego consulta en la tabla "listaprecios" el precio correspondiente.

$codArt=$_GET['codArt'];
$respuesta_estado = "codArt: " . $codArt;

include("./datosConexionBase.php");

try {
	$dsn = "mysql:host=$host;dbname=$dbname";
	$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
	$respuesta_estado = $respuesta_estado .  "\n<br />conexion exitosa";
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
}


$sql="select precio from listaprecios where codArt = :bindCodArt";


try {
	$stmt = $dbh->prepare($sql);	
	$respuesta_estado = $respuesta_estado .  "\n<br />preparacion exitosa";
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
}


try {
	$stmt->bindParam(':bindCodArt', $codArt);
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


$fila = $stmt->fetch();

if (is_null($fila['precio'])) {
	$respuesta_estado="Campo inexitente en tabla de bloqueos";
}
else {
	$respuesta_simple = $fila['precio'];
	echo $respuesta_simple;
	$respuesta_estado = $respuesta_estado . "\n<br />Precio: " . $fila['precio'] ;
}


//echo $respuesta_estado;


?>