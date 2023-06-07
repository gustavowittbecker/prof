<?php
?>

<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script src="../jquery.js"></script>


<script>

	/*El metodo click() registra un event handler cuando el evento click ocurre */
	$(document).ready(function() {
		$("#stringReq").val("prueba");
		$("#trigger" ).click(function() {
			$("#stringReq").val("http://" + $("#host").val() + $("#uri").val());
			alert("Recurso: "+$("#stringReq").val());
			alert($("#verbo").val());
			$("#resultado").empty(); //vacia el cuadro de resultado.
			$("#resultado").addClass("estiloRecibiendo"); //le cambia provisoriamente el estilo al cuadro de resultado
			$("#resultado").html("<h2>Esperando respuesta ..</h2>");//Escribe mensaje provisorio
			$("#estado").empty();
			$("#estado").append("<h2>Esperando Respuesta .. ");
			$.ajax({
			type: $("#verbo").val(),
			url: "http://" + $("#host").val() + $("#uri").val(),
			data: {uri: $("#uri").val()},
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

	
</script>


<style>


div#contenedor {
	width:90%;
	height:600px;
	background-color:lightblue;
	margin:auto;
}


div#entrada {
	float:left;
	margin:auto;
	width:30%;
	height:300px;
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
	width:200px;
}

select {
		width:200px;
}
</style>
	
	
</head>
	
<body>
	<div id="contenedor">
	
		<div id="entradaHost">
			<p>Ingrese el nombre de host que atiende el requerimiento:</p>
			<input class="entrada" id="host" name="host" type="text">
		</div>

		<div id="entradaUri">
			<p>Ingrese el nombre del recurso (URI):</p>
			<input id="uri" name="uri" type="text">
		</div>

		<div id="entradaVerbo">
			<h1>Ingrese el verbo a aplicar en el requerimiento:</h1>
			<select id="verbo" name="verbo" type="text">
				<option value="get">GET</option>
				<option value="post">POST</option>
				<option value="delete">DELETE</option>
				<option value="put">PUT</option>
			</select>


		<div id="stringReq"><h1>Nombre de recurso:</h1>
			<input id="stringReq" name="stringReq" type="text" value="inicio"> </input>
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
