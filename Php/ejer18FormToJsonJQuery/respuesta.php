<?php
sleep(2);

$objRenglonUsuario = new stdclass; // instanciacion de objeto para que php no arroje un warning
$objRenglonUsuario->idUsuario = $_POST['idUsuario'];
$objRenglonUsuario->loginDeUsuario = $_POST['loginDeUsuario'];
$objRenglonUsuario->apellido = $_POST['apellido'];
$objRenglonUsuario->nombres = $_POST['nombres'];
$objRenglonUsuario->fechaNac = $_POST['fechaNac'];

//echo $objRenglonUsuario->apellido;

$jsonRenglon= json_encode($objRenglonUsuario);
echo $jsonRenglon;

?>