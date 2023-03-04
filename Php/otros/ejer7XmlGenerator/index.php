<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" />
<meta charset="utf-8" /> 
<body>
<title></title>
</head>
<body>
<?php
$puntcontador = fopen("./contador.txt","r");//crea un puntero al file que contiene el contador 
												//de paginas
		$contador = fgets($puntcontador);//lee solo la primera linea del file
								//cada fgets lee una línea y aumenta del cursor en uno
		
		//echo "<br />contador: " . $contador;
		fclose($puntcontador);
		
		
		//echo $contador . "<br />";
		$numeroFormateado = sprintf('%09d', $contador);
		/*$_SESSION['contador']=$contador;*/	
		$nombreDocumento="esgn" . $numeroFormateado ;
		$nombreDocumentoCompleto=$nombreDocumento . ".pdf";
		//echo "<br>Nombre Documento: " . $nombreDocumento;
		
?>


<form action="./respuesta.php" target="_blank" method="get">


<h1>Generador de fichas xml</h1>

<table>
<tr>
<td><label for="id" >Id:</label></td>
<td><input type="text" id="id" name="id" value="<?php echo $numeroFormateado;?>" title="identificador de ficha" readonly="readonly" required=required></td>
</tr>

<tr>
<td><label for="tipoDeRecurso" >Tipo de recurso:</label></td>
<td><select id="tipoDeRecurso" name="tipoDeRecurso" title="Tipo de recurso" required=required>
<option value="archivo" selected="selected">archivo</option>
<option value ="enlace">Enlace</option>
</td>
</tr>

<tr>
<td><label for="categoríaRecurso" >Categoría del recurso:</label></td>
<td><select id="categoriaRecurso" name="categoriaRecurso" title="categoria del recurso" required=required>
<option value="pdf" selected="selected">pdf</option>
<option value ="planilla" >planilla</option>
<option value ="imagen" >imagen</option>
<option value ="audio" >audio</option>
<option value ="video" >video</option>
<option value ="texto" >texto</option>
<option value ="ppt" >power point</option>
</td>
</tr>

<tr>
<td><label for="titulo" >Titulo:</label></td>
<td><input type="text" id="" name="titulo" value="" title="identificador de ficha" required=required></td>
</tr>

<tr>
<td><label for="nombreDocumento" >Nombre del documento:</label></td>
<td><input type="text" id="nombreDocumento" name="nombreDocumento" value="<?php echo $nombreDocumento;?>" title="Nombre del documento" readonly="readonly" required=required></td>
</tr>
<!--
<tr>
<td><label for="path" >path:</label></td>
<td><input type="text" id="path" name="path" value="" title="Path" required=required></td>
</tr>
-->

<tr>
<td><label for="subseccion" >Subseccion</label></td>
<td><select type="text" id="subseccion" name="subseccion">
<option value="agendaDeActividadesDeCapacitacion">Agenda de actividades de capacitación</option>
<option value="evaluacion">Evaluación</option>
<option value="gestionEducativa">Gestión educativa</option>
<option value="herramientasParaElDocente">Herramientas para el docente</option>
<option value="planificacion">Planificación</option>
<option value="practicaDeLaEnse">Práctica de la enseñanza</option>
<option value="revistasEducativas">Revistas educativas</option>
<option value="teoriasEducativas">Teorías educativas</option>
<option value="ticYEducacion">Tic y educación</option>
<option value="varios">Varios</option>
</td>
</tr>
<!--
<tr>
<td><label for="url" >URL:</label></td>
<td><input type="text" id="url" name="url" value="" title="URL" required=required></td>
</tr>
-->




<tr>
<td><label for="autor" >Autor:</label></td>
<td><input type="text" id="autor" name="autor" value="" title="Autor" required=required></td>
</tr>

<tr>
<td><label for="curador" >Curador:</label></td>
<td><input type="text" id="curador" name="curador" value="" title="Curador" required=required></td>
</tr>

<tr>
<td><label for="fechaDeCreacion" >Fecha de creación:</label></td>
<td><input type="date" id="fechaDeCreacion" name="fechaDeCreacion" value="" title="Fecha" required=required></td>
</tr>

<tr>
<td><label for="fuente" >Fuente:</label></td>
<td><input type="text" id="fuente" name="fuente" value="" title="Fuente" required=required></td>
</tr>

<tr>
<td><label for="lugarFuente" >Lugar de la fuente:</label></td>
<td><input type="text" id="lugarFuente" name="lugarFuente" value="" title="Lugar de la Fuente" required=required></td>
</tr>

<tr>
<td><label for="abstract" >Abstract:</label></td>
<td><textarea id="abstract" name="abstract" value="" title="Abstract" required=required></textarea></td>
</tr>

<tr>
<td><label for="categoriaContenido" >Categoría del contenido:</label></td>
<td><input type="text" id="categoriaContenido" name="categoriaContenido" value="" title="Categoría del contenido" required=required></td>
</tr>

<tr>
<td><label for="categoriaPublicación" >Categoría de la publicación:</label></td>
<td><input type="text" id="categoriaPublicacion" name="categoriaPublicacion" value="" title="Categoría de la publicación" required=required></td>
</tr>

<tr>
<td><label for="comentarioAdm" >Comentario de administración:</label></td>
<td><input type="text" id="comentarioAdm" name="comentarioAdm" value="" title="Comentario de adminstración" required=required></td>
</tr>

<tr>
<td><input type="submit" value="submit"></input></td>
<td></td>
</tr>
</table>

</body>
</html>

