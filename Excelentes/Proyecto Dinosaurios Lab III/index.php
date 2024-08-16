<?php
	include("./manejoSesion.inc");
	include("./datosConexionDB.inc");

	// TRAIGO DATOS DEL USUARIO PARA MOSTRARLO
	$dsn = "mysql:host=$host;dbname=$dbname";
	$dbh = new PDO($dsn, $user, $password);

	$usuario = $_SESSION['usuario'];

	$sql = "SELECT nickname, contador FROM usuarios WHERE nickname = :usuario";
	$stmt = $dbh->prepare($sql);
	$stmt->execute([':usuario' => $usuario]);
	$usuarioDatos = $stmt->fetch(PDO::FETCH_ASSOC);

	$id = $_SESSION['idSesion'];

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./main.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Inicio</title>
	</head>

	<body>

		<main>
			<div class="inicio">
				<h1 id="titulo">¡Bienvenido!</h1>
				<div class="border"></div>
				<div class="internal_container">
					<h3 id="id_session">ID Sesión:</h3>
					<p id="cantLogueos">Has logueado en esta aplicación unas</p>
				</div>
				<div class="border"></div>
				<div class="buttonContainer">
					<button class="form__boton" onclick="location.href='./app_modulo'">Ir a la app</button>
					<button class="form__boton" id="cerrarSesion">Cerrar Sesión</button>
				</div>
			</div>
		</main>

		<script src="./jquery-3.6.0.js"></script>
		<script type="text/javascript">
		
			//CERRAR SESION CON MENSAJE
			$("#cerrarSesion").click(function() {
				alert("Sesión Cerrada.");
				location.href="./cerrarSesion.php";
			});

			//TOMO DATOS DEL USUARIO, PARSEANDOLOS A JSON
			var usuarioDatos = <?php echo json_encode($usuarioDatos); ?>;
			var nickname = usuarioDatos.nickname;
			var contador = usuarioDatos.contador;
			var idSesion = <?php echo json_encode($id); ?>;

			//MUESTRO DATOS DEL USUARIO
			$("#titulo").text("¡Bienvenido " + nickname + "!");
			$("#cantLogueos").text("Cantidad de Logueos: " + contador);
			$("#id_session").text("ID Sesión: " + idSesion);

			//MOSTRAR MENSAJE DE EXITO DE LOGUEO O REGISTRO EN CASO DE QUE HAYA
			$(document).ready(function() {
				//BUSCO EL MENSAJE EN URLPARAMS
				var urlParams = new URLSearchParams(window.location.search);
				var exito = urlParams.get('exito');

				if (exito != "" && exito != null){
					alert(exito);
				}
    		});

		</script>

	</body>
</html>