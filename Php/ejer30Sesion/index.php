<?php
session_start();
if (!isset($_SESSION['identificativo'])) {  //Entra aquí si no hay sesion iniciada
    	header('Location:./formularioDeLogin.html');
    	exit; //termina la ejecucion del script   	
}
include('./libreria.inc');

echo "<h1>Nombre de la aplicación: Práctica sobre maestro de artículos.</h1>";
echo "<h2> Nombre del alumno: </h2>";
echo "<h2>Sus parametros de sesion son los siguientes: </h2>";
echo infoDeSesion();

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

