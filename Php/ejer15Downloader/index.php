<?php
//Este codigo presenta al cliente una lista de archivos para descargar. El usuario elige
//el nombre y lo envia como parametro en un requeriminto GET al programa ejerDownload.php

echo "<h2>Archivos para leer usando un simple link a los mismos</h2>";
$punt_dir = opendir("./bajada");
while ($file = readdir($punt_dir)) {
	if (($file != ".") && ($file != "..")) {
	echo "<br /><a href='./bajada/$file'>$file</a>";
	}
}
closedir($punt_dir);


echo "<h2>Archivos para descargar usando streaming de datos  </h2>";
$punt_dir = opendir("./bajada");
while ($file = readdir($punt_dir)) {
	if (($file != ".") && ($file != "..")) {
	echo "<br /><a href='./ejerDownload.php?f=$file'>$file</a>";
	}
}
closedir($punt_dir);

?>