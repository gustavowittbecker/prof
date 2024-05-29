<!DOCTYPE html>
<html>

<head>
    <title>Ejemplo de JavaScript</title>
    <meta charset="UTF-8">
</head>

<body>
    <div>
        <!--
        <button id="boton1">Aries</button>
        <button id="boton2">Tauro</button>
        <button id="boton3">Geminis</button>
    -->
    </div>
    <div id="contenido"></div>

    </div>



    <script>



let promesa1 = fetch('aries.txt'); /*devuelve un objeto promesa1 con el recurso solicitado*/

let promesa2 = promesa1.then(function(respuesta){ /*La función anónima pasada en el metodo then() llevara
                                                     como arg el recurso obtenido en la promesa anterior*/
    return respuesta.text();
});

let promesa3 = promesa2.then(function(datosContenidos){ /*La funcion anonima pasada en el metodo then() llevara
                                                        como argumento los datos obtenidos en la promesa2*/
        alert(datosContenidos);
});



/*
fetch('aries.txt').then(function(response){
    response.text().then(function(datos){
        alert(datos);
    });
});
*/


/*version flecha:*/
        /*fetch('aries.txt').then(response=> response.text()).then(datos => alert(datos));*/

 


/* 
Si fuese un archivo json:
        fetch("datos.php")
            .then(response=>response.json())
            .then(datos=>console.log(datos));

*/

    </script>
    </body>

</html>






    </script>

</body>

</html>
