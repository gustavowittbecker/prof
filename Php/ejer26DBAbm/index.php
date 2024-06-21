<!DOCTYPE html>

<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />


<!-- RESUMEN de estructura del documento, de estilos de los contenedores y controles involucrados.
	HTML: Contenedor tabla y controles ,contenedor formulario de alta, contenedor formulario
		de modi, contenedor de respuestas del servidor.
	CSS: Definir estilos para los formularios y los contenedores de respuesta y las 
		ventanas modales correpondientes.
		Definir estilos para las nuevas columnas de botones modi y botones baja.
	JS: Definir objetos para los nuevos elementos del DOM que intervengan en procedimientos de java script
		Definir funciones para los nuevos eventos: Boton de alta, botones de modi y baja creados dinamicamente
		en cada ciclo de lectura de los registros JSON, 
		Definir funciones de evento para los botones de envío de los formularios de alta y de modi.
		Definir procedimientos de evento para los eventos keyUp y change de las entradas de los formularios.

-->

<style id="estiloGlobal">

/*Estilo global*/
* {
	margin:0;
	box-sizing: border-box;
	padding:0;
	font-size:14px;
}
html {
	height:100%;
	width:100%;
}

body {
	height:100%;
	width:100%;
}

h1 {
	font-size:2em;
}


h2 {
	font-size:1.5em;
}

h3 {
	font-size:1.2em;
}

h4 {
	font-size:1.1em;
}

p {
	font-size:1em;
}



/*Estilos para presentacion de tabla*/



div.contenedorTabla {
	width:100%;
	height:100%;
	background-color: gray;
	/*overflow: auto;*/
}


div.contenedorTabla header {
	width:100%;
	height:10%;
	background-color: beige;
	overflow:hidden;
	display: flex; 
	justify-content:left;
	align-items: center;
}


div.contenedorTabla header label { /*Para el input del orden*/
	width:9%;
	height:80%;
	margin:1%;
	padding:1%;
	font-weight:bold;
	font-size: 1.1em;
}




div.contenedorTabla header input { /*Para el input del orden*/
	width:12%;
	height:80%;
	margin:1%;
	padding:1%;
}


div.contenedorTabla header button { /*botones de control del tablero (altas o cargar tabla por ejemplo*/
	height:80%;
	width:10%;
	cursor:pointer;
}

div.contenedorTabla table h1 { 
	width:100%;
	text-align: center;
}

div.contenedorTabla table input { /*Para los filtros*/
	height:100%;
	width:100%;
}

div.contenedorTabla table select { /*Para los filtros*/
	height:100%;
	width:100%;
}



div.contenedorTabla td.titulosColumnas {
	font-size:1em;
	cursor:pointer;
	font-weight: bold;
	display: flex; 
	justify-content:left; 
	align-items: center; 
}


div.contenedorTabla td.totalizador {
	display: flex; 
	justify-content:left; 
	align-items: center; 
}




div.contenedorTabla footer {
	display:block;
	width:100%;
	height:10%;
	background-color: beige;
	overflow: hidden;

}

div.contenedorTabla footer div.totalRegistros {
	font-size:1.2em;
	height:100%;
	width:20%;
	float:left;
	font-weight:bold;
}


div.contenedorTabla footer div.textoPie {
	font-size:1.2em;
	height:100%;
	width:70%;
	display: flex; 
	justify-content:center;
	align-items: center;
}




div.contenedorTabla table {
  width:100%;
  height:80%;
  border-collapse: collapse;
  
}

div.contenedorTabla thead {
  display: block; /*todos los elementos que contendrá se renderizaran en este grupo de lineas */
  background-color: #FF7361;
  text-align: center;
  height: 20%;
  overflow-y: scroll;
}


div.contenedorTabla tfoot {
  display: block; /*todos los elementos que contendrá se renderizaran en este grupo de lineas */
  background-color: #FF7361;
  height: 10%;
  overflow-y: scroll;
  text-align: center;
}




div.contenedorTabla tbody { /*todos los elementos que contendrá se renderizaran en este grupo de lineas */
  display: block;
  overflow-y: scroll;
  /*color: #000;*/
  color: white;
  height:70%;
}


div.contenedorTabla tr {
  display: block; /*todos los elementos que contendrá se renderizaran en esta linea */
  overflow: hidden;
  height:60px;
}


div.contenedorTabla tbody tr:nth-child(odd) {
  background: rgba(0,0,0,.2);
}


div.contenedorTabla tbody tr:nth-child(even) {
  background: rgba(0,0,0,.3);
}

div.contenedorTabla th, td {
	float:left; /*todos flotan respetando sus anchos pero dentro de los limites el contenedor
	                que debera presentarse como display:block;*/
	display:flex;
	display: flex; /*Permite flexibilizar el contenido*/
	justify-content: center; /*Permite centrar al medio en x el contenido*/
	align-items: center; 
	width:100%;
	height:100%;
}

/*Ancho y alto de las columnas*/

