<?php

  //Abrir conexion a la base de datos
  function connect($db)
  {
      try {
      	//El metodo constructor PDO lleva 3 argumentos, la sintaxis del primero de ellos contiene la info
      	//de el tipo de motor (mysql, sqlserver, ...), el nombre del host para apuntar y el nombre de la base de datos
         $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);

        // set the PDO error mode to exception
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          return $conn;
      } catch (PDOException $exception) {
          exit($exception->getMessage());
      }
  }


 //Obtener parametros para updates
 function getParams($input)
 {
    $filterParams = [];
    foreach($input as $param => $value)
    {
            $filterParams[] = "$param=:$param";
    }
    return implode(", ", $filterParams);
	}

  //Asociar todos los parametros a un sql
	function bindAllValues($statement, $params)
  {
		foreach($params as $param => $value)
    {
				$statement->bindValue(':'.$param, $value);
		}
		return $statement;
   }
 ?>