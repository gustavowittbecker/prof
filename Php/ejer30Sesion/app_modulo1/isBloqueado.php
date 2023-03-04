<?php
include('../manejoSesion.inc');
include("./datosConexionBase.php");
sleep(1);
//Este script trae un solo articulo
//Luego consulta en la tabla "estadodearticulo" si se encuentra o no bloqueado.

/*
	$puntero = fopen("./errores.log","a");
	fwrite($puntero, "Fallo conexion base de datos: ");
	fwrite($puntero, $mysqli->connect_errno . " ");
	$fecha = date("Y-m-d");
	fwrite($puntero, date("Y-m-d H-i") . " ");
	fwrite($puntero, "\n");
	fclose($puntero);
*/


$codArt = $_GET['codArt'];

$respuesta_estado = "codArt: " . $codArt;


try {
	$dsn = "mysql:host=$host;dbname=$dbname";
	$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
	$respuesta_estado = $respuesta_estado .  "\n<br />conexion exitosa";
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
}


$sql="select bloqueado from estadodearticulos where codArt = :bindCodArt";


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


$stmt->setFetchMode(PDO::FETCH_ASSOC);


$fila = $stmt->fetch();
if (is_null($fila['bloqueado'])) {
	$respuesta_estado=$respuesta_estado . "\n<br />Campo inexitente en tabla de bloqueos";
}
else {
	$respuesta_simple = $fila['bloqueado'];
	echo $respuesta_simple;
	$respuesta_estado = $respuesta_estado . "\n<br />Valor devuelto: " . $respuesta_simple ;

}

//echo $respuesta_estado;

?>