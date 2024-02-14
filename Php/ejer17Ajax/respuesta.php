<?php
sleep(1); /* Un segundo de delay */
echo "Request_method: ";
echo $_SERVER['REQUEST_METHOD'] . "</br>";
echo "Clave:  ";
echo  $_POST['clave'];

echo "<h4>Clave encriptada en md5 (128 bits o 16 pares hexadecimales): </h4>";
$claveEncriptada = md5($_POST['clave']);
echo $claveEncriptada;


echo "<h4>Clave encriptada en sha1 (160 bits o 20 pares hexadecimales): </h4>";
$claveEncriptada = sha1($_POST['clave']);
echo $claveEncriptada;
?>