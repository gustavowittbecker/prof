<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html" />
	<meta charset="utf-8" /> 

<script src="../jquery.js"></script>	

<style>

/*Todas las etiquetas*/
* {margin:0;padding:0; border: 0 none; }
* {box-sizing: border-box;overflow:hidden;}

/*En particular*/
html {
  background: #0D757D;
  /*font-size: 1em;*/
  color: #e6eff0;
  font-family: Roboto Slab;
  height:100%;
}

body {
	height:100%;
}


div#contenedor {
	margin:auto;
	width:100%;
	height:100%;
	/*background-color:yellow;*/
}



header {
	width:100%;
	height:10%;
	overflow:hidden;
	clear:both;
}

footer {
	height:10%;
}

#controles {
	height:10%;
	clear:both;
	background: #0D758D;
}


.parte {
	width:10%;
	height:100%;
	float:left;
}

img {
    max-width: 100%;
    height: auto;
}


h1 {
  font-weight: normal;
  /*font-variant: small-caps;*/
  text-align: left;
}

button {
	width:80%;
	height:80%;
}


button:hover {
	background-color: #AAAAAA;
	cursor:pointer;
}


h1#tituloPrincipal {
width:50%;
float:left;
/*background-color: yellow;*/
}

button#botonSalida {
margin:0;width:10%;height:90%;float:right;
}


button.interiorCelda {
	width:90%;
	height:100%;
}

input#orden {
	height: 50%;
	/*background-color:yellow;*/
}

.inputFiltro {
	margin:0;
	height:70%;
	max-width:90%;
	width: 100%;
	size:40;
	display:block;
}

#f_area {
	margin:0;
	height:70%;
	max-width:90%;
	width: 100%;
	size:40;
	display:block;	
}

table {
  height: 75%;
  background-color: #15BFCC;
  width: 100%; 
  border-collapse: collapse;
  border: 1px solid rgba(0,0,0,1);
}

thead {
	display:block;
	width:100%;
	height: 15%;
 	background-color: #FF7361;
 	text-align: center;
 	z-index: 2;
 	overflow-y: hidden;
}

thead tr#nombresDeAtributos {
	display:block;
	width:100%;
	height:30%;
 	padding: .1%;
 	z-index: 2;
 	overflow-y: hidden;
}


thead tr#filtros {
	display:block;
	width:100%;
	height:70%;
 	padding: .1%;
 	z-index: 2;
 	overflow-y: hidden;
}


/*Todos los inputs que estan dentro de un div de clase parte: */
div.parte input {
	height:50%;
}

input {
	height:50%;
}

tbody {
	width:100%;
 	display: block;
 	background-color: lightblue;
	height: 85%;
	overflow-Y: scroll;
	color: #000; 
}



th {
  border-right: 1px solid rgba(0,0,0,.2);
  /*padding: .4em ;*/
  /*font-size: .5em;
  font-weight: normal;
  font-variant: small-caps;*/
  cursor:pointer;
  color: white;
  z-index: 2;
}


@media (min-width:1200px){
body {
  padding: .5em ;
  font-size: 1em;
  font-weight: normal;
  cursor:pointer;
  z-index: 2;
}
}

@media (max-width:1200px){
body {
  padding: .25em ;
  font-size: .5em;
  font-weight: normal;
  cursor:pointer;
  z-index: 2;
}
}


tbody tr {
	height:10%;
	display: block;
	overflow: hidden;
}


tbody tr:nth-child(odd) {
  background: rgba(0,0,0,.2);
}
th, td {
  height:100%;
  float:left;
}
td {
  padding: .5em ;
}


[data-campo='idUsuario'] { /**/
 width: 10%;
 max-width:10%;
}

[data-campo='loginDeUsuario'] { /**/
  width: 10%;
  max-width:10%;
}
[data-campo='apellido'] { /**/
  width: 15%;
  max-width:15%;
}

[data-campo='nombres'] {  /**/
  width: 15%;
  max-width:15%;
}

[data-campo='area'] { /**/
  width: 10%;
}

[data-campo='clave'] {	/**/
  width: 10%;
  max-width:10%;
}
[data-campo='fechaNac'] { /**/
  width: 6%;
    max-width:6%;
}

