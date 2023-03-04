<!DOCTYPE html>
<!--ejer de encriptación hecho con ajax-->
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script src="../jquery.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

<style>

/*Todas las etiquetas*/
* {margin:0;padding:0; border: 0 none; }
* {box-sizing: border-box;overflow:hidden;}

/*En particular*/
html {
  background: #0D757D;
  color: #e6eff0;
  font-family: Roboto Slab;
  height:100%;
}

body {
	height:100%;
}


header {
	height:10%;
}

main {
	height:80%;
	background-color: gray;
}

footer {
	height:10%;
}


button {
	height:40px;
	width:10%;
	background-color: #555555;
	color:black;
}

button:hover {
	background-color: #999999;
	color:white;
}


div#contenedor {
	margin:auto;
	width:100%;
	height:100%;
	opacity:1;
	pointer-events: auto;
	/*background-color:yellow;*/
}


div#btCruz {
	margin:0;
	padding:1%;
	width:10%;
	height:100%;
	text-align:center;
	cursor:pointer;
	float:right;
	color:red;
	background-color:lightgray;
}


div#ventanaModal {
	margin:0;
	position:fixed;
	left:30%;
	top:20%;
	width:50%;
	height:60%;
	background-color:lightblue;
	color:black;
	padding:1%;
	border-radius:10px;
	z-index:20;
	overflow-y: auto;
	display: none;
}




div#encabezadoModal {
	margin:0;
	padding:1%;
	width:100%;
	height:10%;
	background-color:#666666;
	color:black;
	border-radius: 10px;
	z-index: 30;
	overflow-y: hidden;
}


div#contenidoModal {
	margin:0;
	padding:1%;
	width:100%;
	height:90%;
	background-color:#bbbbbb;
	color:black;
	border-radius: 10px;
	z-index: 30;
	overflow-y: hidden;
}

</style>

<script>


/*FUNCIONES*/


/*EVENTOS*/


$(document).ready(function() {
	$("#btPrendeVentana").click(function(){
		//alert("botonprende");
		$("#ventanaModal").css("display","block");
		$("#contenedor").css("opacity","0.3");
		$("#contenedor").css("pointer-events","none");
	});
});



$(document).ready(function() {
	$("#btCruz").click(function() {
		$("#ventanaModal").css("display","none");
		$("#contenedor").css("opacity","1");
		$("#contenedor").css("pointer-events","auto");
		$("#resultadoModal").empty();
	}); 
}); 


$(document).ready(function() {
	$("#btEnviar").click(function(){
		if(confirm("¿Está seguro de agregar registro ")) {
			
			$("#resultadoModal").empty();
			$("#resultadoModal").append("<h2>Esperando respuesta...</h2>");

			//var form = $("#miForm")[0]; //El objeto primer elemento del objeto miForm
			//var datosDelFormulario = new FormData(form);

			var objAjax = $.ajax({
				type: 'get',
				//enctype: 'multipart/form-data',
				url: "./respuesta.php",
				//processData: false,  
        		//contentType: false,
        		//cache: false,
				//data: datosDelFormulario,
				//data: $("#fAbm").serialize(),
				data:{
					idUsuario:$("#idUsuario").val(),
					loginDeUsuario:$("#loginDeUsuario").val(),
					apellido:$("#apellido").val(),
					nombres:$("#nombres").val(),
					fechaNac:$("#fechaNac").val()
				},
				success:function(datos) {
					$("#resultadoModal").empty();
					$("#resultadoModal").append("<h4>Resultado de la transformacion a json en el servidor: </h4>" + datos);
					//$("#miForm").css("display","none");
					//$("#pieForm").css("display","none");
				} //cierra success
			}); //cierra ajax
		} //cierra confirm
	}); //cierra enviar
}); //Cierra ready
 


</script>

</head>
<body>

	<div id="contenedor">

			<header>Header 10%
			</header>

	<main>
		<button id="btPrendeVentana">Ventana modal</button>
	</main>

	<footer>Footer 10%
	</footer>

	</div> <!--cierra contenedor -->




	<div id="ventanaModal">
		<div id="encabezadoModal">
			<div id="btCruz">X</div>
		</div>
		<div id="contenidoModal">


			<form id="miForm"> 
			<ul >
		    <li >
		        <label for="idUsuario">idUsuario</label><br />
		        <input id="idUsuario" name="idUsuario" required />
		    </li>


		    <li>
		        <label for="loginDeUsuario">Login</label><br />
		        <input type="text" id="loginDeUsuario" name="loginDeUsuario" value="" placeholder="Login" required />
		    </li>

		    <li>
		    	<label for="apellido">Apellido</label><br />
		        <input type="text" id="apellido" name="apellido"  value="" placeholder="Apellido" required />
		    </li>

		    <li>
		    	<label for="nombres">Nombres</label><br />
		    	<input type="text" id="nombres" name="nombres"  value="" placeholder="Nombres" required />
		    </li>

		    <li>
		    	<label for="fechaNac">Fecha de nacimiento</label><br />
		        <input type="date" id="fechaNac" name="fechaNac"  value="" placeholder="Fecha de nacimiento" required />
		    </li>
	 
	    	</ul>

			</form>


			<div id="pieForm">
				<button id="btEnviar">Enviar</button>
			</div>

			<div id="resultadoModal">
			</div>

		</div> <!--Cierra contenido modal-->

	</div><!--Cierra ventana modal-->

</body>

</body>