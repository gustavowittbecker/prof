<!--ejer02require.php-->
<HTML>
<HEAD>
</HEAD>
<BODY>
<!--Función require para incluir codigo php. Si el file no existe tira un mensaje 
de error y termina el script -->
<?php

echo "<h2>En este ejemplo se utiliza la funcion require() que ubica codigo php definido
 en el archivo ejemplo2.inc : </h2>";
 
echo "<h2>Antes de ejecutar el require() las variables declaradas en el mismo no existen<br />";
echo "Las variables son:  </h2>";

echo "\$articulo= " . $articulo . "<br />";
echo "\$color= " . $color . "<br />";


require("./ejemplo2.inc");

echo "<h2>Aqui ya se ejecuto la función require(). Cuando se usa requiere() ocurre que si el archivo 'inc'
no existe, se visualiza un warning y el script es cancelado</h2>";

echo "<h2>Las variables definidas en el inc son: <br />";
echo "$articulo $color </h2>";

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
echo "<h2>La longitud de los arreglos es : " . count($arreglo1) . "</h2>";

echo "<h2>Las funciones definidas en el inc cuando se invocan con argumentos 3 y 9 devuelven: <br />";
echo f1(3,9) . "</h2>";

?>

</BODY>
</HTML>