[data-campo='curriculum'] { /**/
 width: 4%;
 max-width:4%;
}

[data-campo='botonModi'] { /**/
  width: 5%;
  max-width:5%;
  cursor:pointer;
}


[data-campo='botonBaja'] {	/**/
  width: 5%;
  max-width:5%;
  cursor:pointer;
}


/*Modal para fichas y presentaciones de datos*/



div.contenedorActivo {
opacity:1;
/*permite activar todos los elementos sensibles a eventos:*/
pointer-events: auto;
}

div.contenedorPasivo {
opacity:0.3;
/*permite desactivar todos los elementos sensibles a eventos:*/
pointer-events: none;
}


div#ventanaModal {
margin:0;
position:fixed;
left:13%;
top:10%;
width:80%;
height:80%;
background-color:gray;
color:black;
padding:1%;
border-radius:10px;
z-index:30;
overflow-y: auto;
/*visibility: visible;*/
}



div.ventanaModalApagado {
visibility:hidden;
}

div.ventanaModalPrendido {
visibility:visible;
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
background-color:lightblue;
color:black;
border-radius: 10px;
z-index: 30;
overflow-y: hidden;
}

div#pieForm {
margin:0;
padding:1%;
width:100%;
/*height:10%;*/
background-color:#666666;
color:black;
border-radius:10px;
z-index: 30;
overflow-y: hidden;
}


div#resultadoModal {
margin:0;
padding:1%;
width:100%;
height:40%;
background-color:lightblue;
color:black;
border-radius: 10px;
z-index: 30;
overflow-y: hidden;
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

div#btCruz:hover {
	background-color:gray;
}


div#tituloFormulario {
	float:left;
}

button#btAltaFicha {
	width:10%;
	height:50PX;
	display:none;
}

button#btModiFicha{
	width:10%;
	height:50PX;
display:none;
}




/*Estilos para formulario de abm*/
form#fAbm {
	/*display:none;*/
	margin:0;
	background-color:aquamarine;
	width:100%;
}


form#fAbm ul { /*todos los ul incluidos en el formulario de clase abm*/
    list-style-type:none;
    clear:both; /*Produce que en cada linea se haga una limpieza de floats*/
}


@media(min-width: 800px) {
form#fAbm li {
	width:20%;
	float:left;
}
}

@media(max-width: 800px) {
form#fAbm li {
	width:50%;
	float:left;
}
}


form#fAbm label { 
    color: #555555; 
    /*font-size: 1em;*/
    font-weight: bold;
    padding: 5px;
    width: 90%;
   /*Al darle un ancho al label y hecerlo flotar a la izquierda hace que el input que esta al lado 
   quede perfectamente alineado.*/
}
	
	
form#fAbm input {
	float:left;	
	/*width:90%;*/
	padding:5px;
	box-sizing:border-box;
}

form#fAbm select {
	float:left;	
	/*width:90%;*/
	padding:5px;
	box-sizing:border-box;
}


form#fAbm textarea {
	float:left;
	/*border-style:solid;*/
	/*background-color:yellow;*/
	padding:5px;
	height:500px;
	width:220px;
	box-sizing:border-box;
}


input.casillaVerificacion {
	width:20px;
	height:20px;
}
</style>


<script>

	//Inicializacion de Variables globales java script



/*Funciones generales*/


