<?php
include("./auth.inc");

//TOMO PARAMETROS PARA BUSQUEDA O ALTA
$usuario = $_GET['usuario'];
$password = $_GET['password'];
$accion = $_GET['action']; //PARA SABER SI LOGUEA O REGISTRA

//VARIABLES DE ERROR O EXITO QUE SE VAN A LLENAR DEPENDIENDO EL RESULTADO DE LA OPERACION
$error = "";
$exito = "";

//SI QUIERO LOGUEAR
if ($accion == 'login') {
    //MANDO A AUTENTICAR
    if (autenticar($usuario, $password) == false) {
        //CARGO VARIABLE DE ERROR EN URL PARAMS
		$error = "Usuario Inexistente | Contraseña Incorrecta";
        header("location:./formularioLogin.html?error=$error");
        exit();
    }
	else {
		$exito = "¡Ingreso Correcto!";
	}
} 
//SI QUIERO REGISTRAR
else if ($accion == 'register') {
    //MANDO A REGISTRAR
    if (registrar($usuario, $password) == false) {
        //CARGO VARIABLE DE ERROR EN URL PARAMS
		$error = "Usuario Ya Existe";
        header("location:./formularioLogin.html?error=$error");
        exit();
    }
	else {
		$exito = "¡Registrado con Exito!";
	}
}

//CREO ID DE SESION EN TABLA
session_start();
$_SESSION['idSesion'] = session_create_id();
$_SESSION['usuario'] = $usuario;
$_SESSION['password'] = $password;

//REDIRECCIONO CON VALOR DE EXITO
header("location:./index.php?exito=$exito");
?>