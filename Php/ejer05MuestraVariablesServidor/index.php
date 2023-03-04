<!--ejer03VariablesDeServidor-->
<HTML>
<HEAD>
<link type="" rel="stylesheet" href="./estilo.css">
</HEAD>
<BODY>


<?php
//ejer03serverVars
echo "<h1>Variables de servidor</h1>";
echo "<table border='1' cellspacing='0'>";

echo "<tr>";
echo "<td>";
echo "SERVER_ADDR";
echo "</td><td>";
echo $_SERVER['SERVER_ADDR'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "SERVER_PORT";
echo "</td><td>";
echo $_SERVER['SERVER_PORT'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "SERVER_NAME";
echo "</td><td>";
echo $_SERVER['SERVER_NAME'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "HTTP_HOST";
echo "</td><td>";
echo $_SERVER['HTTP_HOST'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "DOCUMENT_ROOT";
echo "</td><td>";
echo $_SERVER['DOCUMENT_ROOT'];
echo "</td>";
echo "</tr>";


echo "</table>";


echo "<h1>Variables de cliente</h1>";
echo "<table border='1' cellspacing='0'>";

echo "<tr>";
echo "<td>";
echo "REMOTE_ADDR";
echo "</td><td>";
echo $_SERVER['REMOTE_ADDR'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "REMOTE_PORT";
echo "</td><td>";
echo $_SERVER['REMOTE_PORT'];
echo "</td>";
echo "</tr>";

echo "</table>";



echo "<h1>Variables de Requerimiento</h1>";
echo "<table border='1' cellspacing='0'>";

echo "<tr>";
echo "<td>";
echo "SCRIPT_NAME";
echo "</td><td>";
echo $_SERVER['SCRIPT_NAME'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "REQUEST_METHOD";
echo "</td><td>";
echo $_SERVER['REQUEST_METHOD'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "REQUEST_URI";
echo "</td><td>";
echo $_SERVER['REQUEST_URI'];
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "QUERY_STRING";
echo "</td><td>";
echo $_SERVER['QUERY_STRING'];
echo "</td>";
echo "</tr>";

echo "</table>";



echo "<h1>TODAS</h1>";


foreach($_SERVER as $key_name => $key_value) {

echo $key_name . "=" . $key_value . "<br />";

}


?>