<?php
/*
ejer06escribeYLeeFile.php
Este ejercicio debe permitir ingresar 2 inputs de formulario.
Al recibir el formulario debe imprimir en un file "registro.log" los valores 
obtenidos usando ":" como separador de campos y ; como separador de registros.
Además, luego de la inserción debe leer todo el archivo completo y mostrarlo con formato de tabla.
*/
?>

<html>
<head>
<style>
div#contenedor {
width:80%;
margin:auto;
background-color:lightblue;
padding:10px;
}
table{
border:solid;border-width:1px;border-color:lightgray;border-collapse:collapse;
}
td {
border:solid;border-width:1px;border-color:lightgray;
}

</style>
</head>
<body>
<div id="contenedor">
<?php

$legajo = $_GET['legajo'];
$nombre = $_GET['nombre'];

$archivo="./registro.log";

$punt=fopen($archivo,"a");
if($punt) {
/*Recordar que el archivo de destino debe tener permiso de escritura para el usuario apache.*/
fputs($punt,$legajo);
fputs($punt,":");
fputs($punt,$nombre);
fputs($punt,";\n");
fclose($punt);


$punt = fopen($archivo,"r");
$contents = fread($punt, filesize($archivo));
fclose($punt);
$arrUsuarios = explode(";",$contents); //Se crea la lista de usuarios como un array en memoria

//muestra tabla completa:
echo "<table>";

foreach($arrUsuarios as $usr) {
		$arraCampos = explode(":",$usr);
		echo "<tr><td>" . $arraCampos[0]  . "</td>";
		echo "<td>" . $arraCampos[1]  . "</td></tr>";
}

echo "</table>";

}
else {
echo "<h1>Error al abrir el archivo de logs</h1>";
}

?>

<button id="volver">Volver</button>
<script>
document.getElementById("volver").onclick = function() {
	//history.back();
	window.close();
}
</script>

</div> <!--cierra contenedor-->
</body>
</html>


