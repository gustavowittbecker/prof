<?php
include "configConexion.php";
include "utils.php";
//header("HTTP/1.1 200 todo bien!");

$respuesta = "<h4>Respuesta:</h4>";

$respuesta = $respuesta . "Request method: " . $_SERVER['REQUEST_METHOD'] . "<br />";
$respuesta = $respuesta . "Request URI: " . $_SERVER['REQUEST_URI'] . "<br />";

$dbConn =  connect($db);

$respuesta = $respuesta . "La conexion a la base fue lograda exitosamente </br>";
 // listar todos los posts o solo uno


$partes = explode("/",$_SERVER['REQUEST_URI']); //convierte toda la cadena URI en un array separado por "/"
  $respuesta = $respuesta . "<br />Parte 0: " . $partes[0];
  $respuesta = $respuesta . "<br />Parte 1: " . $partes[1];
  $respuesta = $respuesta . "<br />Parte 2: " . $partes[2];
  $respuesta = $respuesta . "<br />Parte 3: " . $partes[3];
  $respuesta = $respuesta . "<br />Parte 4: " . $partes[4];
  $respuesta = $respuesta . "<br />Parte 5: " . $partes[5];  
  $respuesta = $respuesta . "<br />Parte 6: " . $partes[6]; 

  $recurso = $partes[count($partes)-1]; //El recurso sería $partes[6] cuyo valor es el id buscado

  $respuesta = $respuesta . "<br />Recurso: " . $recurso; 



echo $respuesta;
$respuesta ="";

//Proceso:


if (($_SERVER['REQUEST_METHOD'] == 'GET') && ($recurso == "")) { //Si el metodo es get 
                                                                 //y el recurso esta vacio entonces
                                                                  //implica un listado de registros.
  
  $respuesta = "<br /> Devuelve lista";
  
  $sql = $dbConn->prepare("SELECT * FROM posts");
  $sql->execute();
  $sql->setFetchMode(PDO::FETCH_ASSOC);
  header("HTTP/1.1 200 OK");
      
  $respuesta = $respuesta . "<br />" . json_encode( $sql->fetchAll()  );
  echo $respuesta;
  
  exit();

}


elseif (($_SERVER['REQUEST_METHOD'] == 'GET') && ($recurso <> "")) { //si el metodo es get
                                                                     //y el recurso es distinto de vacio entonces
                                                                    //se pide que muestre el recurso.

  $respuesta = $respuesta . "<br /> Devuelve tip nro $recurso";
  $sql = $dbConn->prepare("SELECT * FROM posts where id=:id");
  $sql->bindValue(':id', $recurso);
  
  $sql->execute();
  $fila = $sql->fetch(PDO::FETCH_ASSOC);
  if ($fila == "") {
    $respuesta = $respuesta . "<br />Fila vacia";
    echo  $respuesta;
  }
  else {
    header("HTTP/1.1 200 OK");
    $respuesta = $respuesta . "<br />" . json_encode($fila);
    echo  $respuesta;
    exit();
  }
}

