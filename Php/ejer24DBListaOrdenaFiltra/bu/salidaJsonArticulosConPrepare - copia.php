<?php
//sleep(1);
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
$sql=$sql . "codArt LIKE ? and ";//ojo con espacios antes y despues del and
$sql=$sql . "familia LIKE ? and ";
$sql=$sql . "descripcion LIKE ? and ";
$sql=$sql . "um LIKE ? and ";
$sql=$sql . "fechaAlta LIKE ?";

$sql =$sql . " order by '" . $orden . "'";


//$sql="select * from articulos order by ?";

//$sql =$sql . ";";
$respuesta =  $respuesta . "<br />sql string: " . $sql ;



if (!($sentencia = $mysqli->prepare($sql))) {
    $respuesta = $respuesta . "<br />Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error;
}




else {
	#Vinculación de la sentencia preparada:
	$likeVarCodArt ="%" . $f_articulos_codArt . "%";
	$likeVarFamilia ="%" . $f_articulos_familia . "%";
	$likeVarDescripcion ="%" . $f_articulos_descripcion . "%";
	$likeVarUm ="%" . $f_articulos_um . "%";
	$likeVarFechaAlta ="%" . $f_articulos_fechaAlta . "%";

	if (!$sentencia->bind_param('sssss',$likeVarCodArt,$likeVarFamilia,$likeVarDescripcion,$likeVarUm,$likeVarFechaAlta)) {
    	$respuesta = $respuesta . "<br />Falló la vinculación de parámetros simples: (" . $sentencia->errno . ") " . $sentencia->error;
	}
	else {
		#Ejecución de la sentencia vinculada
		if (!$sentencia->execute()) {
    		$respuesta = $respuesta . "<br />Falló la ejecución de parametros simples: (" . $sentencia->errno . ") " . $sentencia->error;
    		$puntero = fopen("./errores.log","a");
			fwrite($puntero, $respuesta);
			$fecha = date("Y-m-d");
			fwrite($puntero, date("Y-m-d H-i") . " ");
			fwrite($puntero, "\n");
			fclose($puntero);
    		die();
		}
		else {
			$respuesta = $respuesta . "<br />Datos obtenidos!";
			$resultado = $sentencia->get_result(); 	
		}
	}

}



$resultadoCuentaArticulos = $resultado->num_rows; //devuelve un entero

$respuesta = $respuesta . "<br />Cuenta de articulos: " . $resultadoCuentaArticulos;

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

//echo $salidaJson;

echo $respuesta;
?>