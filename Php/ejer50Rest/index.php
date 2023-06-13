<?php
?>

<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script src="../jquery.js"></script>


<script>

	/*El metodo click() registra un event handler cuando el evento click ocurre */
	$(document).ready(function() {
		
		$("#trigger" ).click(function() {
			$("#stringReq").val("http://" + $("#host").val() + $("#uriParte1").val() + $("#uriParte2").val()) ;
			alert("Recurso: "+$("#stringReq").val());
			alert($("#verbo").val());
			$("#resultado").empty(); //vacia el cuadro de resultado.
			$("#resultado").addClass("estiloRecibiendo"); //le cambia provisoriamente el estilo al cuadro de resultado
			$("#resultado").html("<h2>Esperando respuesta ..</h2>");//Escribe mensaje provisorio
			$("#estado").empty();
			$("#estado").append("<h2>Esperando Respuesta .. ");
			$.ajax({
			type: $("#verbo").val(),
			url: $("#stringReq").val(),
			success: function(respuestaDelServer,estado) {
				//la funcion de callback lleva 3 argumentos opcionales en ese orden
				//En el evento success se aplica una funci�n
				//de call back que ser� ejecutada cuando el requerimiento ajax se halla completado.
				$("#resultado").removeClass("estiloRecibiendo");
				$("#resultado").html("<h1>Resultado: </h1><h4>"+respuestaDelServer+"</h4>"); //adiciona data al contenido del div
				$("#estado").empty();
				$("#estado").append("<h4>Estado del requerimiento: "+estado+"</h4>");
			
				} //cierra funcion asociada al success
	
			}); //cierra ajax

		}); //cierra click

	}); //cierra ready


	$(document).ready(function() {


	});



	
</script>


<style>


* {
	margin:0;
	padding:0;
	box-sizing:border-box;

}


div#contenedor {
	width:100%;
	height:600px;
	background-color:lightblue;
	margin:auto;
}


div.divEntrada {
	margin:15px;
}

div#entrada {
	float:left;
	margin:auto;
	width:30%;
	height:400px;
	background-color:#999999;
	padding:5px;
	box-sizing:border-box;
}

div#trigger {
	float:left;
	font-size:14px;
	padding:10px;
	width:30%;
	height:300px;
	background-color:blue;
	color:#FFFFFF;
	cursor:pointer;
	box-sizing:border-box;
}

div#trigger:hover {
	background-image:url(./flecha.png);
	background-repeat:no-repeat;
	background-position:center center;
}

div#resultado {
	float:left;
	background-color:yellow;
	width:40%;
	height:300px;
	padding:1%;
	box-sizing:border-box;
}


div#estado {
	margin:0;
	background-color:#444444;
	width:30%;
	height:300px;
	padding:1%;
	box-sizing:border-box;
}


div.estiloRecibiendo {
	background-color:red;
}

div.limpiaFloats {
	clear:both;
}
	
input {
	width:300px;
}

select {
		width:300px;
}
</style>
	
	
</head>
	
<body>
	<div id="contenedor">
	
		<div class="divEntrada" id="entradaHost">
			<h4>Ingrese el nombre de host que atiende el requerimiento:</h4>
			<input class="entrada" id="host" name="host" type="text">
		</div>

		<div class="divEntrada" id="entradaUriParte1">
			<h4>Ingrese el nombre del recurso (URI parte 1):</h4>
			<input class="entrada" id="uriParte1" name="uriParte1" type="text" value="/prof/Php/ejer50Rest/post.php">
		</div>


		<div class="divEntrada" id="entradaUriParte2">
			<h4>Ingrese recurso REST (URI parte2):</h4>
			<input class="entrada" id="uriParte2" name="uriParte2" type="text" value="?posts/post">
		</div>


		<div  class="divEntrada"id="entradaVerbo">
			<h4>Ingrese el verbo a aplicar en el requerimiento:</h4>
			<select id="verbo" name="verbo" type="text">
				<option value="get">GET</option>
				<option value="post">POST</option>
				<option value="delete">DELETE</option>
				<option value="put">PUT</option>
			</select>
		</div>


		<div class="divEntrada"><h4>Nombre de recurso completo:</h4>
			<input id="stringReq" name="stringReq" type="text" value="inicio" disabled>
		</div>



		</div>

		<div id="trigger">
			<h1>Ejecutar</h1>
		</div>
		<div id="resultado">
			<h1>Resultado:</h1>
		</div>
	
	
		<div class="limpiaFloats"></div>
	
	
		<div id="estado">
			<h2>Estado del requerimiento:</h2>
		</div>
	
		<div class="limpiaFloats"></div>
	
	</div>
		
	</body>

</html>
