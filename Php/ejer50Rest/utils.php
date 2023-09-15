<?php

  //Abrir conexion a la base de datos
  function connect($db)
  {
      try {
      	//El metodo constructor PDO lleva 3 argumentos, la sintaxis del primero de ellos contiene la info
      	//de el tipo de motor (mysql, sqlserver, ...), el nombre del host para apuntar y el nombre de la base de datos
         $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);

        // set the PDO error mode to exception
         //con esto el objeto $conn pasa al modo de exception
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          return $conn;
      } catch (PDOException $exception) {
          exit($exception->getMessage()); //la función exit termina la ejecución del script 
                                          //pero antes imprime el mensaje 
                                          //pasado como argumento o el estado en que se encuentra la ejecucion
                                          //pero no devuelve nada
      }
  }


//Obtener parametros para updates
//Esta función recibe un array asociativo como argumento y devuelve sus elementos como una 
//cadena nombre=:nombre, apellido=:apellido, edad=:edad


 ?>