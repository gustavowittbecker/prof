<?php
session_start(); //registra el identificativo de sesión entrante 
//y coloca el puntero de php en la fila que se corresponde con el mismo
//si no viene ningun id de sesión o si el que viene no se corresponde con ninguno existente, entonces el puntero
//se coloca en una fila vacía.
include('./libreria.inc');

include('datosConexionBase.php');

$varLogin=$_POST['login'];//lee la variable de formulario
$varClave=$_POST['clave'];//lee la variable de formulario

$salidaParaLog = "Salida para log: <br/>";
$salidaParaLog = $salidaParaLog . $varLogin;
$salidaParaLog = $salidaParaLog . "<br />";
$salidaParaLog = $salidaParaLog . $varClave;
$salidaParaLog = $salidaParaLog . "<br />";

if (!isset($_SESSION['identificativo'])) {

	$salidaParaLog = $salidaParaLog . "Usuario se encuentra fuera de sesion, luego pasamos a autenticar:";
	$salidaParaLog = $salidaParaLog . "<br />";

	if (!autenticacion($varLogin,$varClave)) { //Si no autentica termina el programa
		header('Location: ./formularioDeLogin.html'); //Envia un header en crudo (sin procesar) al cliente
		exit();
	}

	$salidaParaLog = $salidaParaLog . "El Usuario fue autenticado";
	$salidaParaLog = $salidaParaLog . "<br />";

	$_SESSION['identificativo'] = session_create_id();

	$_SESSION['login']=$varLogin;					//crea una variable de sesion para el nombre de usuario




	try {
		$dsn = "mysql:host=$host;dbname=$dbname";
		$dbh = new PDO($dsn, $user, $password);	/*Database Handle*/
		$salidaParaLog = $salidaParaLog .  "<br />conexion exitosa a la base para tomar nro de contador";
	} 
	catch (PDOException $e) {
		$salidaParaLog = $salidaParaLog . "<br />Codigo de error en el acceso a la base para levantar nro de contador" . $e->getMessage();
	}


	$sql="select * from usuarios where loginDeUsuario=:loginDeUsuario";

	$stmt = $dbh->prepare($sql);

	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	$stmt->bindParam(':loginDeUsuario', $varLogin);


	$stmt->execute();

	$fila = $stmt->fetch();

	$contador = $fila['contador'];

	$salidaParaLog = $salidaParaLog .  "<br />Nro de contador: " . $contador;

	$contador = $contador +1; 
	$_SESSION['contador'] = $contador;

	$salidaParaLog = $salidaParaLog .  "<br />Nro de contador +1: " . $contador;

$sql="update usuarios set contador=:contador where loginDeUsuario=:loginDeUsuario;";

$stmt = $dbh->prepare($sql);

$stmt->bindParam(':loginDeUsuario', $varLogin);
$stmt->bindParam(':contador', $contador);

try {
	$stmt->execute();	
	$salidaParaLog = $salidaParaLog .  "<br />Nro de contador en la ejecucion: " . $contador;
} catch (PDOException $e) {
	$respuesta_estado = $respuesta_estado . "\n<br />" . $e->getMessage();
}


}

//Aqui estamos si la sesión estaba iniciada con anterioridad

//echo $salidaParaLog;

infoDeSesion();
?>
<button id="btAppMod1" >Ingrese al módulo 1 de la app</button>
<button id="btAppFinSesion" >Terminar sesión</button>

<script>
document.getElementById("btAppMod1").onclick=function(){
	location.href="./app_modulo1";
}

document.getElementById("btAppFinSesion").onclick=function(){
	location.href="./destruirsesion.php";
}
</script>
