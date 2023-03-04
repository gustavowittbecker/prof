<!--ejer02include.php-->
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="./estilo.css" />
</head>

<?php

echo "<h2>En este ejemplo se utiliza la funcion include() que ubica codigo php definido en otro archivo
asignaciones.php : </h2>";

 
echo "<h2>Ejecutar el ejercicio primero sin el archivo asignaciones.php y luego  con el archivo agregado.
Visualizar la diferencia!!</h2>";


echo "<h2>Antes de insertar el include las variables declaradas en el mismo no existen</h2>";
echo "<h2>Pero a pesar de ello el ciclo de ejecución continuará hasta el final</h2>";
echo "<h2>Las variables son: </h2>";



echo "<table border='1'>";

echo "<tr><td>" . 
$arreglo1['nombre'] . "</td><td>" . 
$arreglo1['apellido'] . "</td><td>" . 
$arreglo1['naci'] . 
"</td></tr>";

echo "<tr><td>" . 
$arreglo2['nombre'] . "</td><td>" . 
$arreglo2['apellido'] . "</td><td>" . 
$arreglo2['naci'] . 
"</td></tr>";


echo "</table>";


include("./asignaciones.php");

echo "<h2>Aqui ya se ejecuto la función include(). Cuando se usa include ocurre que si el archivo asociado
no existe, se visualiza un warning y el script sigue ejecutandose hasta el final</h2>";

echo "<h2>Las 2 variables de tipo array asociativo en el archivo asociado son: </h2><br />";

echo "<table border='1'>";

echo "<tr><td>" . 
$arreglo1['nombre'] . "</td><td>" . 
$arreglo1['apellido'] . "</td><td>" . 
$arreglo1['naci'] . 
"</td></tr>";

echo "<tr><td>" . 
$arreglo2['nombre'] . "</td><td>" . 
$arreglo2['apellido'] . "</td><td>" . 
$arreglo2['naci'] . 
"</td></tr>";


echo "</table>";

//Si la siguiente función count() era ejecutada antes del include el programa si hubiera arrojado un fatal error y
//hubiera terminado 
echo "<h2>La longitud del arreglo1 es : " . count($arreglo1) . "</h2>"; 
echo "<h2>La longitud del arreglo2 es : " . count($arreglo2) . "</h2>";

?>

</BODY>
</HTML>

