<?php
//ejer42Encript
if (isset($_POST['submit'])) {
echo "<br />Clave:  ";
echo  $_POST['clave'] . "<br>";
echo "Clave encriptada en md5 (128 bits o 16 pares hexadecimales): ";
$claveEncriptada = md5($_POST['clave']);
echo "<br />$claveEncriptada";

echo "<br />Clave:  ";
echo  $_POST['clave'] . "<br>";
echo "Clave encriptada en sha1 (160 bits o 20 pares hexadecimales): ";
$claveEncriptada = sha1($_POST['clave']);
echo "<br />$claveEncriptada";

}
else {
?>
<html>
<body>
<center>
<form method="post" action="./index.php">
Ingrese la clave a encriptar: <input type="text" name="clave"> <BR>
<input type="submit" name="submit" value="Obtener encriptacion">
</form>
</center>
</body>
</html>
<?php
}
?>