function pueblaTabla() {
	$("#resultadoModal").empty();
	$("#tbDatos").empty(); //vacia el cuadro de resultado.
	$("#tbDatos").append("Esperando respuesta ..");//Escribe mensaje provisorio

	var objAjax = $.ajax({
			type:"get", 
			url:"./salidaJsonUsuarios.php",
			data: { fapellido: $("#f_apellido").val(), fnombres:$("#f_nombres").val(), farea: $("#f_area").val(), orden: $("#orden").val() },
			success: function(respuestaDelServer,estado) {  //La funcion de callback que se ejecutara cuando el req. sea completado.
						//$("div#resultado").attr("class","estiloResultadoRecibido");
						$("#tbDatos").empty();

						/*alert(respuestaDelServer);*/
						listaDeObjetos = JSON.parse(respuestaDelServer);
						
						listaDeObjetos.usuarios.forEach(function(argValor,argIndice) {  //creacion filas
							var objTr= document.createElement("tr"); //esto es java script (no jquery)

							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","idUsuario");
							objTd.innerHTML=argValor.idUsuario;
							objTr.appendChild(objTd);

							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","loginDeUsuario");
							objTd.innerHTML=argValor.loginDeUsuario;
							objTr.appendChild(objTd);

							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","apellido");
							objTd.innerHTML=argValor.apellido;
							objTr.appendChild(objTd);

							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","nombres");
							objTd.innerHTML=argValor.nombres;
							objTr.appendChild(objTd);

							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","area");
							objTd.innerHTML=argValor.area;
							objTr.appendChild(objTd);

							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","clave");
							objTd.innerHTML=argValor.clave;
							objTr.appendChild(objTd);

							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","fechaNac");
							objTd.innerHTML=argValor.fechaNac;
							objTr.appendChild(objTd);

							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","curriculum");
							objTd.innerHTML="<button class='interiorCelda'>D1</button>";
							objTd.onclick=function() {
								traeDoc1(argValor.idUsuario);
							}
							objTr.appendChild(objTd);
							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","botonModi");
							objTd.innerHTML="<button class='interiorCelda'>Modi</button>";
							objTd.onclick=function() {
								$("#contenedor").attr("class","contenedorPasivo");
								$("#ventanaModal").attr("class","ventanaModalPrendido");
								$("#fAbm").css("display","block");
								$("#curriculum").attr("disabled",true);
								$("#clave").attr("disabled",true);	
								$("#pieForm").css("display","block");
								$("#resultadoModal").css("display","none");
								$("#resultadoModal").empty();
								CompletaFichaUsuario(argValor.idUsuario);
								$("#btModiFicha").attr("disabled",true);
								$("#btModiFicha").css("display","block");
							}
							objTr.appendChild(objTd);
							var objTd=document.createElement("td");
							objTd.setAttribute("data-campo","botonBaja");
							objTd.innerHTML="<button class='interiorCelda'>Baja</button>";
							objTd.onclick=function() {
								//alert(argValor.idUsuario);
								baja(argValor.idUsuario);
							}
							
							objTr.appendChild(objTd);

							$("#tbDatos").append(objTr);
						});//cierra foreach
						$("#nroRegistros").val(listaDeObjetos.cuenta);

			} //cierra el success
	}); //cierro ajax
} //cierra funcion creaTabla













function llenaAreasFiltro() {
			//alert(idSelect);
			var objAjax = $.ajax({
			type:"get", 
			url: "./salidaJsonAreas.php",
			
			success: function(respuestaDelServer,estado) {  //La funcion de callback que se ejecutara cuando el req. sea completado.
						listaDeObjetos = JSON.parse(respuestaDelServer);
						listaDeObjetos.areas.forEach(function(argValor,argIndice) { 
							var objOption= document.createElement("option");
							objOption.setAttribute("value", argValor.idArea); //java script (no jquery)
							objOption.innerHTML=argValor.idArea + argValor.descripcion;
							//objSelect.appendChild(objOption);
							$("#f_area").append(objOption);
							
						});//cierra foreach
						return true;
			} //cierra el success
	}); //cierro ajax
}



function llenaAreasFichaAlta() {
			var objAjax = $.ajax({
			type:"get", 
			url: "./salidaJsonAreas.php",
			
			success: function(respuestaDelServer,estado) {  //La funcion de callback que se ejecutara cuando el req. sea completado.
						listaDeObjetos = JSON.parse(respuestaDelServer);
						//alert(respuestaDelServer);
						listaDeObjetos.areas.forEach(function(argValor,argIndice) { 
							var objOption= document.createElement("option");
							objOption.setAttribute("value", argValor.idArea);
							objOption.innerHTML=argValor.idArea + argValor.descripcion;
							//objSelect.appendChild(objOption);
							$("#area").append(objOption);
							
						});//cierra foreach
															
			} //cierra el success
	}); //cierro ajax
}