[campo-dato="articulos_codArt"] {
  width:10%;
  height:100%;
}
[campo-dato="articulos_familia"] {
  width: 10%;
  height:100%;
}
[campo-dato="articulos_descripcion"] {
  width: 15%;
  height:100%;
}
[campo-dato="articulos_um"] {
  width:5%;
  height:100%;
}
[campo-dato="articulos_fechaAlta"] {
  width: 10%;
  height:100%;
}
[campo-dato="articulos_saldoStock"] {
  width: 10%;
  height:100%;
  text-align:right;
}


[campo-dato="articulos_pdf"] {
  width: 10%;
  height:100%;
  text-align:right;
}

[campo-dato="articulos_btC"] {
	width: 10%;
	height:100%;
}


[campo-dato="articulos_btModi"] {
  width: 10%;
  height:100%;
 cursor:pointer;

}

[campo-dato="articulos_btBaja"] {
  width: 10%;
  height:100%;
  cursor:pointer;
}



/*Estilo para comportamiento de modales*/




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

/*Comportamiento Modal*/
div.ventanaModalFormularioApagado {
	visibility:hidden;
}

div.ventanaModalFormularioPrendido {
	visibility:visible;
}

/*Comportamiento Modal Respuesta*/
div.ventanaModalRespuestaApagado {
	visibility:hidden;
}

div.ventanaModalRespuestaPrendido {
	visibility:visible;
}




/*Ventana Modal Formulario*/


div.ventanaModalFormulario {
	position:fixed;
	left:33%;
	top:13%;
	width:50%;
	height:50%;
	color:black;
	/*padding:1%;*/
	z-index:10;
	/*overflow:hidden;*/
}


div.ventanaModalFormulario header {
	width:100%;
	height:10%;
	background-color:#AAAAAA;
	display:block;
	overflow:hidden;
}




div.ventanaModalFormulario p {
	font-size: 1.2em;
	background-color: white;
	width:90%;height:100%;
	float: left; /*Asegura que todo lo que siga este pegado a el a la derecha*/
	display: flex; 
	justify-content: center;
	align-items: center;
}

div.ventanaModalFormulario div.btCruz {
	color:red;
	background-color: white;
	width:10%;
	height:100%;
	cursor:pointer;
	display: flex;
	justify-content: center; 
	align-items: center; 
}



div.ventanaModalFormulario div.btCruz:hover {
	background-color:gray;
}



div.ventanaModalFormulario div.contenidoModal {
	background-color: gray;
	width:100%;
	height:80%;
	padding: 2%;
}


div.ventanaModalFormulario footer {
	background-color: gray;
	height:10%;
	display: flex;
	justify-content: center; 
	align-items: center; 
}

div.ventanaModalFormulario button.btModi {
	height:100%;
	width:30%;
}

div.ventanaModalFormulario button.btAlta {
	height:100%;
	width:30%;
}

div.ventanaModalFormulario div.contenidoModal ul {
	list-style: none;
	width:100%;
	height:100%;
	overflow:auto;
	clear:both;
}

div.ventanaModalFormulario div.contenidoModal li {
	/*margin:10px;*/
	width:50%;
	height:30%;
	float:left;
}

@media(max-width:600px) {
	div.ventanaModalFormulario div.contenidoModal li {
		width:100%;
		font-size:1.2em;
	}
}

div.ventanaModalFormulario div.contenidoModal label {
	font-size:1.4em;
	width:80%;
	height:50%;
	display: flex; /*Permite flexibilizar el contenido*/
	/*justify-content: center; Permite centrar al medio en x el contenido*/
	align-items: center; 
}

div.ventanaModalFormulario div.contenidoModal input {
	width:80%;
	height:50%;
	font-size:1em;
}

div.ventanaModalFormulario div.contenidoModal select {
	width:80%;
	height:50%;
	font-size: 1em;
}


div.ventanaModalFormulario option.elementoOptionSelect {
	background-color:beige;
	font-size: 1em;
}









	
/*Ventana Modal respuesta*/

div.ventanaModalRespuesta {
	position:fixed;
	left:45%;
	top:18%;
	width:50%;
	height:50%;
	color:black;
	z-index:20;
}


div.ventanaModalRespuesta header {
	width:100%;
	height:10%;
	background-color: AAAAAA;
	/*clear:both;*/
	overflow:hidden;
}


div.ventanaModalRespuesta header p {
	font-size:1.5em;
	background-color: #EEEEEE;
	width:90%;height:100%;
	float: left; /*Asegura que todo lo que siga este pegado a el a la derecha, ej bt cruz*/
	display: flex; 
	justify-content: center;
	align-items: center;
}

div.ventanaModalRespuesta div.btCruz {
	background-color: white;
	color:red;
	width:10%;
	height:100%;
	float:right;
	cursor:pointer;
	display: flex; /*Permite flexibilizar el contenido*/
	justify-content: center; /*Permite centrar al medio en x el contenido*/
	align-items: center; /*Permite centrar al medio en y el contenido*/
}



div.ventanaModalRespuesta div.btCruz:hover {
	background-color:gray;
}


div.ventanaModalRespuesta div.contenidoModal {
	background-color: #BBBBBB;
	width:100%;
	overflow:auto;
}

