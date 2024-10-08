<?php
?>
<!--Este index es un tablero que permite generar requerimientos rest con el verbo y el recurso necesario para obtener un resultado-->
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<script src="../jquery.js">

		</script>

		<script>

			/*El metodo click() registra un event handler cuando el evento click ocurre */
			$(document).ready(function() {
				
				$("#trigger" ).click(function() {
					//alert($("#verbo").val());

					if(($("#verbo").val()=="post")||($("#verbo").val()=="put")) {
						$("#stringReq").val("http://" + $("#host").val() + $("#uriParteRecurso").val() + $("#uriParteRuta").val()) ;
						//alert("Recurso: "+$("#stringReq").val());
						//alert($("#verbo").val());
						$("#resultado").empty(); //vacia el cuadro de resultado.
						$("#resultado").addClass("estiloRecibiendo"); //le cambia provisoriamente el estilo al cuadro de resultado
						$("#resultado").html("<h2>Esperando respuesta ..</h2>");//Escribe mensaje provisorio
						$("#estado").empty();
						$("#estado").append("<h2>Esperando Respuesta .. ");
						$.ajax({
						type: $("#verbo").val(),
						url: $("#stringReq").val(),
						data: { titulo: $("#titulo").val(), estado: $("#estado").val(), contenido: $("#contenido").val(),
						fechaModi: $("#fechaModi").val(), usuario: $("#usuario").val()},
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
					}

					else { //No pasa data
						$("#stringReq").val("http://" + $("#host").val() + $("#uriParteRecurso").val() + $("#uriParteRuta").val()) ;
						alert("Recurso: "+$("#stringReq").val());
						alert("Verbo: "+$("#verbo").val());
						//alert($("#verbo").val());
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

					}

				}); //cierra click

			}); //cierra ready


			$(document).ready(function() {

				$("#uriParteRecurso").on("keyup", function(){  //cualquier pulsacion en este campo
					$("#stringReq").val("http://" + $("#host").val() + $("#uriParteRecurso").val() + $("#uriParteRuta").val()) ;
				});
				
			});


			$(document).ready(function() {

				$("#uriParteRuta").on("keyup", function(){ //cualquier pulsacion en este campo
					$("#stringReq").val("http://" + $("#host").val() + $("#uriParteRecurso").val() + $("#uriParteRuta").val()) ;
				});
				
			});



		</script>


		<style>


		* {
		margin:0;
		padding:0;
		box-sizing:border-box;

		}

		html, body {
		height:100%;
		}

		div.limpiaFloats {
		clear:both;
		}
		
		input {
			width:38%;
			height:50px;
		}

		input.armadoURL {
			font-size: 18px;
			font-weight: bold;
			width:100%;
		}

		select {
				width:33%;
				height:50px;
		}


		div#contenedor {
			display:block;
			width:100%;
			height:100%;
			background-color:lightblue;
			/*margin:auto;*/
		}


		div#contenedorSuperior {
			display:block;
			width:100%;
			height:60%;
		}

		div#contenedorInferior {
			display:block;
			width: 100%;
			height:40%;
		}

		div#contenedorParams {
			height:100%;
			width:50%;
			background-color:gray; 
			/*border: 1px solid #000;*/
			float:left;
			overflow: auto;
			padding:1%;
			box-sizing: border-box;
		}

		div#contenedorDatos {
			height:100%;
			width:50%;
			background-color:lightblue; 
			/*border: 1px solid #000;*/
			float:left;
			overflow: auto;
			padding:1%;
			box-sizing: border-box;
		}

		div.divEntrada {
			width:50%;
			float:left;
			/*display:block;*/
		}

		input.inputEntrada {
			/*float:left;*/
			width:80%;
			margin:auto;
			padding:5px;
			box-sizing:border-box;
		}

		div#trigger {
			float:left;
			font-size:14px;
			padding:10px;
			width:25%;
			height:100%;
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


		div#estado {
			float:left;
			margin:0;
			background-color:#444444;
			width:25%;
			height:100%;
			padding:1%;
			box-sizing:border-box;
		}

		div#resultado {
			float:left;
			background-color:yellow;
			width:50%;
			height:100%;
			padding:1%;
			box-sizing:border-box;
			overflow:auto;
		}




		div.estiloRecibiendo {
			background-color:red;
		}


	</style>
		
		
</head>
	
<body>	
	<div id="contenedor">
		<div id="contenedorSuperior">
			<div id="contenedorParams">
				<h2>Parametros de la consulta</h2>
				
				<div class="divEntrada">
					<h4>Ingrese el nombre de host que atiende el requerimiento:</h4>
					<input class="inputEntrada" id="host" name="host" type="text" value="localhost" />
				</div>

				<div class="divEntrada">
					<h4>Ingrese el nombre del recurso<br />(URI parte recurso):</h4>
					<input class="inputEntrada" id="uriParteRecurso" name="uriParteRecurso" type="text" value="/prof/Php/ejer50Rest/tangoTips.php" />
				</div>

				<div class="divEntrada">
					<h4>Ingrese recurso REST (URI parte Ruta):</h4>
					<input class="inputEntrada" id="uriParteRuta" name="uriParteRuta" type="text" value="/tips/" />
				</div>

				<div  class="divEntrada">
					<h4>Ingrese el verbo a aplicar en el requerimiento:</h4>
					<select id="verbo" name="verbo" type="text">
						<option value="get">GET</option>
						<option value="post">POST</option>
						<option value="delete">DELETE</option>
						<option value="put">PUT</option>
					</select>
				</div>

				<div style="clear:both;"></div>
				<br /><br/>
				<div style="display:block">
					<h4>URL - Nombre del recurso completo:</h4>
					<br /><br />
					<input class="armadoURL" id="stringReq" name="stringReq" type="text" value="inicio" disabled>
				</div>

			</div> <!--cierra contenedorParams-->



			<div id="contenedorDatos">
				<h2>Datos a enviar solo en caso de modificación o alta</h2>
			
				<!--
				<div class="divEntrada">
					<h4>Ingrese el id del tip</h4>
					<input class="inputEntrada" id="tipId" name="tipId" type="text">
				</div>
				-->

				<div class="divEntrada">
					<h4>Ingrese el titulo del tip</h4>
					<input class="inputEntrada" id="titulo" name="titulo" type="text">
				</div>

				<div class="divEntrada">
				<h4>Ingrese el estado del tip</h4>
				<input class="inputEntrada" id="estado" name="estado" type="text" maxlength="10">
				</div>


				<div class="divEntrada">
					<h4>Ingrese contenido</h4>
					<input class="inputEntrada" id="contenido" name="contenido" type="text">
				</div>

					<div class="divEntrada">
						<h4>Ingrese fecha de creación o modificación</h4>
					<input class="inputEntrada" id="fechaModi" name="fechaModi" type="date">
				</div>
				<div class="divEntrada">
					<h4>Usuario/Autor</h4>
					<input class="inputEntrada" id="usuario" name="usuario" type="text" maxlength="10">
				</div>



			</div>	<!--cierra contenedorDatos-->



		</div> <!--cierra contenedor superior-->

		<div id="contenedorInferior">
			<div id="trigger">
				<h1>Ejecutar</h1>
			</div>

			
			<div id="estado">
				Estado del requerimiento:
			</div>


			<div id="resultado">
				Resultado:
			</div>
			<div class="limpiaFloats"></div>
			
		</div> <!-- cierra contenedor inferior -->

	</div> <!-- cierra contenedor  -->		
</body>

</html>
