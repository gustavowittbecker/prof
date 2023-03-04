<!--ejer02include.php-->
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link type="text/css" rel="stylesheet" href="./estilo.css" />
</head>

<?php

echo "<h2>En este ejemplo se utiliza la funcion require() que ubica codigo php definido
 en el archivo asignaciones.php : </h2>";


echo "<h2>Ejecutar el ejercicio primero sin el archivo asignaciones.php y luego  con el archivo agregado.
Visualizar la diferencia!!</h2>";



echo "<h2>Antes de insertar el require() las variables declaradas en el mismo no existen<br />";
echo "Las variables son: </h2>";



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



require("./asignaciones.php");/*Luego de este require si el archivo asignaciones no existe, el ciclo de ejecución terminará inmediatamente*/

echo "<h2>Aqui ya se ejecuto la función require(). Cuando se usa require() ocurre que si el archivo asociado
no existe la funcion devuelve un exception fatal error y la ejecución termina";

echo "<h2>Las 2 variables de tipo array asociativo en el inc son: </h2><br />";

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

echo "<h2>La longitud del arreglo1 es : " . count($arreglo1) . "</h2>";
echo "<h2>La longitud del arreglo2 es : " . count($arreglo2) . "</h2>";

?>

</BODY>
</HTML>

