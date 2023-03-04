<!--ejer01BASE-->
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="./estilo.css" />
</head>
<body>
<!--Lo siguiente es html que será entregado directamente en la respuesta http-->


<h4>Todo lo escrito fuera de las marcas de php es entregado en la respuesta http sin pasar por el procesador php</h4>


<?php

/* Esto es un comentario dentro
   del codigo php */
// Esta es otra forma de comentar dentro de php
#  Esta es otra forma de comentar dentro de php

echo "<hr /><h4>Texto y/o HTML <span style='color:gray'>entregado por el procesador php usando la sentencia echo.</span></h4>";





//Concatenacion de variables y strings
//Primera forma aplicable a variables simples
echo "<hr />";

$mivariable="valor1";
echo "<h4>Sin usar concatenador <span style='color:blue'> \$mivariable </span>: $mivariable</h4>";

//Segunda forma aplicable a variables complejas como array u objetos.
echo "<h4>Usando concatenador <span style='color:blue'>\$mivariable</span> : " . $mivariable . "</h4>";
echo "<h4>El tipo de <span style='color:blue'>\$mivariable</span> es: " . gettype($mivariable) . "</h4>";

echo "<hr />";


echo "<p> Fecha del servidor: " .  date("Y-m-d H:i:s") . "</p>";




//Variables booleanas o logicas

$mivariable=true;

echo "<h4>variable tipo booleanas o logicas (verdadero) <span style='color:blue'>\$mivariable </span>: " . $mivariable . "</h4>";
echo "<h4>El tipo de <span style='color:blue'>\$mivariable</span> es: " . gettype($mivariable) . "</h4>";



$mivariable=false;

echo "<h4>variable tipo booleanas o logicas (falso) <span style='color:blue'>\$mivariable </span>: " . $mivariable . "</h4>";
echo "<h4>El tipo de <span style='color:blue'>\$mivariable</span> es: " . gettype($mivariable) . "</h4>";


//Definición y uso de una constante
echo "<hr />";
define("MICONSTANTE","valorConstante");
echo "<h4> <span style='color:blue'>MICONSTANTE </span>: " . MICONSTANTE . "</h4>";
echo "<h4>Tipo de <span style='color:blue'> MICONSTANTE</span>: " . gettype(MICONSTANTE);


/*--------------------------------------------*/
/*Arrays*/
/*
Ejemplos:
Si hay 2 dimensiones tienen que haber 2 variables y un valor. .
Variable 1 - Variable2 - valor
Cliente - mes - venta
Producto - mes- venta
Cliente - producto -venta.
Palabra - Idioma - traducción.
Oficio - Pais - Nro de personas
Auto - Pais- unidades Vendidas
*/


echo "<hr />";
echo "<h3>Arreglos:</h3>";


$aPalabra = ["hola","hello"]; /*Un array de palabra en multiples idiomas con un par de elementos iniciales*/
echo "<h4><span style='color:blue'>\$aPalabra[0]</span>:" . $aPalabra[0] . "</h4>";
echo "<h4><span style='color:blue'>\$aPalabra[1]</span>:" . $aPalabra[1] . "</h4>";


echo "<h4>Tipo de <span style='color:blue'>\$aPalabra </span>: " . gettype($aPalabra);

/*Un array de palabras en multiples idiomas sin elementos iniciales*/

echo "<h4>Se agregan por programa dos elementos nuevos</h4>";
array_push($aPalabra,"ciao");
array_push($aPalabra,"bonjour");



/*Muestra primier palabra*/

echo "<h3>Todos los elementos originales y agregados: </h3>";
echo "<ul>";
foreach($aPalabra as $elemento) {
echo "<li>" . $elemento . "</li>";
}
echo "</ul>";

/*Carga Diccionario*/

echo "<h3>Arreglo de dos dimensiones (diccionario)</h3>";

$aDiccionarioBasico = []; 
array_push($aDiccionarioBasico,$aPalabra); /*Se carga el diccionario con la primera palabra*/



/*Vuelve a inicializar la variable para que 
no conserve los elementos cargados previamente*/
$aPalabra=[]; 

/*Carga segunda palabra*/
array_push($aPalabra,"adios");
array_push($aPalabra,"good by");
array_push($aPalabra,"arrivederci");
array_push($aPalabra,"au revoir");

array_push($aDiccionarioBasico,$aPalabra);/*Se carga el diccionario con la segunda palabra*/


/*------------------------------------------------*/
/*Vuelve a inicializar la variable para que 
no conserve los elementos cargados previamente*/

/*Carga tercer palabra*/
$aPalabra=[];
array_push($aPalabra,"casa");
array_push($aPalabra,"house");
array_push($aPalabra,"casa");
array_push($aPalabra,"maison");



array_push($aDiccionarioBasico,$aPalabra);/*Se carga el diccionario con la tercer palabra*/


