<?php
session_start(); //registra el identificativo de sesión entrante 
//y coloca el puntero de php en la fila que se corresponde con el mismo
//si no viene ningun id de sesión o si el que viene no se corresponde con ninguno existente, entonces el puntero
//se coloca en una fila vacía.

include('./libreria.inc');

$log=$_POST['login'];//lee la variable de formulario
$cl=$_POST['clave'];//lee la variable de formulario


if (!isset($_SESSION['identificativo'])) {

		if (!autenticacion($log,$cl)) { //Si no autentica termina el programa
				header('Location: ./formularioDeLogin.html'); //Envia un header en crudo (sin procesar) al cliente
				exit();
		}

			echo "<h1>Acceso permitido</h1>";
					

			$_SESSION['identificativo'] = session_create_id();

												
			$_SESSION['login']=$log;					//crea una variable de sesion para el nombre de usuario
							
			$puntcontador = fopen("./contador.txt","r");//crea un puntero al file que contiene el contador 
															//de paginas
			$lineacontador = fgets($puntcontador);//lee solo la primera linea del file
											//cada fgets lee una línea y aumenta del cursor en uno
			$contador = $lineacontador + 1;
			fclose($puntcontador);
					
			echo "Cantidad de sesiones hasta el momento: " . $contador;


			$puntcontador = fopen("./contador.txt","w");
			if (!$puntcontador) { //crea un puntero al file contador pero en modo write
				echo "<h1>El archivo contador.txt no ha podido ser actualizado</h1>";
			}
			fputs($puntcontador, $contador);//escribe en el file contador el nuevo numero incremetado
			fclose($puntcontador); 
					
			$_SESSION['contador']=$contador;				//crea nueva variable de sesión

			
}
echo infoDeSesion();
?>
<br />
<button id="btContinuar">Continuar...</button>

<script>
	document.getElementById("btContinuar").onclick=function(){
		location.href="./index.php";
	}
</script>

