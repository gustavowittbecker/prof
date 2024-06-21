<?php
//sleep(2);
$objRenglonUsuario = new stdclass; // instanciacion de objeto para que php no arroje un warning
$objRenglonUsuario->idUsuario = $_GET['idUsuario'];
$objRenglonUsuario->loginDeUsuario = $_GET['loginDeUsuario'];
$objRenglonUsuario->apellido = $_GET['apellido'];
//$objRenglonUsuario->nombres = $_GET['nombres'];
//$objRenglonUsuario->fechaNac = $_GET['fechaNac'];

//echo $objRenglonUsuario->apellido;

$jsonRenglon= json_encode($objRenglonUsuario);

//$jsonRenglon = '{"login":"gwittbecker","apellido":"Witt"}';

echo $jsonRenglon;

?>