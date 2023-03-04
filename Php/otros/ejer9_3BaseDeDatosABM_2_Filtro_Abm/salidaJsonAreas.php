<?php
sleep(1);
include("./datosConexionBase.inc");
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$sqlAreas="select * from areas";

$resultadoAreas = $mysqli->query($sqlAreas);

$areas=[];

while($fila=$resultadoAreas->fetch_assoc()) {
	$objArea= new stdclass;
	$objArea->idArea=$fila['idArea'];
	$objArea->descripcion=$fila['descripcion'];
	array_push($areas, $objArea);
}



$objAreas=new stdclass();
$objAreas->areas=$areas;

$salidaJson=json_encode($objAreas);
$mysqli->close();
echo $salidaJson;
?>