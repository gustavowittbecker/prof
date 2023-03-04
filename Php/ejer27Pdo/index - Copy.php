<?php
echo "Drivers</br>";
echo PDO::getAvailableDrivers();

$dbname="prueba";
$host="localhost";
$user ="root";
$password = "";


try {
	$dsn = "mysql:host=$host;dbname=$dbname";
	$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
	echo "conexion exitosa ,<br />";
} catch (PDOException $e) {
	echo $e->getMessage();

}
/*
$stmt = $dbh->prepare ("insert into usuarios (nombre, apellido, saldo) values (:nombre, :apellido, :saldo)");

$nombre ="Roberto";
$apellido ="Eribe";
$saldo="1500";

$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);
$stmt->bindParam(':saldo', $saldo);

$stmt->execute();
*/

$stmt = $dbh->prepare("select * from usuarios");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

While($row = $stmt->fetch()) {
	echo "Nombre: " . $row["nombre"] . "<br />";
	echo "Apellido: " . $row["apellido"] . "<br />";
	echo "Saldo: " . $row["saldo"] . "<br /> <br />";

}

$dbh = null; /*para cerrar la conexion*/



?>
