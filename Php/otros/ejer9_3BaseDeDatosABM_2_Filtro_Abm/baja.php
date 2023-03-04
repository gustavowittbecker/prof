<?php

$idUsuario = $_GET['idUsuario'];

echo "idUsuario: " . $idUsuario;

include("./datosConexionBase.inc");
#Se instancia el objeto mysqli
$mysqli = new mysqli(SERVER,USUARIO,PASS,BASE);

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


//Existe el registro?

$sql = "select * from usuarios where idUsuario='$idUsuario';";
//echo $sql;

$resultado = $mysqli->query($sql);

if ($resultado->num_rows===0){
	echo "Fila no existente";
}

else {

	$sql = "delete from usuarios where idUsuario='$idUsuario';";

	$resultado = $mysqli->query($sql);

	if ($resultado === TRUE) {

		echo "<h1>Baja realizada correctamente.</h1>";
	}
	else {
		echo "<h1>Error en la consulta sql";
	}


}

$mysqli->close();

?>


