<?php
function autenticacion($arg1,$arg2) {
	/*Esta función evalua el login y la contraseña,lo compara con lo almacenado en el disco y
	devuelve un true o un false si no autentica al usuario
	ATENCION: Todo lo que escribe esta función en el navegador remoto es solo para el ejercicio.
	Comentar todas estas salidas cuando se trate de un sistema en produción.
	*/
	
	$loginDeUsuario = $arg1;
	$clave = $arg2;
	$claveEncriptada = sha1(trim($_POST['clave']));

	//echo $claveEncriptada;
	//die("alla");

 	$salidaParaLog = "***Texto por consola de la función autenticacion()*** \n";   
 	$salidaParaLog = $salidaParaLog . "Fecha: " . date('dmy') . "\n";
	$salidaParaLog = $salidaParaLog . "login ingresado por el usuario:" . $loginDeUsuario . "\n";
	$salidaParaLog = $salidaParaLog . "clave ingresada por el usuario: " . $clave . "\n";
	$salidaParaLog = $salidaParaLog . "clave ingresada por el usuario encriptada: " . $claveEncriptada . "\n";

	include("./datosConexionBase.php");

	try {
		$dsn = "mysql:host=$host;dbname=$dbname";
		$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
		$salidaParaLog = $salidaParaLog .  "\nconexion exitosa";
	} catch (PDOException $e) {
		$salidaParaLog = $salidaParaLog . "\n" . $e->getMessage();
	}

	$sql="select * from usuarios where loginDeUsuario=:loginDeUsuario";

	$stmt = $dbh->prepare($sql);

	$stmt->bindParam(':loginDeUsuario', $loginDeUsuario);


	$stmt->execute();

	$fila = $stmt->fetch();

	$objArticulo = new stdClass();

	if (($fila['loginDeUsuario']==$loginDeUsuario)&&($fila['loginDeUsuario']<>"")) {
		$salidaParaLog = $salidaParaLog . "Usuario correcto\n";
		if ($fila['clave']==$claveEncriptada) {
			$Aceptado=true;
		}
		else {
			$Aceptado=false;
			$salidaParaLog = $salidaParaLog . "Contraseña incorrecta\n";
		}
	}

	else {
		$salidaParaLog = $salidaParaLog . "Usuario NO existente\n";	
	}

	$salidaParaLog = $salidaParaLog . "***Fin texto por consola la función autenticacion()***\n\n";

	return $Aceptado;
}	




function infoDeSesion() {

	echo "<div style='border-style:solid;border-width:thin;padding:10px'>";	
	echo "<h1>Información de Sesión</h1>";
	echo "<h2> Identificativo de sesión: " . $_SESSION['identificativo'] . "</h2>";
	echo "<h2> Login de usuario: " . $_SESSION['login'] . "</h2>";
	echo "<h2> Contador de sesión: " . $_SESSION['contador'] . "</h2>";

	if (isset($_SESSION['temperatura'])){
		echo "<h2> Temperatura: " . $_SESSION['temperatura'] . "</h2>";
	}
	if (isset($_SESSION['presion'])){
		echo "<h2> Presión: " . $_SESSION['presion'] . "</h2>";
	}
	if (isset($_SESSION['fechaUltimaAdquisicion'])){
		echo "<h2> Fecha Ultima Adquisicion: " . $_SESSION['fechaUltimaAdquisicion'] . "</h2>";
	}
	if (isset($_SESSION['horaUltimaAdquisicion'])){
		echo "<h2> Hora Ultima Adquisicion: " . $_SESSION['horaUltimaAdquisicion'] . "</h2>";
	}

	echo "</div>";
}

?>