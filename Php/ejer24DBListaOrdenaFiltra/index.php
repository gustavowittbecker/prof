<!DOCTYPE html>

<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />


<style id="estiloGlobal">

/*Estilo global*/
* {
	margin:0;
	box-sizing: border-box;
	padding:0;
}
html {
	height:100%;
	width:100%;
}

body {
	height:100%;
	width:100%;
	font-size:14px;
}

</style>


<style id="estiloTabla">
div.contenedorTabla {
	width:100%;
	height:100%;
	background-color: gray;
	/*overflow: auto;*/
}



div.contenedorTabla button {
	height:80%;
	width:20%;
	margin-right:0;
	cursor:pointer;
}


div.contenedorTabla h1 {
	width:100%;
	text-align: center;
	padding:1%;
}

div.contenedorTabla input {
	height:100%;
	width:100%;
}


div.contenedorTabla Select {
	height:100%;
	width:100%;
}

div.contenedorTabla td.titulosColumnas {
	font-size: 1.1em;
	cursor:pointer;
	font-weight: bold;
	display: flex; 
	justify-content: center; 
	align-items: center; 
}


div.contenedorTabla td.totalizador {
	font-weight: bold;
	display: flex; 
	justify-content: center; 
	align-items: center; 
}



div.contenedorTabla header {
	display:flex;
	width:100%;
	height:10%;
	background-color: beige;
	overflow-y:hidden;
	display: flex; 
	justify-content:center;
	align-items: center;
	padding:0;
}

div.contenedorTabla footer {
	display:block;
	width:100%;
	height:10%;
	background-color: beige;
}

div.contenedorTabla footer div.totalRegistros {
	font-size:1.1em;
	height:100%;
	width:20%;
	float: left;
}


div.contenedorTabla footer div.textoPie {
	font-size:1.1em;
	height:100%;
	width:70%;
	display: flex; 
	justify-content:center;
	align-items: center;
	float: left;
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
  text-align: left;
}


div.contenedorTabla tbody { /*todos los elementos que contendrá se renderizaran en este grupo de lineas */
  display: block;
  overflow-y: scroll;
  color: #000;
  height:70%;
}


div.contenedorTabla tr {
  display: block; /*todos los elementos que contendrá se renderizaran en esta linea */
  overflow: hidden;
  height:60px;
}


div.contenedorTabla tbody tr:nth-child(odd) {
  background: rgba(0,0,0,.2);
  color: white;
}


div.contenedorTabla tbody tr:nth-child(even) {
  background: rgba(0,0,0,.3);
  color: white;
}

div.contenedorTabla th, td {
  float:left; /*todos flotan respetando sus anchos pero dentro de los limites el contenedor
                que debera presentarse como display:block;*/
  width:100%;
  height:100%;
}




/*Estilo para tabla de articulos*/

