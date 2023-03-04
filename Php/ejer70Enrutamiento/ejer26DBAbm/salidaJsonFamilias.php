<?php
//sleep(1);
include("./datosConexionBase.inc");
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sqlFamilias="select * from familias";

$resultadoFamilias = $mysqli->query($sqlFamilias);

$familias=[];

while($fila=$resultadoFamilias->fetch_assoc()) {
	$objFamilia= new stdclass;
	$objFamilia->codFamilia=$fila['codFamilia'];
	$objFamilia->descripcionFamilia=$fila['descripcionFamilia'];
	array_push($familias, $objFamilia);
}



$objFamilias=new stdclass();
$objFamilias->familias=$familias;

$salidaJson=json_encode($objFamilias,JSON_INVALID_UTF8_SUBSTITUTE);
$mysqli->close();
echo $salidaJson;
?>