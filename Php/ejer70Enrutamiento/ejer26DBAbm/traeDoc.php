<?php

$codArt = $_GET['codArt'];

$respuesta = "codArt: " . $codArt;

include("./datosConexionBase.inc");
#Se instancia el objeto mysqli
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    $respuesta = "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


//Existe el registro?

$sql="select documentoPdf from articulos where codArt = '$codArt'";
//echo $sql;

if (!($resultado = $mysqli->query($sql))) { //Devuelve un objeto $resultado
	$puntero = fopen("./errores.log","a");
	fwrite($puntero, "Fallo cosultaSql: ");
	fwrite($puntero, $mysqli->connect_errno . " ");
	$fecha = date("Y-m-d");
	fwrite($puntero, date("Y-m-d H-i") . " ");
	fwrite($puntero, "\n");
	fclose($puntero);
    die();
}


$fila=$resultado->fetch_assoc();
$objArticulo = new stdClass();
//recordemos que $fila['documentoPdf'] es el elemento asociativo que contiene el documento en formato binario


$objArticulo->documentoPdf=base64_encode($fila['documentoPdf']);

$salidaJson = json_encode($objArticulo,JSON_INVALID_UTF8_SUBSTITUTE);
/*El parámetro adicionado como 2do argumento es para evitar que el codificador json agregue caracteres que esten fuera de los valores posibles para base64*/

$mysqli->close();
echo $salidaJson;

?>