[campo-dato="articulos_codArt"] {
  width: 10%;
  height:100%;
}
[campo-dato="articulos_familia"] {
  width: 10%;
  height:100%;
}
[campo-dato="articulos_descripcion"] {
  width: 20%;
  height:100%;
}
[campo-dato="articulos_um"] {
  width: 10%;
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


</style>



<script src="../jquery.js"></script>

<script id="codigoTabla">


/*Evento de carga inicial*/

$(document).ready(function() {
		objTbDatos=document.getElementById("tbDatos");//Para usar con java script
		objGlobalFamilias="";
		$("#orden").val("codArt"); //suponiendo que de entrada quisiera este orden
		cargaGlobalFamilias();

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
	$("#th_articulos_codArt" ).click(function() {
		$("#orden").val("codArt"); //solo cargo esta variable orden
		//cargaTabla();
	});	//cierro click
}); //cierro ready


$(document).ready(function() {
	$("#th_articulos_familia" ).click(function() {
		$("#orden").val("familia"); //solo cargo esta variable orden
		//cargaTabla();
	});	//cierro click
}); //cierro ready


$(document).ready(function() {
	$("#th_articulos_descripcion" ).click(function() {
		$("#orden").val("descripcion"); //solo cargo esta variable orden
		//cargaTabla();
	});	//cierro click
}); //cierro ready

$(document).ready(function() {
	$("#th_articulos_um" ).click(function() {
		$("#orden").val("um"); //solo cargo esta variable orden
		//cargaTabla();
	});	//cierro click
}); //cierro ready

$(document).ready(function() {
	$("#th_articulos_fechaAlta" ).click(function() {
		$("#orden").val("fechaAlta"); //solo cargo esta variable orden
		//cargaTabla();
	});	//cierro click
}); //cierro ready

$(document).ready(function() {
	$("#th_articulos_saldoStock" ).click(function() {
		$("#orden").val("saldoStock"); //solo cargo esta variable orden
		//cargaTabla();
	});	//cierro click
}); //cierro ready




/*Funciones*/

function cargaTabla() {
	//alert($("#orden").val());
	$("#tbDatos").empty();
	$("#tbDatos").html("<p>Esperando respuesta ..</p>");
	var objAjax = $.ajax({
		type:"get", 
		/*url: "<?php echo $respuestaUsuarios ?>",*/
		url:"salidaJsonArticulosConPrepare.php",
		data: { 
			orden: $("#orden").val(),
			f_articulos_codArt: $("#f_articulos_codArt").val(),
			f_articulos_familia: $("#f_articulos_familia").val(),
			f_articulos_descripcion: $("#f_articulos_descripcion").val(),
			f_articulos_um: $("#f_articulos_um").val(),
			f_articulos_fechaAlta:$("#f_articulos_fechaAlta").val()
		},
		success: function(respuestaDelServer,estado) {//La funcion de callback que se ejecutara cuando el req. sea completado.
					alert(respuestaDelServer);
					
					$("#tbDatos").empty();
					//$("#tbDatos").html(respuestaDelServer)//para ver el json recibido dentro de tbDatos;
					
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


					objTbDatos.appendChild(objTr);
				
					});//cierra el forEach

					$("#totalRegistros").html("Nro de registros: " + objJson.articulos.length);
					
				}//cierra funcion asignada al success
			}); //cierra objeto de parametros y funcion ajax

}//cierra funcion cargaTabla




function cargaGlobalFamilias() {
	var objAjax = $.ajax({
			type:"get", 
			url:"./salidaJsonFamilias.php",
			
			success: function(respuestaDelServer,estado) {
						alert(respuestaDelServer);
						objGlobalFamilias = JSON.parse(respuestaDelServer);
						//Define una variable global para almacenar las familias.
						llenaFiltroFamilias();
					}
	})//cierra ajax
}

function llenaFiltroFamilias() { //Esta funcion completa las familias del filtro y crea un objeto global para las familias.
														//que luego podra ser usado para completar los formularios.
			$("#f_articulos_familia").empty();
			
			/*Agrega la opcion vacia para elegir no filtro*/
			var objOption= document.createElement("option");
			objOption.setAttribute("value", ""); 
			objOption.innerHTML="";
			document.getElementById("f_articulos_familia").appendChild(objOption);			
			//A continuacion: barre el array de familias para agregar opciones
			objGlobalFamilias.familias.forEach(function(argValor,argIndice) { 		 									
				var objOption= document.createElement("option");
				objOption.setAttribute("class","elementoOptionSelect");
				objOption.setAttribute("value", argValor.codFamilia); 
				objOption.innerHTML=argValor.descripcionFamilia;
				document.getElementById("f_articulos_familia").appendChild(objOption);
			
			});//cierra foreach
			
}












