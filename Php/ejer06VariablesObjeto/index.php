<?php
/******************************Objetos de datos************************************************/

echo "<h1>Variables tipo objeto en PHP. Objeto renglon de pedido</h1>";

/*Primer articulo:*/
$objRenglonPedido = new stdclass; // instanciacion de objeto para que php no arroje un warning
$objRenglonPedido->codArt = "cp001";
$objRenglonPedido->descripcion = "jaguel 800 gr";
$objRenglonPedido->precioUnitario = 30;
$objRenglonPedido->cantidad = 2;


echo "<h1 style='color:blue'>\$objRenglonPedido</h1>";
echo "<br />Codigo de articulo: " . $objRenglonPedido->codArt;
echo "<br />Descripcion del articulo: " . $objRenglonPedido->descripcion;
echo "<br />Precio unitario: " . $objRenglonPedido->precioUnitario;
echo "<br />Cantidad: " . $objRenglonPedido->cantidad;

echo "<h1>Tipo de <span style='color:blue'>\$objRenglonPedido</span>: " . gettype($objRenglonPedido) . "</h1>";

echo "<h1>Definamos arreglo de pedidos: </h1>";

$renglonesPedido = [];



echo "<h1 style='color:blue'>\$renglonesPedido</h1>";
echo "<h1>Tipo de <span style='color:blue'>\$renglonesPedido</span>: " . gettype($renglonesPedido) . "</h1>";



array_push($renglonesPedido, $objRenglonPedido);


/*Segundo artículo:*/
$objRenglonPedido = new stdclass; // instanciacion de objeto para vaciar la variable temporal
$objRenglonPedido->codArt = "cp002";
$objRenglonPedido->descripcion = "atun 800 gr";
$objRenglonPedido->precioUnitario = 24;
$objRenglonPedido->cantidad = 3;


array_push($renglonesPedido, $objRenglonPedido);

//echo "<br />Aqui 0: " . $renglonesPedido[0]->codArt;
//echo "<br />Aqui 1: " . $renglonesPedido[1]->codArt;


echo "<h1>Tabula <span style='color:blue'>\$renglonesPedido</span>. Recorrer el arreglo de renglones y tabularlos con html:</h1>";

echo "<table>";
foreach ($renglonesPedido as $rp){
	echo "<tr>";
	echo "<td>" . $rp->codArt . "</td><td>" . $rp->descripcion . "</td><td>" . $rp->precioUnitario . "</td><td>" . $rp->cantidad . "</td>";
	echo "</tr>";
}
echo "</table>";

echo "<h2>Cantidad de renglones" . count($renglonesPedido) . "</h2>";


echo "<h1>Produccion de un objeto <span style='color:blue'>\$objRenglonesPedido</span> con dos atributos array renglonesPedido y cantidadDeRenglones </h1>";

$objRenglonesPedido = new stdClass();

$objRenglonesPedido->renglonesPedido=$renglonesPedido;
$objRenglonesPedido->cantidadDeRenglones=count($renglonesPedido);

echo "<br />Cantidad de renglones: " . $objRenglonesPedido->cantidadDeRenglones; 


echo "<h1>Produccion de un JSON jsonRenglones: </h1>";
$jsonRenglonesPedido= json_encode($objRenglonesPedido);
echo "<h4>" . $jsonRenglonesPedido . "</h4>";

?>