div.ventanaModalRespuesta div.contenidoModal p {
	text-align:left;
	font-size:1.5em;
}





</style>



<script src="./jquery.js"></script>

<script id="codigoTabla">


/*Evento de carga inicial*/

$(document).ready(function() {
		objTbDatos=document.getElementById("tbDatos");//Para usar con java script
		objCodArtAlta=document.getElementById("formArticulosEntCodArtAlta");
		objFamiliaAlta=document.getElementById("formArticulosEntFamiliaAlta");
		objDescripcionAlta=document.getElementById("formArticulosEntDescripcionAlta");
		objCodArtModi=document.getElementById("formArticulosEntCodArtModi");
		objFamiliaModi=document.getElementById("formArticulosEntFamiliaModi");
		objDescripcionModi=document.getElementById("formArticulosEntDescripcionModi");
		$("#orden").val("codArt"); //suponiendo que de entrada quisiera este orden
		$("#contenedorTablaArticulos").attr("className","contenedorActivo");
		$("#ventanaModalFormularioAlta").css("visibility","hidden");
		$("#ventanaModalFormularioModi").css("visibility","hidden");
		$("#ventanaModalRespuesta").css("visibility","hidden");
		$("#btEnvioFormModi").attr("disabled",true);
		$("#btEnvioFormAlta").attr("disabled",true);
		llenaFamilias();
});


/*Eventos Modales*/

	$(document).ready(function() {
		$("#btCruzFormularioAlta").click(function() {
			
			$("#contenedorTablaArticulos").attr("className","contenedorTabla");
			$("#contenedorTablaArticulos").attr("className","contenedorActivo");
			$("#ventanaModalFormularioAlta").css("visibility","hidden");
		}); 
	});


	$(document).ready(function() {
		$("#btCruzFormularioModi").click(function() {
			
			$("#contenedorTablaArticulos").attr("class","contenedorTabla");
			$("#contenedorTablaArticulos").attr("className","contenedorActivo");
			$("#ventanaModalFormularioModi").css("visibility","hidden");
			
		}); 
	});



	$(document).ready(function() {
		$("#btCruzRespuesta").click(function() {
			
			$("#contenedorTablaArticulos").attr("class","contenedorTabla");
			$("#contenedorTablaArticulos").attr("className","contenedorActivo");
			$("#ventanaModalRespuesta").css("visibility","hidden");
			$("#contenidoModalRespuesta").empty();
			$("#ventanaModalFormularioModi").css("visibility","hidden");
			$("#ventanaModalFormularioAlta").css("visibility","hidden");

		}); 
	});





/*Eventos de Tablas*/


$(document).ready(function() {
	$("#btAccionCarga").click(function() {
		cargaTabla();
	});
});



$(document).ready(function() {
	$("#btAccionVacia").click(function() {
		$("#tbDatos").empty();
	});
});

$(document).ready(function() {
	$("#btLimpiaFiltros").click(function() {
		limpiaFiltros();
	});
});




$(document).ready(function() {
	$("#btAlta").click(function() {
		$("#contenedorTablaArticulos").attr("className","contenedorPasivo");
		$("#ventanaModalFormularioAlta").css("visibility","visible");
		vaciaFormulario(); //carga valor vacío en todos los campos del form
		llenaFamiliasAlta(); //completa familias del cuadro de lista
	});
});


$(document).ready(function() {
	$("#th_articulos_codArt" ).click(function() {
		$("#orden").val("codArt"); //solo cargo esta variable orden
		cargaTabla();
	});	//cierro click
}); //cierro ready


$(document).ready(function() {
	$("#th_articulos_familia" ).click(function() {
		$("#orden").val("familia"); //solo cargo esta variable orden
		cargaTabla();
	});	//cierro click
}); //cierro ready


$(document).ready(function() {
	$("#th_articulos_descripcion" ).click(function() {
		$("#orden").val("descripcion"); //solo cargo esta variable orden
		cargaTabla();
	});	//cierro click
}); //cierro ready

$(document).ready(function() {
	$("#th_articulos_um" ).click(function() {
		$("#orden").val("um"); //solo cargo esta variable orden
		cargaTabla();
	});	//cierro click
}); //cierro ready

$(document).ready(function() {
	$("#th_articulos_fechaAlta" ).click(function() {
		$("#orden").val("fechaAlta"); //solo cargo esta variable orden
		cargaTabla();
	});	//cierro click
}); //cierro ready

$(document).ready(function() {
	$("#th_articulos_saldoStock" ).click(function() {
		$("#orden").val("saldoStock"); //solo cargo esta variable orden
		cargaTabla();
	});	//cierro click
}); //cierro ready



/*Eventos Formularios*/

$(document).ready(function() {
	$("#btEnvioFormModi").click(function() {
			modi();	
	});
});

$(document).ready(function() {
	$("#btEnvioFormAlta").click(function() {
			alta();	
	});
});






/*Validacion en formulario de alta*/
$(document).ready(function() {
	$("#formArticulosEntCodArtAlta").keyup(function() {
			todoListoParaAlta();
		});
}); //cierro ready

$(document).ready(function() {
	$("#formArticulosEntDescripcionAlta").keyup(function() {
			todoListoParaAlta();
		});
}); //cierro ready