function CompletaFichaUsuario(argUsuario) {	
			$("#idUsuario").val(argUsuario);
			var objAjax = $.ajax({
			type:"get", 
			url: "./salidaJsonAreas.php",
			
			success: function(respuestaDelServer,estado) {  //La funcion de callback que se ejecutara cuando el req. sea completado.
						listaDeObjetos = JSON.parse(respuestaDelServer);
						//alert(respuestaDelServer);
						listaDeObjetos.areas.forEach(function(argValor,argIndice) { 
							var objOption= document.createElement("option");
							objOption.setAttribute("value", argValor.idArea);
							objOption.innerHTML=argValor.idArea + argValor.descripcion;
							$("#area").append(objOption);
							
						});//cierra foreach
						
			} //cierra el success
	}); //cierro ajax

traeUsuario(argUsuario);
}

function limpiarFiltros() {
	$("#f_apellido").val("");
	$("#f_nombres").val("");
	$("#f_F_area").val("");
}


/*Funciones para fichas*/

function traeUsuario(argUsuario) {

					
							var objAjax = $.ajax({
								type:"get", 
								url: "./salidaJsonUsuario.php",
								/*data: { idUsuario : $("#idUsuario").val() },*/
								data: { idUsuario : argUsuario },
								success: function(respuestaDelServer,estado) {  //La funcion de callback que se ejecutara cuando el req. sea completado.
									
									objetoDato = JSON.parse(respuestaDelServer);

									$("#idUsuario").val(objetoDato.idUsuario);
									$("#loginDeUsuario").val(objetoDato.loginDeUsuario);
									$("#apellido").val(objetoDato.apellido);
									$("#nombres").val(objetoDato.nombres);						
									$("#fechaNac").val(objetoDato.fechaNac);
									$("#area").val(objetoDato.area);
									
								} //cierra el success
							}); //cierro ajax
}



function traeDoc1(argUsuario) {

							var objAjax = $.ajax({
								type:"get", 
								url: "./salidaJsonUsuario.php",
								data: { idUsuario : argUsuario },
								success: function(respuestaDelServer,estado) {  //La funcion de callback que se ejecutara cuando el req. sea completado.

									objetoDato = JSON.parse(respuestaDelServer);

									$("#contenedor").attr("class","contenedorPasivo");
									$("#ventanaModal").attr("class","ventanaModalPrendido");
									$("#resultadoModal").css("display","none");
									$("#encabezadoModal").css("display","block");
									$("#pieForm").css("display","none");
									$("#fAbm").css("display","none");
									//$("#resultadoModal").css("display","none");

									
									$("#imagenDocumento").css("display","block");
									$("#imagenDocumento").html("<iframe width='100%' height='600px' src='data:application/pdf;base64,"+objetoDato.documentoPdf+"'></iframe>");
									
								} //cierra el success

							}); //cierro ajax

} //cierro traeDoc1()


function alta() {
if(confirm("¿Está seguro de agregar registro ")) {
	//Jamas vaciar la ventana porque se perdería el formulario
	//alert ($("#fAbm").attr("method"));
	$("#resultadoModal").css("display","block");
	$("#resultadoModal").empty();
	$("#resultadoModal").append("<h2>Esperando respuesta...</h2>");

	var form = $('#fAbm')[0];
	var data = new FormData(form);

	var objAjax = $.ajax({
		type: 'post',
		enctype: 'multipart/form-data',
		url: "./alta.php",
		processData: false,  // Important!
        contentType: false,
        cache: false,
		data: data,
		success:function(datos) {
			$("#resultadoModal").empty();
			$("#resultadoModal").append("<h1>"+datos+"</h1>");
			$("#fAbm").css("display","none");
			$("#pieForm").css("display","none");
		} //cierra success
	}); //cierra ajax
} //cierra confirm
} //cierra alta()







