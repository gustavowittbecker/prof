<?php 
echo "<p>Este Texto esta dentro del .inc <br>
Este file .inc incluye la carga de la variable color con el valor verde, la carga de la variable articulo
con el valor llavero, la carga de un array asociativo 'Gustavo Witt 1956', y una funcion que recibe
dos argumentos y calcula el promedio </p>";

//Cargando variables simples
$color = 'verde';
$articulo = 'llavero';


//Cargando  arrays asociativos:
$arreglo1=[nombre=>"Gustavo", apellido=>"Witt", naci=>"1956"];
$arreglo2=["nombre"=>"Patricia", apellido=>"Witt", naci=>"1957"];

//Definiendo una función
function f1($arg1,$arg2) {
$promedio = ($arg1+$arg2)/2;
return $promedio;
}



?>