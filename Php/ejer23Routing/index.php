<?php
echo "<h1>REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "</h1>";

$uri = $_SERVER['REQUEST_URI'];
$uri = explode("/","$uri");

echo count($uri);

echo "<br />Primer elemento uri[0]: " . $uri[0];
echo "<br />Segundo elemento uri[1]: " . $uri[1];
echo "<br />Tercer elemento uri[2]: " . $uri[2];
echo "<br />Cuarto elemento del uri[3]: " . $uri[3];
echo "<br />Quinto elemento del uri[4]: " . $uri[4];



if (isset($uri[0])) {

	if ($uri[1]=="moduloVentas") {
		echo "<h1>si</h1>";
		if($uri[2]=="Clientes") {
			header("Location: /prof/Php/ejer21Routing/vistas/moduloVentas/clientes/index.php" );
		}
	}
	exit();
}
	


?>



