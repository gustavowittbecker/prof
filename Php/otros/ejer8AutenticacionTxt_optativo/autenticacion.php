<?
//ejer08Autenticacion/autenticacion.php
function autenticacion($arg1,$arg2) {
	//Esta función evalua el login y la contraseña,lo compara con lo almacenado en el disco y
	//admite o denega el acceso

	$login = $arg1;
	$clave = $arg2;
	
	$claveEncriptada = md5(trim($_GET['clave']));
	//echo "<br>El login: " . $login;	
	//echo "<br>La clave encriptada es: " . $claveEncriptada;	
	
	$puntArchivoDeLogin = fopen("./passwd.txt","r");//crea un puntero al file que contiene
									//la clave encriptada
	$contents = fread($puntArchivoDeLogin, filesize("./passwd.txt"));
	fclose($puntArchivoDeLogin);
	
	$arrUsuarios = explode(";",$contents); //Se crea la lista de usuarios como un array en memoria
	
  foreach($arrUsuarios as $usr) {
	
		$arrCampos = explode(":",$usr);
		
		//echo "<p>" . $login . "<br />" . $arrCampos[0] . "</p>";
		//echo "<p>" . $claveEncriptada . "<br />" . $arrCampos[1] . "</p>";
				
		if (($login == trim($arrCampos[0]))  && ($claveEncriptada==trim($arrCampos[1]))){
			$Aceptado=true; //prende bandera de aceptado		
		}
  }

	if(isset($Aceptado)) {
		return $Aceptado;	
	}
	else {
		$Aceptado=false;
		return $Aceptado;
	}

}

$log=$_GET['login'];//lee la variable de formulario
$cl=$_GET['clave'];//lee la variable de formulario 

if (autenticacion($log,$cl)) {
	//La función autenticación devuelve un true si el usuario es autenticado y un false en caso contrario
	echo "<h1>Usuario Autenticado</h1>";		
	}
	else {
	echo "<h1>Usuario NO Autenticado</h1>";
	}
echo "<h2><button onClick=\"location.href='./index.html'\">Volver al formulario</h2>";
?>