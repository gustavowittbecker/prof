<?php
echo "Drivers</br>";
echo PDO::getAvailableDrivers();

$dbname="b3c1dnzjfajzfextbbcs";
$host="b3c1dnzjfajzfextbbcs-mysql.services.clever-cloud.com";
$user ="ubtjuyglm1htsjy0";
$password = "yzK5Hjq3yudhhhfTdyJ2";


try {
	$dsn = "mysql:host=$host;dbname=$dbname";
	$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
	echo "conexion exitosa ,<br />";
} catch (PDOException $e) {
	echo $e->getMessage();

}
/*
$stmt = $dbh->prepare ("insert into articulos (nombre, apellido, saldo) values (:nombre, :apellido, :saldo)");

$nombre ="Roberto";
$apellido ="Eribe";
$saldo="1500";

$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);
$stmt->bindParam(':saldo', $saldo);

$stmt->execute();
*/

$stmt = $dbh->prepare("select * from articulos");
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

While($row = $stmt->fetch()) {
	echo "codArt: " . $row["codArt"] . "<br />";
	echo "familia: " . $row["familia"] . "<br />";
	echo "descripcion: " . $row["descripcion"] . "<br /> <br />";

}

$dbh = null; /*para cerrar la conexion*/



?>