/*
function llenaFiltroFamilias() { //el argumento corresponde al objeto que será llenado
			$("#f_articulos_familia").empty();
			var objAjax = $.ajax({
			type:"get", 
			url:"./salidaJsonFamilias.php",
			
			success: function(respuestaDelServer,estado) {
						alert(respuestaDelServer);
						listaDeObjetos = JSON.parse(respuestaDelServer);
						
						var objOption= document.createElement("option");
						
						objOption.setAttribute("value", ""); 
						objOption.innerHTML="";
						document.getElementById("f_articulos_familia").appendChild(objOption);

						
						listaDeObjetos.familias.forEach(function(argValor,argIndice) { 
												
							var objOption= document.createElement("option");
							objOption.setAttribute("value", argValor.codFamilia); 
							objOption.innerHTML=argValor.descripcionFamilia;

							document.getElementById("f_articulos_familia").appendChild(objOption);
							
						});//cierra foreach
						return true;
			} //cierra el success
	}); //cierro ajax
}

*/


</script>


</head>
<body>
	<div id="contenedorTablaArticulos" class="contenedorTabla">
		<header >
			<h1>Articulos</h1>

			<div  >
			<label >Orden:</label>
			<input type="text" name="orden" id="orden" readonly value="" >
			</div>

			<button id="btAccionCarga">Cargar datos</button>
			<button id="btAccionVacia">Vaciar datos</button>

		</header>


		<table >
			<thead >
				<tr style="height:50%">  <!--Encabezados-->
				<td class="titulosColumnas" campo-dato="articulos_codArt" id="th_articulos_codArt">Cod Art</td>
				<td class="titulosColumnas" campo-dato="articulos_familia" id="th_articulos_familia">familia</td>
				<td class="titulosColumnas" campo-dato="articulos_um" id="th_articulos_um">um</td>
				<td class="titulosColumnas" campo-dato="articulos_descripcion" id="th_articulos_descripcion">descrip</td>
				<td class="titulosColumnas" campo-dato="articulos_fechaAlta" id="th_articulos_fechaAlta">fecha Alta</td>
				<td class="titulosColumnas" campo-dato="articulos_saldoStock" id="th_articulos_saldoStock">saldo Stock</td>

				</tr>

				<tr style="height:50%"> <!--Filtros-->
				<td campo-dato="articulos_codArt"><input id="f_articulos_codArt"></input></td>
				<td campo-dato="articulos_familia">
					<select id="f_articulos_familia" name="familia"></select> 
					<!--<input id="f_articulos_familia"></input>-->
				</td>
				<td campo-dato="articulos_um" ><input id="f_articulos_um"></input></td>
				<td campo-dato="articulos_descripcion"><input id="f_articulos_descripcion"></input></td>
				<td campo-dato="articulos_fechaAlta"><input id="f_articulos_fechaAlta"></input></td>
				<td campo-dato="articulos_saldoStock"></td>
				</tr>
			</thead>

			<tbody id="tbDatos">
			</tbody>

			<tfoot>
				<tr>
				<td class="totalizador" campo-dato="articulos_codArt" id="tf_articulos_codArt">T cod Art</td>
				<td class="totalizador" campo-dato="articulos_familia" id="tf_articulos_familia">T Familia</td>
				<td class="totalizador" campo-dato="articulos_um" id="tf_articulos_um">T um</td>
				<td class="totalizador" campo-dato="articulos_descripcion" id="tf_articulos_descripcion">T Descrip</td>
				<td class="totalizador" campo-dato="articulos_fechaAlta" id="tf_articulos_fechaAlta">T fecha Alta</td>
				<td class="totalizador" campo-dato="articulos_saldoStock" id="tf_articulos_saldoStock">T Stk</td>

				</tr>
			</tfoot>

		</table>


		<footer>
			<div id="totalRegistros" class="totalRegistros">
			</div>
			<div id="textoPie" class="textoPie">
				Pie
			</div>
			<div style="clear:both;"></div>
		</footer>
	</div> <!-- cierra contenedorTablaArticulos -->

</body>
</html>