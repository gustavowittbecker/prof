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

$resp_dev = "<h1>Parámetros de entrada del requerimiento HTTP: </h1>";
$resp_dev = $resp_dev . "<h4>Orden: " . $orden . "</h4>"; 
$resp_dev = $resp_dev . "<h4> f_articulos_codArt: " . $f_articulos_codArt . "</h4>";
$resp_dev = $resp_dev . "<h4> f_articulos_familia: " . $f_articulos_familia . "</h4>";
$resp_dev = $resp_dev . "<h4> f_articulos_descripcion: " . $f_articulos_descripcion . "</h4>";
$resp_dev = $resp_dev . "<h4> f_articulos_um: " . $f_articulos_um . "</h4>";
$resp_dev = $resp_dev . "<h4> f_articulos_fechaAlta: " . $f_articulos_fechaAlta . "</h4>";

include("./datosConexionBase.php");//Abre conexion con el motor de base de datos



if ($mysqli->connect_errno<>0) {
	$resp_dev = $resp_dev . "<h1>" . date("Y-m-d H-i") . "Fallo conexion base de datos (connect_errno): " . $mysqli->connect_errno . "</h1>";
	$puntero = fopen("./respuestaError.html","w");
	fwrite($puntero, $resp_dev);
	fclose($puntero);

	$puntero = fopen("./errores.log","a");
	fwrite($puntero, "Fallo conexion base de datos: ");
	fwrite($puntero, $mysqli->connect_errno . " ");
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

$sql =$sql . " order by " . $orden;



$resp_dev =  $resp_dev . "<h1>sql string: " . $sql . "</h1>";



if (!($sentencia = $mysqli->prepare($sql))) {
    $resp_dev = $resp_dev . "<h4>Falló la preparación del template: (" . $mysqli->errno . ") " . $mysqli->error . "</h4>";

	$puntero = fopen("./respuestaError.html","w");
	fwrite($puntero, $resp_dev);
	fclose($puntero);

	$puntero = fopen("./errores.log","a");
	fwrite($puntero, date("Y-m-d H-i") . "Falló la preparación de parametros simples ");
	fwrite($puntero, "\n");
	fclose($puntero);

}




else {
	#Vinculación de la sentencia preparada:
	$likeVarCodArt ="%" . $f_articulos_codArt . "%";
	$likeVarFamilia ="%" . $f_articulos_familia . "%";
	$likeVarDescripcion ="%" . $f_articulos_descripcion . "%";
	$likeVarUm ="%" . $f_articulos_um . "%";
	$likeVarFechaAlta ="%" . $f_articulos_fechaAlta . "%";

	if (!$sentencia->bind_param('sssss',$likeVarCodArt,$likeVarFamilia,$likeVarDescripcion,$likeVarUm,$likeVarFechaAlta)) {
    	$resp_dev = $resp_dev . "<br />Falló la vinculación de parámetros simples: (" . $sentencia->errno . ") " . $sentencia->error;
		$puntero = fopen("./respuestaError.html","w");
		fwrite($puntero, $resp_dev);
		fclose($puntero);

		$puntero = fopen("./errores.log","a");
		fwrite($puntero, date("Y-m-d H-i") . "Falló la vinculación de parametros simples ");
		fwrite($puntero, "\n");
		fclose($puntero);
	}
	else {
		#Ejecución de la sentencia vinculada
		if (!$sentencia->execute()) {
    		$resp_dev = $resp_dev . "<h4>Falló la ejecución de parametros simples: (" . $sentencia->errno . ") " . $sentencia->error . "</h4>";
			
			$puntero = fopen("./respuestaError.html","w");
			fwrite($puntero, $resp_dev);
			fclose($puntero);
			
			$puntero = fopen("./errores.log","a");
			fwrite($puntero, date("Y-m-d H-i") . "Falló la ejecución de parametros simples ");
			fwrite($puntero, "\n");
			fclose($puntero);
    		die();
		}
		else {
			$resultado = $sentencia->get_result(); 
			$resp_dev = $resp_dev . "<h1>" . date("Y-m-d H-i") . " Datos obtenidos correctamente! </h1>";
			$puntero = fopen("./respuestaError.html","w");
			fwrite($puntero, $resp_dev);
			fclose($puntero);	
		}
	}

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



?>