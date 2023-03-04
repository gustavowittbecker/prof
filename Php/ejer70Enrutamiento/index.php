<!DOCTYPE html>

<html lang="es">

<head>

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

	<title>?</title>

	<meta name="description" content="?" />
	<meta name="keywords" content="?,?,?,?" />
	<meta name="author" content="" />

</head>

<body>

<main> 

	<header>
		<h1>Tablero de la aplicación</h1>
	</header>
<?php
	echo "<h1>REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "</h1>";

	$uri = $_SERVER['REQUEST_URI'];
	$uri = explode("/","$uri");
	echo "<br />Primer elemento del uri[0]: " . $uri[0];
	echo "<br />Segundo elemento del uri[1]: " . $uri[1];
	echo "<br />Tercer elemento del uri[2]: " . $uri[2];
	echo "<br />Cuarto elemento del uri[3]: " . $uri[3];
	if (isset($uri[5])) {
		echo "<br />Quinto elemento del uri[4]: " . $uri[4];
	}
	if (isset($uri[5])) {
		echo "<br />Sexto elemento del uri: " . $uri[5];
	}

	if ($uri[4]==="articulos") {
		header("Location: /prof/Php/ejer70Enrutamiento/salidaArticulos" );
		exit();
	}

	if ($uri[4]==="articulo") {
		echo "<br />Location: ./salidaArticulo?codArt=" . $uri[5];
		header("Location: /prof/Php/ejer70Enrutamiento/salidaArticulo?codArt=" . $uri[5]);
		exit();
	}

/*Continuar este ejercicio con las opciones de alta, baja y modificación de registros.*/



?>



	<nav>
		<!--No olvidar copiar todas las librerías necesarias a esta carpeta de enrutamiento - jquery por ejemplo
			que es usada por todos los scripts-->
		<!-- No se puede poner ./xxx porque estaría agregando el path escrito en el url original-->
		<button onclick="location.href='/prof/Php/ejer70Enrutamiento/ejer20BDLista/'">Lista Articulos</button>
		<button onclick="location.href='/prof/Php/ejer70Enrutamiento/ejer22BDListaOrdena'">Lista Articulos con orden</button>
		<button onclick="location.href='/prof/Php/ejer70Enrutamiento/ejer24DBListaOrdenaFiltra'">Lista Articulos con orden y filtro</button>
		<button onclick="location.href='/prof/Php/ejer70Enrutamiento/ejer26DBAbm'">Abm</button>
	</nav>

</main>


<h2>Probar hasta ahora de llamar a las api:</h2>
<h2>http://localhost/prof/Php/ejer70Enrutamiento/articulos</h2>
<h2>http://localhost/prof/Php/ejer70Enrutamiento/articulo/ALM03</h2>
<h2>http://localhost/prof/Php/ejer70Enrutamiento/articulo/ALM04</h2>
<br />
... Continuará ...


<footer>

	<address>
	</address>

</footer>

</body>
</html>