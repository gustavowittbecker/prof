<?php
sleep(1);
if (isset($_GET['orden'])) { 
	$orden=$_GET['orden'];
	$f_articulos_codArt=$_GET['f_articulos_codArt'];
	$f_articulos_familia=$_GET['f_articulos_familia'];
	$f_articulos_descripcion=$_GET['f_articulos_descripcion'];
	$f_articulos_um=$_GET['f_articulos_um'];
	$f_articulos_fechaAlta=$_GET['f_articulos_fechaAlta'];
}
else {
	$orden="codArt";
}

$respuesta = "<h4>Orden: " . $orden . "</h4>"; 
$respuesta = $respuesta . "<h4> f_articulos_codArt: " . $f_articulos_codArt . "</h4>";
$respuesta = $respuesta . "<h4> f_articulos_familia: " . $f_articulos_familia . "</h4>";
$respuesta = $respuesta . "<h4> f_articulos_descripcion: " . $f_articulos_descripcion . "</h4>";
$respuesta = $respuesta . "<h4> f_articulos_um: " . $f_articulos_um . "</h4>";
$respuesta = $respuesta . "<h4> f_articulos_fechaAlta: " . $f_articulos_fechaAlta . "</h4>";

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


$sql="select * from articulos where ";
$sql=$sql . "codArt like '%" . $f_articulos_codArt . "%' and ";//ojo con espacios antes y despues del and
$sql=$sql . "familia like '%" . $f_articulos_familia . "%' and ";
$sql=$sql . "descripcion like '%" . $f_articulos_descripcion . "%' and ";
$sql=$sql . "um like '%" . $f_articulos_um . "%' and ";
$sql=$sql . "fechaAlta like '%" . $f_articulos_fechaAlta . "%' ";
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

$salidaJson = json_encode($objArticulos);

$mysqli->close();
echo $salidaJson;
//echo $respuesta;
?>