$(document).ready(function() {
	$("#formArticulosEntUmAlta").keyup(function() {
			todoListoParaAlta();
		});
}); //cierro ready


$(document).ready(function() {
	$("#formArticulosEntSaldoStockAlta").keyup(function() {
			todoListoParaAlta();
		});
}); //cierro ready


$(document).ready(function() {
	$("#formArticulosEntFechaAltaAlta").change(function() {
			todoListoParaAlta();
		});
}); //cierro ready


/*Validacion en formulario de modi*/
$(document).ready(function() {
	$("#formArticulosEntCodArtModi").keyup(function() {
			todoListoParaModi();
		});
}); //cierro ready



$(document).ready(function() {
	$("#formArticulosEntDescripcionModi").keyup(function() {
			todoListoParaModi();
		});
}); //cierro ready

$(document).ready(function() {
	$("#formArticulosEntFamiliaModi").change(function() {
			todoListoParaModi();
		});
}); //cierro ready

$(document).ready(function() {
	$("#formArticulosEntDescricionModi").change(function() {
			todoListoParaModi();
		});
}); //cierro ready

$(document).ready(function() {
	$("#formArticulosEntUmModi").change(function() {
			todoListoParaModi();
		});
}); //cierro ready

$(document).ready(function() {
	$("#formArticulosEntFechaAltaModi").change(function() {
			todoListoParaModi();
		});
}); //cierro ready

$(document).ready(function() {
	$("#formArticulosEntSaldoStockModi").keyup(function() {
			todoListoParaModi();
		});
}); //cierro ready

/*
$(document).ready(function() {
	$("#btCierraSesion").click(function() {
		location.href="../destruirsesion.php";
	});
});

*/


/*Funciones*/

function todoListoParaAlta() { //Habilita/deshabilita boton de alta
	//alert("Dentro de todo listo para el alta");
	if (document.getElementById("formArticulosAlta").checkValidity()) {
		//alert("aquiTL");
		$("#btEnvioFormAlta").attr("disabled",false);
	}
	else { 
		$("#btEnvioFormAlta").attr("disabled",true);
	}
}

function todoListoParaModi() { //Habilita/deshabilita boton de modi
	//alert("dentro de todoListo para modi");

	if (document.getElementById("formArticulosModi").checkValidity()) {
		$("#btEnvioFormModi").attr("disabled",false);
	}
	else { 
		$("#btEnvioFormModi").attr("disabled",true);
	}
}






function cargaTabla() {
	
	$("#tbDatos").empty();
	$("#tbDatos").html("<p>Eserando respuesta ..</p>");
	var objAjax = $.ajax({
		type:"get", 
		url:"salidaJsonArticulos.php",
		timeout:8000,
		data: { 
			orden: $("#orden").val(),
			f_articulos_codArt: $("#f_articulos_codArt").val(),
			f_articulos_familia: $("#f_articulos_familia").val(),
			f_articulos_descripcion: $("#f_articulos_descripcion").val(),
			f_articulos_um: $("#f_articulos_um").val(),
			f_articulos_fechaAlta:$("#f_articulos_fechaAlta").val()
		},
		success: function(respuestaDelServer,estado) {  //La funcion de callback que se ejecutara cuando el req. sea completado.
					//$("#tbDatos").html(respuestaDelServer)//para ver el json recibido dentro de tbDatos;
					$("#tbDatos").empty();
					alert(respuestaDelServer);
					
					objJson=JSON.parse(respuestaDelServer);
					//Luego barre el objeto de datos leyendo sus datos copiandolos al cuerpo de la tabla.
					objJson.articulos.forEach(function(argValor,argIndice) { 
					var objTr= document.createElement("tr");
					var objTd=document.createElement("td");
					//objTd.setAttribute("classname","")
					objTd.setAttribute("campo-dato","articulos_codArt");
					objTd.innerHTML=argValor.codArt;
					objTr.appendChild(objTd);

					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_familia");
					objTd.innerHTML=argValor.familia;
					objTr.appendChild(objTd);

					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_um");
					objTd.innerHTML=argValor.um;
					objTr.appendChild(objTd);


					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_descripcion");
					objTd.innerHTML=argValor.descripcion;
					objTr.appendChild(objTd);

					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_fechaAlta");
					objTd.innerHTML=argValor.fechaAlta;
					objTr.appendChild(objTd);

					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_saldoStock");
					objTd.innerHTML=argValor.saldoStock;
					objTr.appendChild(objTd);

					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_pdf");
					objTd.innerHTML="<button class='btCelda'>PDF</button>";

					objTd.onclick=function() {
						$("#contenedorTablaArticulos").attr("className","contenedorPasivo");
						$("#ventanaModalRespuesta").css("visibility","visible");
						traeDoc(argValor.codArt);
					}

					objTr.appendChild(objTd);


					/*Consulta adicional*/
					/*
					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_btC");
					objTd.innerHTML="<button class='btCelda'>C</button>";

					objTd.onclick=function() {
						$("#contenedorTablaArticulos").attr("className","contenedorPasivo");
						$("#ventanaModalRespuesta").css("visibility","visible");
						$("#contenidoModalRespuesta").html("<img src='./gifAnimado.gif'>");
						consultaDatos(argValor.codArt);
					}
					objTr.appendChild(objTd);
					*/



					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_btModi");
					objTd.innerHTML="<button class='btCelda'>Modi</button>";



					objTd.onclick=function() {	
						$("#contenedorTablaArticulos").attr("className","contenedorPasivo");
						$("#ventanaModalFormularioModi").css("visibility","visible");
						//alert();
						llenaFamiliasModi();
						CompletaFichaArticulo(argValor.codArt);
						//alert("din");
					};

					objTr.appendChild(objTd);


					var objTd=document.createElement("td");
					objTd.setAttribute("campo-dato","articulos_btBaja");
					objTd.innerHTML="<button class='btCelda'>Borrar</button>";

					objTd.onclick=function() {	
					baja(argValor.codArt);
					}

					objTr.appendChild(objTd);

					objTbDatos.appendChild(objTr);
				
					});//cierra el forEach
					$("#totalRegistros").html("Nro de registros: " + objJson.articulos.length);
					
				}//cierra funcion asignada al success
			}); //cierra objeto de parametros y funcion ajax

}//cierra funcion cargaTabla