elseif (($_SERVER['REQUEST_METHOD'] == 'POST') && ($recurso == "")) {  //si el metodo es post
                                                                     //y el recurso es igual a vacio entonces
                                                                    //corresponde a una alta
  $input = $_POST;
  $respuesta = $respuesta . "<br />Entra por POST para realizar un alta";
  $respuesta = $respuesta . "<br />titulo recibido:  " . $input["titulo"];
  $respuesta = $respuesta . "<br />estado recibido:  " . $input["estado"];
  $respuesta = $respuesta . "<br />Contenido recibido: " . $input["contenido"];
  $respuesta = $respuesta . "<br />fecha modi recibido:  " . $input["fechaModi"];
  $respuesta = $respuesta . "<br />usuario recibido:  " . $input["usuario"];

  $sql = "INSERT INTO posts (title, status, content, fechaModi, user_id) VALUES (:titulo, :estado, :contenido, :fechaModi, :usuario);";
  $statement = $dbConn->prepare($sql);
  $statement->bindValue(':titulo', $input["titulo"]);
  $statement->bindValue(':estado', $input["estado"]);
  $statement->bindValue(':contenido', $input["contenido"]);
  $statement->bindValue(':fechaModi', $input["fechaModi"]);
  $statement->bindValue(':usuario', $input["usuario"]);
  //bindAllValues($statement, $input);

  $statement->execute();

  //Verificación:

  $sql = "SELECT * from posts ORDER BY id DESC LIMIT 1;";
  $statement = $dbConn->prepare($sql);

 
  $statement->execute();

  $fila = $statement->fetch(PDO::FETCH_ASSOC);
  if ($fila == "") {
    $respuesta = $respuesta . "<br />Fila vacia";
    echo  $respuesta;
  }
  else {
    header("HTTP/1.1 200 OK");
    $respuesta = $respuesta . "<br />" . json_encode($fila);
    echo  $respuesta;
    exit();
  }


}


elseif (($_SERVER['REQUEST_METHOD'] == 'PUT') && ($recurso <> "")) {  //si el metodo es put y el recurso es distinto de "" 
                                                                      //entonces correponde a un update o una modi
  
  

  //Recordar que en php $_PUT no existe
 
  $input = file_get_contents("php://input");
  $input = explode("&",$input);

  $titulo = explode("=",$input[0]);
  $titulo_indice = $titulo[0];
  $titulo_valor = $titulo[1];

  $estado = explode("=",$input[1]);
  $estado_indice = $estado[0];
  $estado_valor = $estado[1];

  $contenido = explode("=",$input[2]);
  $contenido_indice = $contenido[0];
  $contenido_valor = $contenido[1];

  $fechaModi = explode("=",$input[3]);
  $fechaModi_indice = $fechaModi[0];
  $fechaModi_valor = $fechaModi[1];

  $usuario = explode("=",$input[4]);
  $usuario_indice = $usuario[0];
  $usuario_valor = $usuario[1];


  $respuesta = $respuesta . "<br />titulo obtenido: " . $titulo_valor;
  $respuesta = $respuesta . "<br />estado recibido:  " . $estado_valor;
  $respuesta = $respuesta . "<br />Contenido recibido: " . $contenido_valor;
  $respuesta = $respuesta . "<br />fecha modi recibido:  " . $fechaModi_valor;
  $respuesta = $respuesta . "<br />usuario recibido:  " . $usuario_valor;

  

  $sql="UPDATE posts set title=:titulo,status=:estado,content=:contenido,fechaModi=:fechaModi,user_id=:usuario where id=:id;";

  $respuesta = $respuesta . "sql: " . $sql;

  $statement = $dbConn->prepare($sql);
  $statement->bindValue(':titulo', $titulo_valor);
  $statement->bindValue(':estado', $estado_valor);
  $statement->bindValue(':contenido', $contenido_valor);
  $statement->bindValue(':fechaModi', $fechaModi_valor);
  $statement->bindValue(':usuario', $usuario_valor);
  $statement->bindValue(':id', $recurso);
  //bindAllValues($statement, $input);
  echo $respuesta;
  $statement->execute();

}




elseif (($_SERVER['REQUEST_METHOD'] == 'DELETE') && ($recurso <> "")) {  //si el metodo es delete y el recurso es distinto de "" 
                                                                      //entonces correponde a un delete  o una baja.
  

 $respuesta = $respuesta . "<br /> Borra tip nro: " . $recurso;
  $sql = $dbConn->prepare("DELETE FROM posts where id=:id");
  $sql->bindValue(':id', $recurso);
  
  $sql->execute();
  $respuesta = $respuesta . "<br />Fila borrada: " . $recurso;
  echo $respuesta;
}






else {
$respuesta = $respuesta . "<br />Salida sin convergencia. Fin";

echo $respuesta;
}




?>