function modi() {
if(confirm("¿Está seguro de modificar registro? " + $("#idUsuario").val())) {
	$("#contenidoModal").css("display","block");
	$("#resultadoModal").css("display","block");
	$("#resultadoModal").empty();
	$("#resultadoModal").append("<h2>Esperando respuesta</h2>");
	$("#idUsuario").attr('disabled',false);//Importantisimo!!! El campo idUsuario debe habilitarse para el envío cuando se trata de una modi.
	var form = $('#fAbm')[0];
	var data = new FormData(form);
	var objAjax = $.ajax({
		type: 'post',
		enctype: 'multipart/form-data',
		url: "./modi.php",
		processData: false,  // Importante!
        contentType: false,
        cache: false,
		data: data,
		success:function(datos) { //datos es lo que catura ajax
			$("#resultadoModal").empty();
			$("#resultadoModal").append("<h1>"+datos+"</h1>");
			$("#btModiFicha").attr("disabled",true);
			$("#fAbm").css("display","none");
			$("#pieForm").css("display","none");

		} //cierra success
	}); //cierra ajax
} //cierra confirm
} //cierra modi()




function baja(arg) {
if(confirm("¿Está seguro de eliminar este registro? ")) {
	//alert(arg);
	$("#contenedor").attr("class","contenedorPasivo");
	$("#ventanaModal").attr("class","ventanaModalPrendido");
	$("pieForm").css("display","none");
	//$("#contenidoModal").css("display","none");
	$("#resultadoModal").css("display","block");
	$("#resultadoModal").empty();
	$("#resultadoModal").append("<h2>Esperando respuesta</h2>");
	var objAjax = $.ajax({
		type: "get",
		url: "./baja.php?idUsuario="+arg,
		success:function(datos) {
			$("#resultadoModal").empty();
			$("#resultadoModal").append("<h1>"+datos+"</h1>");
			$("#fAbm").css("display","none");
			$("#pieForm").css("display","none");

		} //cierra success
	}); //cierra ajax
} //cierra confirm
} //cierra baja()


function todoListo() { //Esta función habilita boton de alta si todos los campos están completados

//	if((document.getElementById("apellido").checkValidity())&&(document.getElementById("nombres").checkValidity())&&(document.getElementById("loginDeUsuario").checkValidity())){

//	if($("#apellido").validate()&&$("#nombres").validate()&&$("#loginDeUsuario").validate()){
	if ($("#fAbm")[0].checkValidity()) {
		//Siempre que hago referencia al objeto form debo apuntar al primer elemento del array


		$("#btAltaFicha").attr("disabled",false);
		$("#btModiFicha").attr("disabled",false);
	}
	else {
		$("#btAltaFicha").attr("disabled",true);
		$("#btModiFicha").attr("disabled",true);
	}
}



/*EVENTOS*/

//En la carga de la applicacion

$(document).ready(function() {
		$("#ventanaModal").attr("class","ventanaModalApagado");
		$("#orden").val("idUsuario"); //Asigna valor inicial para el indice
		llenaAreasFiltro();
		//pueblaTabla();
});



$(document).ready(function() {
	$("#botonSalida").click(function() {
		if(confirm("Esta seguro de cerrar sesión?")) {
				location.href="../destruirsesion.php";	
			}
	});	//cierro click
}); //cierro ready






$(document).ready(function() {
	$("#botonPuebla" ).click(function() {
	$("#orden").val("idUsuario");
		//alert();
		pueblaTabla();
	});	//cierro click
}); //cierro ready






//Ordenamiento

$(document).ready(function() {
	$("#thId" ).click(function() {
		$("#orden").val("idUsuario"); //solo cargo esta variable orden
		pueblaTabla();
	});	//cierro click
}); //cierro ready


$(document).ready(function() {
	$("#thLoginDeUsuario" ).click(function() {
		$("#orden").val("loginDeUsuario"); //solo cargo esta variable orden
		pueblaTabla();
	});	//cierro click
}); //cierro ready


$(document).ready(function() {
	$("#thApellido" ).click(function() {
		$("#orden").val("apellido"); //solo cargo esta variable orden
		pueblaTabla();
	});	//cierro click
}); //cierro ready



$(document).ready(function() {
	$("#thNombres" ).click(function() {
		$("#orden").val("nombres");
		pueblaTabla();
	});	//cierro click
}); //cierro ready



$(document).ready(function() {
	$("#thArea" ).click(function() {
		$("#orden").val("area");
		pueblaTabla();
	});	//cierro click
}); //cierro ready