function CompletaFichaArticulo(argArticulo) {	
	$("#formArticulosEntCodArtModi").val(argArticulo);
	var objAjax = $.ajax({
		type:"get", 
		url:"./salidaJsonArticulo.php",
		data: { codArt:argArticulo },
		success: function(respuestaDelServer,estado) {  //La funcion de callback que se ejecutara cuando el req. sea completado.
			//alert(respuestaDelServer);
			objetoDato = JSON.parse(respuestaDelServer);
			$("#formArticulosEntCodArtModi").val(objetoDato.codArt);
			$("#formArticulosEntFamiliaModi").val(objetoDato.familia);
			$("#formArticulosEntDescripcionModi").val(objetoDato.descripcion);
			$("#formArticulosEntUmModi").val(objetoDato.um);						
			$("#formArticulosEntfechaAltaModi").val(objetoDato.fechaAlta);
			$("#formArticulosEntSaldoStockModi").val(objetoDato.saldoStock);
			todoListoParaModi();//habilitacion del boton de enviar modi si todo valida
		} //cierra el success
	}); //cierro ajax
}




function vaciaFormulario() {
	$("#formArticulosEntCodArtAlta").val("");
	$("#formArticulosEntFamiliaAlta").val("");
	$("#formArticulosEntDescripcionAlta").val("");
	$("#formArticulosEntUmAlta").val("");						
	$("#formArticulosEntfechaAltaAlta").val("");
	$("#formArticulosEntSaldoStockAlta").val("");
}




function llenaFamilias() { //el argumento corresponde al objeto que será llenado
			$("#f_articulos_familia").empty();
			var objAjax = $.ajax({
			type:"get", 
			url:"./salidaJsonFamilias.php",
			
			success: function(respuestaDelServer,estado) {
						alert(respuestaDelServer);
						listaDeObjetos = JSON.parse(respuestaDelServer);
						/*Agrega la opcion vacia*/
						var objOption= document.createElement("option");
						/*objOption.setAttribute("class","elementoOptionSelect");*/
						objOption.setAttribute("value", ""); 
						objOption.innerHTML="";
						document.getElementById("f_articulos_familia").appendChild(objOption);

						/*Barre el array de lista de Objetos para agregar opciones*/
						listaDeObjetos.familias.forEach(function(argValor,argIndice) { 
												
							var objOption= document.createElement("option");
							objOption.setAttribute("value", argValor.codFamilia); 
							//alert(argValor.codFamilia);
							objOption.innerHTML=argValor.descripcionFamilia;

							document.getElementById("f_articulos_familia").appendChild(objOption);
							
						});//cierra foreach
						return true;
			} //cierra el success
	}); //cierro ajax
}








function llenaFamiliasAlta() { //el argumento corresponde al objeto que será llenado
			$("#formArticulosEntFamiliaAlta").empty();
			var objAjax = $.ajax({
			type:"get", 
			url:"./salidaJsonFamilias.php",
			
			success: function(respuestaDelServer,estado) {
						//alert(respuestaDelServer);
						listaDeObjetos = JSON.parse(respuestaDelServer);
						listaDeObjetos.familias.forEach(function(argValor,argIndice) { 
												
							var objOption= document.createElement("option");
							objOption.setAttribute("class","elementoOptionSelect");
							objOption.setAttribute("value", argValor.codFamilia); 
							
							objOption.innerHTML=argValor.codFamilia + argValor.descripcionFamilia;

							document.getElementById("formArticulosEntFamiliaAlta").appendChild(objOption);
							
						});//cierra foreach
						return true;
			} //cierra el success
	}); //cierro ajax
}



