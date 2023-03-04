<!--ejer03cadenasyfechas-->
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html" />
<meta charset="utf-8" /> 
<link type="" rel="stylesheet" href="./estilo.css">

</HEAD>
<BODY>

<?php
echo "<table>";
echo "<h3>Funciones para imprimir fechas del servidor en distintos formatos</h3>" ;
date_default_timezone_set('America/Buenos_Aires');


$today = date("d.m.y"); 
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"d.m.y\") :</h4></td><td> " . $today . "</td></tr>";

$today = date("d/m/y"); 
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"d/m/a\") :</h4></td><td> " . $today . "</td></tr>";


$today = date("d-m-y"); 
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"d-m-y\") :</h4></td><td> " . $today . "</td></tr>";

//Dia del mes en número
$today = date("d");
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"d\") :</h4></td><td> " . $today . "</td></tr>";

//Dia de la semana en letras
$today = date("D");
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"D\") :</h4></td><td> " . $today . "</td></tr>";

//mes en numero
$today = date("m");
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"m\") :</h4></td><td> " . $today . "</td></tr>";

//mes en letras
$today = date("M");
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"M\") :</h4></td><td> " . $today . "</td></tr>";

//Año
$today = date("Y");
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"Y\") :</h4></td><td> " . $today . "</td></tr>";

//hora minutos segundos
$today = date("H:i:s");
echo  "<tr><td><h4>Dia de hoy devuelto por la función date(\"H:i:s\") :</h4></td><td> " . $today . "</td></tr>";

echo "</table>";

echo "<hr>";




function fechaactual() { //funcion que devuelve la fecha actual en formato personalizado

$diaEnNumero = date("d");

$diasemana = date("D");
switch ( $diasemana ) { 
    case "Mon": 
      $diasemana = "Lunes"; 
      break; 
	case "Tue": 
      $diasemana = "Martes"; 
      break; 
	case "Wed": 
      $diasemana = "Miercoles"; 
      break; 
	case "Thu": 
      $diasemana = "Jueves"; 
      break; 
	case "Fri": 
      $diasemana = "Viernes"; 
      break; 
	case "Sat": 
      $diasemana = "Sábado"; 
      break; 
	case "Sun": 
      $diasemana = "Domingo"; 
      break; 
}  

$mes = date("M");
switch ( $mes ) { 
    case "Jan": 
      $mes = "Enero"; 
      break; 
    case "Feb": 
      $mes = "Febrero"; 
    break; 
	case "Mar": 
      $mes = "Marzo"; 
    break;
	case "Apr": 
      $mes = "Abril"; 
    break;  	
	case "May": 
      $mes = "Mayo"; 
    break;  	
	case "Jun": 
      $mes = "Junio"; 
    break;
	case "Jul": 
      $mes = "Julio"; 
    break;  	
	case "Ago": 
      $mes = "Agosto"; 
    break;  	
	case "Sep": 
      $mes = "Setiembre"; 
    break;  	
	case "Oct": 
      $mes = "Octubre"; 
    break;  	
	case "Nov": 
      $mes = "Noviembre"; 
    break;  	
	case "Dic": 
      $mes = "Diciembre"; 
    break;  	
  	

	  
}  


$anio = date("Y");

return "<h4> " . $diasemana . "&nbsp;" . $diaEnNumero . " de " . $mes . " de " . $anio . "</h4>";
}



echo fechaactual(); //ejecuta la funcion definida anteriormente

?>

</BODY>
</HTML>