//Filtrar
$(document).ready(function() {
	$( "button#cmdFiltrar" ).click(function() {
		pueblaTabla();
	});	//cierro click
}); //cierro ready




$(document).ready(function() {
	$("#cmdLimpiaFiltros").click(function() {
		limpiarFiltros();	
		pueblaTabla();
	});
}); 


$(document).ready(function() {
	$("#btAltaGlobal").click(function() {
		$("#contenedor").attr("class","contenedorPasivo");
		$("#ventanaModal").attr("class","ventanaModalPrendido");
		$("#resultadoModal").css("display","none");
		$("#resultadoModal").empty();
		$("#idUsuario").attr('disabled',true);//ojo que en el handler de modi hay que habilitarlo.
		$("#curriculum").attr('disabled',true);
		$("#clave").attr('disabled',true);
		$("#btAltaFicha").attr("disabled",true);
		$("#btAltaFicha").css("display","block");
		$("#fAbm").css("display","block");
		$("#pieForm").css("display","block");
		llenaAreasFichaAlta();
	}); //cierra click()
}); //cierra ready()


/*Actividad Modal*/


$(document).ready(function() {
	$("#btCruz").click(function() {
	//	alert("vaciar");
		$("#contenedor").attr("class","contenedorActivo");
		$("#ventanaModal").attr("class","ventanaModalApagado");
		$("#imagenDocumento").empty();
		$("#imagenDocumento").css("display","none");
		$("#fAbm")[0].reset();
		$("#area").empty(); //vacia opciones del select
		$("#resultadoModal").empty();
		$("#btAltaFicha").css("display","none");
		$("#btModiFicha").css("display","none");
		pueblaTabla();
	});
}); 


$(document).ready(function() {
	$("#loginDeUsuario").keyup(function() {
		//alert("a2");
		todoListo();
	});
});


$(document).ready(function() {
	$("#apellido").keyup(function() {
		todoListo();
	});
});



$(document).ready(function() {
	$("#nombres").keyup(function() {
		todoListo();
	});
});



$(document).ready(function() {
	$("#area").change(function() {
		todoListo();
	});
});


$(document).ready(function() {
	$("#clave").keyup(function() {
		todoListo();
	});
});


$(document).ready(function() {
	$("#btAltaFicha").click(function() {
	alta();
	});
});


$(document).ready(function() {
	$("#btModiFicha").click(function() {
	modi();
	});
});



$(document).ready(function() {
$('#traeClave').click(function(){
            if($(this).is(":checked")){
                $('#clave').attr('disabled',false)
                $("#btModiFicha").attr("disabled",false);
            }
            else if($(this).is(":not(:checked)")){
                $('#clave').attr('disabled',true);
                $('#clave').val('');
                $("#btModiFicha").attr("disabled",true);

                //alert("Checkbox is unchecked.");
            }
	});
});

$(document).ready(function() {
$('#traeCurriculum').click(function(){
            if($(this).is(":checked")){
                $('#curriculum').attr('disabled',false);
                $("#btModiFicha").attr("disabled",false);
            }
            else if($(this).is(":not(:checked)")){
                $('#curriculum').attr('disabled',true);
                $('#curriculum').val('');
                $("#btModiFicha").attr("disabled",true);

                //alert("Checkbox is unchecked.");
            }
	});
});

</script>

</head>



<body>

<div id="contenedor">

<header >
<h1 id="tituloPrincipal">10% Header - ABM Con ordenamiento y filtro</h1>
<button  id="botonSalida">Salida</button>
</header>

<div id="controles">

<div class="parte">
Orden: <input type="text" name="orden" id="orden" readonly value="" >
</div>
<div class="parte">
Nro de Registros: <input type="text" name="nroRegistro" id="nroRegistros" readonly value="">
</div>
<div class="parte">
<button id="botonPuebla">Poblar</button>
</div> 
<div class="parte">
<button id="cmdLimpiaFiltros">Limpiar filtros</button>
</div>
<div class="parte">
<button id="btAltaGlobal">Alta</button>
</div>
</div> <!--cierra controles-->