function llenaFamiliasModi() { 
	//alert($("#formArticulosEntFamiliaModi").val());
		$("#formArticulosEntFamiliaModi").empty(); //antes de llenar vacío para no duplicar elementos
	//alert($("#formArticulosEntFamiliaModi").val());		
			/*Este objeto del documento es un array de opciones que ya puede estar cargado de antes y hay
			que vaciarlo si lo deseo recargar.
			El value del select*/

			var objAjax = $.ajax({
			type:"get", 
			url:"./salidaJsonFamilias.php",
			
			success: function(respuestaDelServer,estado) {
						
						listaDeObjetos = JSON.parse(respuestaDelServer);
						listaDeObjetos.familias.forEach(function(argValor,argIndice) { 
						
							
							var objOption= document.createElement("option");
							objOption.setAttribute("class","elementoOptionSelect");
							objOption.setAttribute("value", argValor.codFamilia); 

							//El formulario ya está cargado con los datos desde el momento en que 
							//hizo click en el boton de modi del registro apuntado.
							objOption.innerHTML=argValor.codFamilia + argValor.descripcionFamilia;
							if(objOption.value == $("#formArticulosEntFamiliaModi").val()) {
								objOption.setAttribute("selected","selected");
							}

							document.getElementById("formArticulosEntFamiliaModi").appendChild(objOption);
														
						});//cierra foreach
						return true;
			} //cierra el success
	}); //cierro ajax
}


function limpiaFiltros() {
	$("#f_articulos_codArt").val("");
	$("#f_articulos_familia").val("");
	$("#f_articulos_um").val("");
	$("#f_articulos_descripcion").val("");
	$("#f_articulos_fechaAlta").val("");
}

function consultaDatos(codArt) {
		//primera funcion:
		var promesaIsBloqueado = $.ajax({
			dataType:"text",
			type: "get",
			url: "./isBloqueado.php",
			data: {codArt:codArt}
		}); //cierra ajax

		// segunda funcion 
		var promesaPrecio = $.ajax({
			dataType:"text",
			type: "get",
			url: "./precio.php",
			data: {codArt:codArt}
		}); //cierra ajax

		//Puedo ejecutar n requerimientos ajax y pretender ejecutar un handler cuando todos los requerimientos
		//hayan recibido respuesta

		$.when(promesaIsBloqueado, promesaPrecio).done(function(respuestaDelServerIsBloqueado,respuestaDelServerPrecio) {
			//alert(respuestaDelServerIsBloqueado[0]);
			$("#ventanaModalRespuesta").css("visibility","visible");
			$("#encabezadoModalRespuesta").append("Respuestas del server");
			$("#contenidoModalRespuesta").empty();
			$("#contenidoModalRespuesta").append("<h2>Está bloqueado? "+respuestaDelServerIsBloqueado[0]+"<h2>");
			
			$("#contenidoModalRespuesta").append("<h2>Precio unitario: "+respuestaDelServerPrecio[0]+"</h2>");
			

		});//cierra el done


}




function modi() {
	if(confirm("¿Está seguro de modificar registro? " + $("#formArticulosEntCodArtModi").val())) {
/*
		var objAjax = $.ajax({
			type: "get",
			//url:'./salidaJsonFamilias.php',
			url: "./modi.php",
			data: {
				codArt:$("#formArticulosEntCodArtModi").val(),
				familia:$("#formArticulosEntFamiliaModi").val(),
				descripcion:$("#formArticulosEntDescripcionModi").val(),
				um:$("#formArticulosEntUmModi").val(),
				fechaAlta:$("#formArticulosEntfechaAltaModi").val(),
				saldoStock:$("#formArticulosEntSaldoStockModi").val()
			},
*/
			var data = new FormData($("#formArticulosModi")[0]);
			var objAjax = $.ajax({
			type: 'post',
			method: 'post',
			enctype: 'multipart/form-data',
			url: "./modi.php",
			processData: false,  // Importante!
      contentType: false,
      cache: false,
			data: data,

			success:function(respuestaDelServer) {
				//alert(respuestaDelServer);
				
				$("#ventanaModalRespuesta").css("visibility","visible");
				$("#contenidoModalRespuesta").empty();
				$("#encabezadoModalRespuesta").append("Respuesta del server: ");
				$("#contenidoModalRespuesta").append(respuestaDelServer);

				$("#ventanaModalFormulario").css("visibility","hidden");

			} //cierra success

		}); //cierra ajax
		//cargaTabla();
	} //cierra confirm
	//cargaTabla();
} //cierra modi()




function alta() {
	if(confirm("¿Está seguro de insertar registro? ")) {

		var data = new FormData($("#formArticulosAlta")[0]);//Definimos un objeto data que es el form completo
		var objAjax = $.ajax({
			type: 'post',
			method: 'post',
			enctype: 'multipart/form-data',
			url: "./alta.php",
			processData: false,  // Importante!
	    contentType: false,
	    cache: false,
			data: data,

			success:function(respuestaDelServer) {
				//alert(respuestaDelServer);
				

				$("#ventanaModalRespuesta").css("visibility","visible");
				$("#contenidoModalRespuesta").empty();
				$("#encabezadoModalRespuesta").append("Respuesta del server: ");
				$("#contenidoModalRespuesta").append(respuestaDelServer);

				$("#ventanaModalFormulario").css("visibility","hidden");

			} //cierra success
		
		}); //cierra ajax
		//cargaTabla();
	} //cierra confirm
	//cargaTabla();
	
} //cierra alta()



