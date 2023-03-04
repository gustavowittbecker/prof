<?php
sleep(1);
//Este script trae un solo usuario para ficha modi.
$idUsuario=$_GET['idUsuario'];
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
$sql="select * from usuarios where idUsuario = '$idUsuario'";
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
$objUsuario = new stdClass();
	$objUsuario->idUsuario=$fila['idUsuario'];
	$objUsuario->loginDeUsuario=$fila['loginDeUsuario'];
	$objUsuario->apellido=$fila['apellido'];
	$objUsuario->nombres=$fila['nombres'];
	$objUsuario->area=$fila['area'];
	$objUsuario->clave=$fila['clave'];
	$objUsuario->fechaNac=$fila['fechaNac'];
	$objUsuario->curriculum=base64_encode($fila['curriculum']);
	//$objUsuario->curriculum=$fila['curriculum'];
	//$objUsuario->curriculum="miCurriculum";

$salidaJson = json_encode($objUsuario);

$mysqli->close();
echo $salidaJson;

//echo $sql;
?>