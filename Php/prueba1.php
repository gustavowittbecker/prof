<?php

$aNombresLatinos=["Jose", "Pedro"];
$aNombresSajones=["Harry","Jack"];
$aNombresChinos=["Yan","Fu"];

$origen=[$aNombresLatinos,$aNombresSajones,$aNombresChinos];

echo $origen[1][1];

echo "<br />";
echo gettype($origen[1][1]);

echo "<br />";

$renglonDeLiquidacion = ["legEmpleado"=>"c0001","Apellido"=>"Witt","salarioBasico"=>20000,"fechaIngr"=>date(10/10/2003)];


echo "<br />";
echo $renglonDeLiquidacion["salarioBasico"];
echo "<br />";
echo gettype($renglonDeLiquidacion["salarioBasico"]);
echo "<br />";
echo $renglonDeLiquidacion["fechaIngr"];
echo "<br />";
echo gettype($renglonDeLiquidacion["fechaIngr"]);

?>