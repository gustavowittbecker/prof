<?php
include("../manejoSesion.inc");
$codArt = $_GET['codArt'];

$respuesta = "<p>codArt: " . $codArt . "</p>";

include("./datosConexionBase.inc");
#Se instancia el objeto mysqli
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    $respuesta = "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


//Existe el registro?

	$sql = "delete from articulos where codArt='$codArt';";
	$respuesta = $respuesta . $sql . "<br />";

	$resultado = $mysqli->query($sql);

	if ($resultado === TRUE) {

		$respuesta = $respuesta .  "<p>Baja realizada correctamente.</p>";
	}
	else {
		$respuesta = $respuesta .  "<p>Error en la consulta sql</p>";
	}

echo $respuesta;
$mysqli->close();

?>


