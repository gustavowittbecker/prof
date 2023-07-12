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


$palabra = explode("/",$_SERVER['REQUEST_URI']);
  $respuesta = $respuesta . "<br />Parte 0: " . $palabra[0];
  $respuesta = $respuesta . "<br />Parte 1: " . $palabra[1];
  $respuesta = $respuesta . "<br />Parte 2: " . $palabra[2];
  $respuesta = $respuesta . "<br />Parte 3: " . $palabra[3];
  $respuesta = $respuesta . "<br />Parte 4: " . $palabra[4];
  $respuesta = $respuesta . "<br />Parte 5: " . $palabra[5];  
  $respuesta = $respuesta . "<br />Parte 6: " . $palabra[6]; 

  $recurso = $palabra[count($palabra)-1];

  $respuesta = $respuesta . "<br />Recurso: " . $recurso; 



if (($_SERVER['REQUEST_METHOD'] == 'GET') && ($recurso == "")) {
  
  
  $respuesta = $respuesta . "<br /> Devuelve lista";
  
  $sql = $dbConn->prepare("SELECT * FROM posts");
  $sql->execute();
  $sql->setFetchMode(PDO::FETCH_ASSOC);
  header("HTTP/1.1 200 OK");
      
  $respuesta = $respuesta . "<br />" . json_encode( $sql->fetchAll()  );
  echo $respuesta;
  
  exit();

}





elseif (($_SERVER['REQUEST_METHOD'] == 'GET') && ($recurso <> "")) {

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

elseif (($_SERVER['REQUEST_METHOD'] == 'POST') && ($recurso == "")) {

  $input = $_POST;
  $respuesta = $respuesta . "<br />Entra por POST para realizar un alta";
  $respuesta = $respuesta . "<br />titulo recibido:  " . $input["titulo"];
  $respuesta = $respuesta . "<br />estado recibido:  " . $input["estado"];
  $respuesta = $respuesta . "<br /> Contenido recibido: " . $input["contenido"];
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
  echo $respuesta;

}




else {
$respuesta = $respuesta . "<br />Fin";

echo $respuesta;
}




?>