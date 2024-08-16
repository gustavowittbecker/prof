<?php
include("./manejoSesion.inc");
include("./datosConexionDB.inc");

$idViejo = $_POST['idViejo'];
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
$dino = $_POST['dino'];
$peso = $_POST['peso'];
$fecha = $_POST['fecha'];

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // PRIMERO VERIFICO SI EL NUEVO ID YA EXISTE EN LA BASE DE DATOS (NO SERIA VALIDO)
    $sql = "SELECT * FROM descubrimientos WHERE idRegistro = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if (!$stmt->fetch() || $id == $idViejo) {
        // SI EL NUEVO NO EXISTE EN DB, O SI ES EL MISMO (ID NO CAMBIO) ENTONCES ACTUALIZO REGISTRO
        $sql = "UPDATE descubrimientos SET idRegistro = :id, descripcion = :descripcion, tipoDinosaurio = :dino, pesoAprox = :peso, fechaDescubrimiento = :fecha WHERE idRegistro = :idViejo";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':dino', $dino);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':idViejo', $idViejo);
        $stmt->execute();

		//CHEQUEO SI HAY UNA IMAGEN. SI HAY, LA SUBO AL REGISTRO CON UN UPDATE
        if (empty($_FILES['documentacion']['name'])) {
            echo "No ha sido seleccionado ningun file para modificar.\n";
        }
        else {
            $contenidoDoc = file_get_contents($_FILES['documentacion']['tmp_name']);
            $sql="UPDATE descubrimientos SET documentacion=:contenidoDoc WHERE idRegistro=:id;";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':contenidoDoc', $contenidoDoc);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }

        echo "Modificación exitosa";
    } else {
        echo "Ya existe el un registro con ese ID";
    }

    //CIERRO CONEXION CON DB
    $dbh = null;
} catch (PDOException $e) {
    $fecha = date("Y-m-d H:i:s");
    error_log("[$fecha] Error en la consulta: " . $e->getMessage());
    $error = ["error" => "Error en la consulta: " . $e->getMessage()];
    echo json_encode($error);
    exit();
}
?>