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

if ($_SERVER['REQUEST_METHOD'] == 'GET') //los datos van por el URI
 
{

  $palabra = explode("?",$_SERVER['REQUEST_URI']);
  $respuesta = $respuesta . "<br />Parte Derecha: " . $palabra[1];

  if ($palabra[1]==="tips"){
      $respuesta = $respuesta . "<br />bien tips ";
  }
  if (substr($palabra[1],0,4) == "tip/"){
      $respuesta = $respuesta . "<br />bien tip/";
  }

/*

    if (isset($_GET['id']))
    {

      //Mostrar un post en formato json
      $sql = $dbConn->prepare("SELECT * FROM posts where id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");

      $respuesta = $respuesta . "<br />viene con id";
      $respuesta = $respuesta . "<br />Parametro id pasado: " . $_GET['id'];
      echo $respuesta;
      echo "<br />" . json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
    }
    else 
    {
      //Mostrar lista de posteos en formato json
      $respuesta = $respuesta . "<br />viene sin id";

      $sql = $dbConn->prepare("SELECT * FROM posts");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo $respuesta;
      echo json_encode( $sql->fetchAll()  );
      exit();
     }

*/
     echo $respuesta;
}


// Crear un nuevo post pasando parametros por el body del requerimiento http
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if (isset($_POST['id']))
    {
      //Mostrar un post en formato json
      $sql = $dbConn->prepare("SELECT * FROM posts where id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo $respuesta;
      echo "<br />" . json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
    }
  $respuesta=$respuesta . "<br />El verbo usado en el requerimiento fue POST y va con id";
  echo $respuesta;
  /*
    $input = $_POST;
    $sql = "INSERT INTO posts
          (title, status, content, user_id)
          VALUES
          (:title, :status, :content, :user_id)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
      $input['id'] = $postId;
      header("HTTP/1.1 200 OK TODO BIEN");
      echo json_encode($input);
      exit();
   }
   */
}

/*
//Borrar un post pasando como parametro el id dentro del url
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
  $id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM posts where id=:id");
  $statement->bindValue(':id', $id);
  $statement->execute();
  header("HTTP/1.1 200 OK");
  exit();
}

//Actualizar un post pasando los paramentros incluido el id dentro del url
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['id'];
    $fields = getParams($input);
    echo $fields;

    $sql = "
          UPDATE posts
          SET $fields
          WHERE id='$postId'
           ";

    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
*/


//echo $respuesta;





?>