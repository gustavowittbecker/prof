<?php
//sleep(1);

include("../ejer26DBAbm/datosConexionBase.php");


$orden=$_GET['orden'];
$f_articulos_codArt=$_GET['f_articulos_codArt'];
$f_articulos_familia=$_GET['f_articulos_familia'];
$f_articulos_descripcion=$_GET['f_articulos_descripcion'];
$f_articulos_um=$_GET['f_articulos_um'];
$f_articulos_fechaAlta=$_GET['f_articulos_fechaAlta'];


$respuesta_estado = "Parámetros de entrada del requerimiento HTTP:";
$respuesta_estado = $respuesta_estado . "<h4>Orden: " . $orden . "</h4>"; 
$respuesta_estado = $respuesta_estado . "<h4> f_articulos_codArt: " . $f_articulos_codArt . "</h4>";
$respuesta_estado = $respuesta_estado . "<h4> f_articulos_familia: " . $f_articulos_familia . "</h4>";
$respuesta_estado = $respuesta_estado . "<h4> f_articulos_descripcion: " . $f_articulos_descripcion . "</h4>";
$respuesta_estado = $respuesta_estado . "<h4> f_articulos_um: " . $f_articulos_um . "</h4>";
$respuesta_estado = $respuesta_estado . "<h4> f_articulos_fechaAlta: " . $f_articulos_fechaAlta . "</h4>";

#include("./datosConexionBase.php");//Abre conexion con el motor de base de datos



try {
	$dsn = "mysql:host=$host;dbname=$dbname";
	$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
	$respuesta_estado = $respuesta_estado .  "\nconexion exitosa";
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
}

//Carga de sentencia en crudo

$sql="select * from articulos where ";

$sql=$sql . "codArt LIKE CONCAT('%',:codArt,'%') and ";//ojo con espacios antes y despues del and
$sql=$sql . "familia LIKE CONCAT('%',:familia,'%') and ";
$sql=$sql . "descripcion LIKE CONCAT('%',:descripcion,'%') and ";
$sql=$sql . "um LIKE CONCAT('%',:um,'%') and ";
$sql=$sql . "fechaAlta LIKE CONCAT('%',:fechaAlta,'%')";
$sql=$sql . " ORDER BY $orden";

$respuesta_estado = $respuesta_estado . "\nsql string: " . $sql;

//Preparacion de sentencia
$stmt = $dbh->prepare($sql);


//Vinculacion de sentencia:

$stmt->bindParam(':codArt', $f_articulos_codArt);
$stmt->bindParam(':familia', $f_articulos_familia);
$stmt->bindParam(':descripcion', $f_articulos_descripcion);
$stmt->bindParam(':um', $f_articulos_um);
$stmt->bindParam(':fechaAlta', $f_articulos_fechaAlta);
/*$stmt->bindParam(':ordenamiento', $orden);  El bindParam no aplica a la clausulo order by*/ 
//Ejecucion de sentencia
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

//Declaracion de arreglo vacio para almacenar la respuesta a la consulta
$articulos=[];

//Carga del arreglo
While($fila = $stmt->fetch()) {
	$objArticulo = new stdClass();
	$objArticulo->codArt=$fila['codArt'];
	$objArticulo->familia=$fila['familia'];
	$objArticulo->descripcion=$fila['descripcion'];
	$objArticulo->um=$fila['um'];
	$objArticulo->fechaAlta=$fila['fechaAlta'];
	$objArticulo->saldoStock=$fila['saldoStock'];

	$respuesta_estado = $respuesta_estado . "\n" . $objArticulo->codArt;
	array_push($articulos,$objArticulo);

}




//$respuesta_estado = $respuesta_estado .  "\nAqui: " . $articulos[1]->codArt;


$objArticulos = new stdClass();
$objArticulos->articulos=$articulos;
$objArticulos->cuenta=count($articulos);

$respuesta_estado = $respuesta_estado . "\ncantidad de articulos de la consulta: " . $objArticulos->cuenta;

$salidaJson = json_encode($objArticulos);



$dbh = null; /*para cerrar la conexion*/



$respuesta_estado = $respuesta_estado . "\nFIN";


echo $salidaJson;

//echo $respuesta_estado;
?>
