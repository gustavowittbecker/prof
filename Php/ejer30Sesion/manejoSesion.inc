<?php
session_start(); 
//registra el identificativo de sesion y lo busca entre los que estan en la tabla de sesiones establecidas
if (!isset($_SESSION['identificativo'])) { 
		//Entra aquí si no hay sesion iniciada
    	header('Location:../formularioDeLogin.html');
    	 //Envia un header http hacia el navegador
    	exit; //termina la ejecucion del script    	
}
?>