function baja(argArticulo) {
	if(confirm("¿Está seguro de borrar este registro? ")) {

		var objAjax = $.ajax({
			type: "get",
			url: "./baja.php",
			data: {
				codArt:argArticulo
			},
			success:function(respuestaDelServer) { //datos es lo que catura ajax
				//alert(respuestaDelServer);
				
				$("#ventanaModalRespuesta").css("visibility","visible");
				$("#contenidoModalRespuesta").empty();
				$("#contenidoModalRespuesta").append(respuestaDelServer);
				$("#ventanaModalFormulario").css("visibility","hidden");

			} //cierra success
		}); //cierra ajax
	} //cierra confirm
//cargaTabla();
} //cierra baja()


function traeDoc(argArticulo) {
	if(confirm("¿Está seguro de traer este dato? ")) {

		var objAjax = $.ajax({
			type: "get",
			url: "./traeDoc.php",
			data: {
				codArt:argArticulo
			},
			success:function(respuestaDelServer) { //datos es lo que catura ajax
				//alert("Respuesta del SERVER desde adentro del success:"+ respuestaDelServer);
				objetoDato = JSON.parse(respuestaDelServer);
				$("#ventanaModalRespuesta").css("visibility","visible");
				$("#contenidoModalRespuesta").empty();
				$("#contenidoModalRespuesta").html("<iframe width='100%' height='600px' src='data:application/pdf;base64,"+objetoDato.documentoPdf+"'></iframe>");

			} //cierra success
		}); //cierra ajax
	} //cierra confirm

cargaTabla();

} 

/*
$(document).ready(function() {
	$("#btCierraSesion").click(function() {
		location.href="../destruirsesion.php";
	});
});
*/
</script>


</head>


