<?php
include("./datosConexionBase.php");

$bindCodArt = $_GET['codArt'];

$respuesta_estado = "codArt pasado: " . $bindCodArt;


try {
	$dsn = "mysql:host=$host;dbname=$dbname";
	$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
	$respuesta_estado = $respuesta_estado .  "\nConexion exitosa!";
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
}

$sql = "delete from articulos where codArt=:codArt;";

$stmt = $dbh->prepare($sql);
$respuesta_estado = $respuesta_estado . "\nPreparacion exitosa!";

$stmt->bindParam(':codArt', $bindCodArt);
$respuesta_estado = $respuesta_estado . "\nBinding exitoso!";

$stmt->execute();
$respuesta_estado = $respuesta_estado . "\nEjecucion exitosa!";

$puntero = fopen("./errores.log","a");
fwrite($puntero, $respuesta_estado);
$fecha = date("Y-m-d");
fwrite($puntero, date("Y-m-d H-i") . " ");
fwrite($puntero, "\n");
fclose($puntero);

$dbh = null; /*para cerrar la conexion*/

echo $respuesta_estado;

?>