/*Muestra Concatenación entre texto, html y arreglos multidimensionales:
El formato de tabla se tomara del archivo ./estilo.css :*/

/*Muestra array de registros*/
echo "<h4>La variable \$aDiccionarioBasico tiene el siguiente tipo: " . gettype($aDiccionarioBasico);
echo "<table>";
echo "<th>Español</th><th>Ingles</th><th>Italiano</th><th>Francés<th></th>";

foreach($aDiccionarioBasico as $aPalabra	) {

	echo "<tr>";
	foreach($aPalabra as $idioma) {
		echo "<td>" . $idioma . "</td>";
	}
	echo "</tr>";

}
echo "</table>";

echo "<h2>Tambien asi se puede expresar el valor de \$aDiccionarioBasico[1][3]:" . $aDiccionarioBasico[1][3] . "</h2>";

echo "<h2>Cantidad de elementos de diccionario: " . count($aDiccionarioBasico);



/******************************Arreglo asociativo************************************************/

echo "<h1>Variables tipo arreglo asociativo</h1>";
echo "<p>Cargar por programa una variable de tipo arreglo asociativo y mostrar sus atributos, la
cantidad de elementos y los tipos de cada uno de ellos</p>";

$renglonPedido = ["codArt"=>"cp001","descripcion"=> "jaguel","precioUnitario"=>20,"cantidad"=>2];


echo "<br />Codigo de articulo: " . $renglonPedido['codArt'];
echo "<br />tipo del elemento: " . gettype($renglonPedido['codArt']);
echo "<br />Descripcion del articulo: " . $renglonPedido['descripcion'];
echo "<br />tipo del elemento: " . gettype($renglonPedido['descripcion']);
echo "<br />Precio unitario: " . $renglonPedido['precioUnitario'];
echo "<br />tipo del elemento: " . gettype($renglonPedido['precioUnitario']);
echo "<br />Cantidad: " . $renglonPedido['cantidad'];
echo "<br />tipo del elemento: " . gettype($renglonPedido['cantidad']);
echo "<br /><br />Cantidad de elementos del arreglo: " . count($renglonPedido);
echo "<br />Tipo de dato del arreglo: " . gettype($renglonPedido);



/*----------------------------------------------------------------------*/

echo "<hr /><h4>Expresiones aritmeticas</h4>";
$x = 3;
$y = 4;

echo "<h4>La variable \$x tiene el siguiente valor: " . $x;
echo "<h4>La variable \$y tiene el siguiente valor: " . $y;
echo "<h4>La variable \$x tiene el siguiente tipo: " . gettype($x);
echo "<h4>La variable \$y tiene el siguiente tipo: " . gettype($y);
echo "<h4> Asi se imrime una expresión aritmetica por ejemplo de Suma: (\$x + \$y) = " . ($x + $y) . "</h4>";
echo "<h4> Asi se imrime una expresión aritmetica por ejemplo de Multiplicación: \$x * \$y = " . $x * $y  . "</h4>";
echo "<h4> Asi se imrime una expresión aritmetica por ejemplo de División: \$x / \$y = " . $x / $y  . "</h4>";
/*------------------------------------------------------------------*/

/*Globales*/

echo "<h4>Las variables definidas fuera de toda función tienen alcance global y se encuentran
referenciadas en un array asociativo global \$GLOBALS[] </h4>";

$n1=40;
$n2=50;

function suman1n2() {
	return $GLOBALS['n1']+$GLOBALS['n2'];
}
echo "Suma de variables en el ambito global: " . suman1n2();

/*
echo "<hr />";
echo "<h2>Funciones y Alcance de variables: </h2>";


function mifuncion1() {
 	$pais = "Alemania";
	echo "Desde adentro de mifuncion1() o sea en el ámbito simple el valor de \$pais : $pais";
}

function mifuncion2() {
	global $pais;
	$pais="Italia"; 
  	echo "<br />Desde adentro de mifuncion2() muestra \$pais : $pais" ;
}
function mifuncion3() {
	$pais="Francia"; 
	return $pais;
}

echo "<h2>Desde afuera de toda funcion se asigna el valor españa a una variable global \$pais </h2>";
$pais = "España";
echo "1)\$pais= " . $pais;


echo "<h2>Ejecuto el procedimiento mifuncion1() y  la variable global \$pais no se modifica debido a que el alcance es local</h2>";
mifuncion1();

echo "<br />2)Ahora desde afuera \$pais tiene valor: $pais ";

echo "<h2>Ejecuto el procedimiento mifuncion2() y  la variable global \$pais si se modifica</h2>";
mifuncion2();

echo "<br />3)Ahora desde afuera \$pais tiene valor: $pais ";


echo "<h2>Ejecuto la funcion mifuncion3() asignando su salida a \$pais</h2>";
$pais = mifuncion3();
echo "4)Ahora desde afuera \$pais tiene valor: $pais";
*/
?>

</body>
</html>