<body>
	<div id="contenedorTablaArticulos" class="contenedorTabla">
		
		<header >
			<h1 style="width:30%">Articulos.</h1>

			<label >Orden:</label>
			<input type="text" name="orden" id="orden" readonly value="" >

			<button id="btAccionCarga">Cargar datos</button>
			<button id="btAccionVacia">Vaciar datos</button>
			<button id="btLimpiaFiltros">Limpiar filtros</button>
			<button id="btAlta">Alta registro</button>
			<!--<button id="btCierraSesion">Cierra Sesión</button>-->
		</header>



		<table>
			<thead >
			<tr style="height:50%">
			<td class="titulosColumnas" campo-dato="articulos_codArt" id="th_articulos_codArt">Cod Art</td>
			<td class="titulosColumnas" campo-dato="articulos_familia" id="th_articulos_familia">familia</td>
			<td class="titulosColumnas" campo-dato="articulos_um" id="th_articulos_um">um</td>
			<td class="titulosColumnas" campo-dato="articulos_descripcion" id="th_articulos_descripcion">descrip</td>
			<td class="titulosColumnas" campo-dato="articulos_fechaAlta" id="th_articulos_fechaAlta">fecha Alta</td>
			<td class="titulosColumnas" campo-dato="articulos_saldoStock" id="th_articulos_saldoStock">Saldo stock</td>
			<td class="titulosColumnas" campo-dato="articulos_pdf" id="th_articulos_pdf">PDFs</td>
			<!--<td class="titulosColumnas" campo-dato="articulos_btC" id="th_articulos_btC">C</td>	-->
			<td class="titulosColumnas" campo-dato="articulos_btModi">Modis</td>
			<td class="titulosColumnas" campo-dato="articulos_btModi">Bajas</td>
			</tr>

			<tr style="height:50%">
			<td campo-dato="articulos_codArt"><input id="f_articulos_codArt"></input></td>
			<td campo-dato="articulos_familia">
				<select id="f_articulos_familia" name="familia"></select> 
				<!--<input id="f_articulos_familia"></input>-->
			</td>
			<td campo-dato="articulos_um"><input id="f_articulos_um"></input></td>
			<td campo-dato="articulos_descripcion"><input id="f_articulos_descripcion"></input></td>
			<td campo-dato="articulos_fechaAlta"><input id="f_articulos_fechaAlta"></input></td>
			<td campo-dato="articulos_saldoStock"></td>
			<td campo-dato="articulos_pdf"></td>
			<td campo-dato="articulos_btC"></td>
			<td campo-dato="articulos_btModi"></td>
			<td campo-dato="articulos_btbaja"></td>
			</tr>
			</thead>

			<tbody id="tbDatos">
			</tbody>

			<tfoot>
			<tr>
			<td class="totalizador" campo-dato="articulos_codArt" id="tf_articulos_codArt"></td>
			<td class="totalizador" campo-dato="articulos_familia" id="tf_articulos_familia"></td>
			<td class="totalizador" campo-dato="articulos_um" id="tf_articulos_um"></td>
			<td class="totalizador" campo-dato="articulos_descripcion" id="tf_articulos_descripcion"></td>
			<td class="totalizador" campo-dato="articulos_fechaAlta" id="tf_articulos_fechaAlta"></td>
			<td class="totalizador" campo-dato="articulos_saldoStock" id="tf_articulos_saldoStock"></td>
			<td class="totalizador" campo-dato="articulos_pdf" id="tf_articulos_pdf"></td>
			<!--<td class="titulosColumnas" campo-dato="articulos_btC" id="th_articulos_btC"></td>	-->
			<td class="totalizador" campo-dato="articulos_btModi" id="tf_articulos_saldoStock"></td>
			<td class="totalizador" campo-dato="articulos_btBaja" id="tf_articulos_saldoStock"></td>
			</tr>
			</tfoot>

		</table>

		<footer>
			<div id="totalRegistros" class="totalRegistros">
			</div>
			<div id="textoPie" class="textoPie"><h1>Pie</h1>
			</div>
		</footer>
	</div> <!-- cierra contenedorTablaArticulos -->









	<!--Ventana Modal para formulario de alta que debe estar fuera del contenedor-->
	<div id="ventanaModalFormularioAlta" class="ventanaModalFormulario">

		<header>
			<p>Encabezado modal Formulario de alta</p>
			<div id="btCruzFormularioAlta" class="btCruz">X</div>
		</header> <!--Cierra encabezado modal-->

		<div id="contenidoModalFormularioAlta" class="contenidoModal">

			<form  id="formArticulosAlta"  method="post" enctype="multipart/form-data">

				<ul>
				<li>
				<label>codArt: </label>
				<input id="formArticulosEntCodArtAlta" name="codArt" required />
				</li>


				<li>
				<label>Descripción: </label>
				<input id="formArticulosEntDescripcionAlta" name="descripcion" required />
				</li>


				<li>
				<label>Familia de artículo: </label>
				<select id="formArticulosEntFamiliaAlta" name="familia" required></select> 
				</li>


				<li>
				<label>UM: </label>
				<input id="formArticulosEntUmAlta" name="um" required />
				</li>
		
				<li>
				<label>Fecha Alta:</label>
				<input type="date" id="formArticulosEntfechaAltaAlta" name="fechaAlta"  required />
				</li>

				<li>
				<label>Saldo stock: </label>
				<input type="number" min=0 id="formArticulosEntSaldoStockAlta" name="saldoStock" value="0" required />
				</li>

				<li>
				<label>Pdf: </label>
				<input type="file" id="formArticulosEntDocumentoPdfAlta" name="documentoPdf" />
				</li>


				</ul>

			</form>
		</div> <!--Cierra contenido Modal-->

		<footer>
			<button id="btEnvioFormAlta" class="btAlta">Enviar Alta</button>
		</footer>

	</div> <!--Cierra ventana modal formulario-->

	<!--Ventana Modal para formulario de Modi que debe estar fuera del contenedor-->
	<div id="ventanaModalFormularioModi" class="ventanaModalFormulario">

		<header>
			<p>Encabezado modal Formulario de modificación</p>
			<div id="btCruzFormularioModi" class="btCruz">X</div>
		</header> <!--Cierra encabezado modal-->

		<div id="contenidoModalFormularioModi" class="contenidoModal">

			<form  id="formArticulosModi"  method="post" enctype="multipart/form-data">
			<ul>

			<li>
			<label>codArt: </label>
			<input id="formArticulosEntCodArtModi" name="codArt" required />
			</li>

			<li>
			<label>Descripción: </label>
			<input id="formArticulosEntDescripcionModi" name="descripcion" required />
			</li>

			<li>
			<label>Familia de artículo: </label>
			<select id="formArticulosEntFamiliaModi" name="familia" required></select> 
			</li>


			<li>
			<label>UM: </label>
			<input id="formArticulosEntUmModi" name="um" required />
			</li>
	
			<li>
			<label>Fecha Alta:</label>
			<input type="date" id="formArticulosEntfechaAltaModi" name="fechaAlta"  required />
			</li>

			<li>
			<label>Saldo stock: </label>
			<input type="number" min=0 id="formArticulosEntSaldoStockModi" name="saldoStock" value="0" required />
			</li>

		
			<li>
			<label>Documento Pdf: </label>
			<input type="file" id="formArticulosEntDocumentoPdfModi" name="documentoPdf"  />
			</li>
			
			</ul>

			</form>
		</div> <!--Cierra contenido Modal-->

		<footer>
			<button id="btEnvioFormModi" class="btModi">Enviar Modi</button>
		</footer>

	</div> <!--Cierra ventana modal formulario-->

	<!--Ventana Modal para respuesta que debe estar fuera del contenedor-->
	<div id="ventanaModalRespuesta" class="ventanaModalRespuesta">

		<!--<div id="encabezadoModalRespuesta" class="encabezadoModal" >Encabezado modal Respuesta-->
		<header>
			<p>Respuesta del servidor</p>
			<div id="btCruzRespuesta" class="btCruz">X</div>		
		</header> <!--Cierra encabezado modal respuesta-->

		<div id="contenidoModalRespuesta" class="contenidoModal">
		</div><!-- cierra contenidoModalRespuesta-->

	</div> <!--Cierra ventana modal-->
</body>
</html>