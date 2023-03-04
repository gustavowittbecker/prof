<?php
sleep(1);
if (isset($_GET['orden'])) { 
	$orden=$_GET['orden'];
}
else {
	$orden="codArt";
}

$respuesta = "<h4>Orden: " . $orden . "</h4>"; 


include("./datosConexionBase.inc");//Abre conexion con el motor de base de datos
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


$sql="select * from articulos ";

$sql =$sql . " order by " . $orden;


/*
$sql="select * from articulos order by " . $orden;
/*
$sql="select * from usuarios where nombres like '%" . $filtroNombres . "%' and apellido like '%" . $filtroApellido . "%' and area like '%" . $filtroArea . "%' order by " . $orden;
*/


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


$resultadoCuentaArticulos = $resultado->num_rows; //devuelve un entero

$articulos=[];

while($fila=$resultado->fetch_assoc()) {
	$objArticulo = new stdClass();
	$objArticulo->codArt=$fila['codArt'];
	$objArticulo->familia=$fila['familia'];
	$objArticulo->descripcion=$fila['descripcion'];
	$objArticulo->um=$fila['um'];
	$objArticulo->fechaAlta=$fila['fechaAlta'];
	$objArticulo->saldoStock=$fila['saldoStock'];

	array_push($articulos,$objArticulo);
}

$objArticulos = new stdClass();
$objArticulos->articulos=$articulos;
$objArticulos->cuenta=$resultadoCuentaArticulos;

$salidaJson = json_encode($objArticulos,JSON_INVALID_UTF8_SUBSTITUTE);
$mysqli->close();
echo $salidaJson;
//echo $respuesta;
?>