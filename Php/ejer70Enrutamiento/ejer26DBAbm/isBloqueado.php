<?php
sleep(4);
//Este script trae un solo usuario para ficha modi.
$codArt=$_GET['codArt'];
///echo $codArt;

//echo $idUsuario;
include("./datosConexionBase.inc");
//Abre conexion con el motor de base de datos
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);
if ($mysqli->connect_errno<>0) {
	$puntero = fopen("./errores.log","a");
	fwrite($puntero, "Fallo conexion base de datos: ");
	fwrite($puntero, $mysqli->connect_errno . " ");
	$fecha = date("Y-m-d");
	fwrite($puntero, date("Y-m-d H-i") . " ");
	fwrite($puntero, "\n");
	fclose($puntero);
    die();
}
$sql="select bloqueado from estadodearticulos where codArt = '$codArt'";
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
if (is_null($fila['bloqueado'])) {
	$salida="Campo inexitente en tabla de bloqueos";
}
else {
	$salida = $fila['bloqueado'] ;
}
	echo $salida;
//$salidaJson = json_encode($objArticulo,JSON_INVALID_UTF8_SUBSTITUTE);

$mysqli->close();
//echo $salidaJson;

?>