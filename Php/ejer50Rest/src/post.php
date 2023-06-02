<?php
include "configConexion.php";
include "utils.php";
//header("HTTP/1.1 200 todo bien!");

/*
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    header('respuesta:valor1');
    echo $_GET['auto'] . "<br />";
	echo $_GET['modelo'] . "<br />"; 
    exit();
	 }
else {
	header('respuesta:valor2');
	echo $_GET['auto'] . "<br />";
	echo $_GET['modelo'] . "<br />"; 
	exit();
}
*/

$respuesta="";

$dbConn =  connect($db);
$respuesta=$respuesta . "La conexion a la base fue lograda exitosamente </br>";
echo $respuesta;
/*
 // listar todos los posts o solo uno

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      //Mostrar un post en formato json
      $sql = $dbConn->prepare("SELECT * FROM posts where id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
	  }
    else {
      //Mostrar lista de posteos en formato json
      $sql = $dbConn->prepare("SELECT * FROM posts");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
	}
}

// Crear un nuevo post pasando parametros por el body del requerimiento http
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
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
}

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
?>