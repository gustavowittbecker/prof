<?php
include("./manejoSesion.inc");
include("./datosConexionDB.inc");

$Id = $_POST['id'];
$Descripcion = $_POST['descripcion'];
$Dino = $_POST['dino'];
$Peso = $_POST['peso'];
$Fecha = $_POST['fecha'];

try {
    // CONECTO A DB
    $dsn = "mysql:host=$host;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM descubrimientos WHERE idRegistro = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $Id);
    $stmt->execute();

    if ($stmt->fetch()) {
        //EL REGISTRO YA EXISTE
        echo "Ya existe un registro con el ID: $Id";
    } else {
        //SI EL REGISTRO NO EXISTE, LO AGREGO A LA TABLA
        $sql = "INSERT INTO descubrimientos (idRegistro, descripcion, tipoDinosaurio, pesoAprox, fechaDescubrimiento) 
                VALUES (:id, :descripcion, :dino, :peso, :fecha)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id', $Id);
        $stmt->bindParam(':descripcion', $Descripcion);
        $stmt->bindParam(':dino', $Dino);
        $stmt->bindParam(':peso', $Peso);
        $stmt->bindParam(':fecha', $Fecha);
        $stmt->execute();

        //UNA VEZ AGREGADO EL REGISTRO:
        //CHEQUEO SI HAY UNA IMAGEN. SI HAY, LA SUBO AL REGISTRO CON UN UPDATE
        if (empty($_FILES['documentacion']['name'])) {
            echo "No ha sido seleccionado ningun file para enviar.\n";
        }
        else {
            $contenidoDoc = file_get_contents($_FILES['documentacion']['tmp_name']);
            $sql="UPDATE descubrimientos SET documentacion=:contenidoDoc WHERE idRegistro=:id;";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':contenidoDoc', $contenidoDoc);
            $stmt->bindParam(':id', $Id);
            $stmt->execute();
        }

        echo "Operación exitosa: Se insertó el registro con el ID: $Id";
    }
} catch (PDOException $e) {
    //MANEJO DE ERROR
    $fecha = date("Y-m-d H:i:s");
    error_log("[$fecha] Error en la consulta: " . $e->getMessage());
    $error = ["error" => "Error en la consulta: " . $e->getMessage()];
    echo json_encode($error);
    exit();
}

// CIERRO CONEXION CON DB
$dbh = null;
?>