<table >
<thead >
<tr id="nombresDeAtributos" >
<th id="thId" data-campo="idUsuario" >id Usuario</th>
<th id="thLoginDeUsuario" data-campo="loginDeUsuario">login De Usuario</th>
<th id="thApellido" data-campo="apellido">apellido</th>
<th id="thNombres" data-campo="nombres">nombres</th>
<th id="thArea" data-campo="area">area</th>
<th id="thClave" data-campo="clave">clave</th>
<th id="thFechaNac" data-campo="fechaNac">fecha Nac</th>
<th id="thCurriculum" data-campo="curriculum" title="Curriculum">D1</th>
<th id="thEdicion" data-campo="botonModi">Modis</th>
<th id="thBajas" data-campo="botonBaja">Bajas</th>
</tr>
<tr id="filtros">
<td data-campo="idUsuario"></td>
<td data-campo="loginDeUsuario"></td>
<td data-campo="apellido"><input  type="text" id="f_apellido" name="f_apellido" class="inputFiltro" ></input></td>
<td data-campo="nombres"><input type="text"  id="f_nombres" name="f_nombres" class="inputFiltro" ></input></td>
<td data-campo="area"><select data-campo="area" id="f_area"  name="f_area" class="inputFiltro"  ><option></option></select></td>
<td data-campo="clave"></td>
<td data-campo="fechaNac">
<td data-campo="curriculum"></td>
<td data-campo="botonModi"></td>
<td data-campo="botonBaja"></td>
</tr>

</thead>
<tbody id="tbDatos">
  	
</tbody>

</table>

<footer>
<h1>Footer 10%</h1>
</footer>

</div> <!--Cierra contenedor -->


<!-- VENTANA MODAL PARA FICHAS y Vistas -->

<div id="ventanaModal">

 <div  id="encabezadoModal" ><!--contiene botones de control de ventana-->
  <div id="btCruz">X</div>
  <!--
  <div  id="btImpresion">Imprimir</div>
  -->
  <div class="limpia"></div>
 </div> <!--Cierra encabezado modal-->

<div id="contenidoModal" > <!--contiene formularios de abm o resultados -->

 <form id="fAbm" action="" enctype="multipart/form-data" method="post" > 
  <ul >
    <li >
        <label for="idUsuario">idUsuario</label><br />
        <input id="idUsuario" name="idUsuario" readonly="readonly" />
    </li>


    <li>
        <label for="loginDeUsuario">Login</label><br />
        <input type="text" id="loginDeUsuario" name="loginDeUsuario" value="" placeholder="" required />
    </li>

    <li>
    	<label for="apellido">Apellido</label><br />
        <input type="text" id="apellido" name="apellido"  value="" placeholder="" required />
    </li>

    <li>
    	<label for="nombres">Nombres</label><br />
    	<input type="text" id="nombres" name="nombres"  value="" placeholder="" required />
    </li>

    <li>
    	<label for="fechaNac">Fecha de nacimiento</label><br />
        <input type="date" id="fechaNac" name="fechaNac"  value="" placeholder=""  />
    </li>
 
    <li>
	    <label for="area">Area</label><br />
        <select  id="area" name="area"></select>
    </li>

    <li >
    	<input type="checkbox" name="traeClave" id="traeClave" value="trae" class="casillaVerificacion"  />Introducir clave nueva
    </li>

    <li>
    	<label for="clave">Clave</label><br />
        <input type="password" id="clave" name="clave" value="" placeholder="" disabled="disabled"  />
    </li>

    <li>
    	<input type="checkbox" name="traeCurriculum" id="traeCurriculum" value="trae" class="casillaVerificacion"/>Subir curriculum
    </li>

    <li>
    <label for="curriculum">Curriculum</label><br />
        <input type="file" id="curriculum"  name="curriculum" disabled />
	</li>

    </ul>

</form>


<div id="pieForm">
<button id="btModiFicha">Modi</button>
<button id="btAltaFicha">Alta</button>
</div>


<div id="imagenDocumento">
</div>


<div id="resultadoModal">
</div>


</div>	<!--cierra contenido modal -->



</div> <!--Cierra ventana modal-->

</body>

</html>