<?php
sleep(1);
if (isset($_GET['orden'])) { 
	$orden=$_GET['orden'];
}
else {
	$orden="idUsuario";
}


$filtroApellido=$_GET['fapellido'];
$filtroNombres=$_GET['fnombres'];
$filtroArea=$_GET['farea'];




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

$sql="select * from usuarios where nombres like '%" . $filtroNombres . "%' and apellido like '%" . $filtroApellido . "%' and area like '%" . $filtroArea . "%' order by " . $orden;


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


$resultadoCuentaUsuarios = $resultado->num_rows; //devuelve un entero

$usuarios=[];

while($fila=$resultado->fetch_assoc()) {
	$objUsuario = new stdClass();
	$objUsuario->idUsuario=$fila['idUsuario'];
	$objUsuario->loginDeUsuario=$fila['loginDeUsuario'];
	$objUsuario->apellido=$fila['apellido'];
	$objUsuario->nombres=$fila['nombres'];
	$objUsuario->area=$fila['area'];
	$objUsuario->clave=$fila['clave'];
	$objUsuario->fechaNac=$fila['fechaNac'];
	$objUsuario->curriculum="No se transfiere";
	array_push($usuarios,$objUsuario);
}

$objUsuarios = new stdClass();
$objUsuarios->usuarios=$usuarios;
$objUsuarios->cuenta=$resultadoCuentaUsuarios;

$salidaJson = json_encode($objUsuarios);

$mysqli->close();
echo $salidaJson;
?>