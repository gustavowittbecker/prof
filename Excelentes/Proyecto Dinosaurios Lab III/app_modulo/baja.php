<?php
include("./manejoSesion.inc");
include("./datosConexionDB.inc");

$BId = $_GET['BId'];

try {
    echo $BId;

    // CONECTO A DB
    $dsn = "mysql:host=$host;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // MANDO SENTENCIA, BINDEO Y EJECUTO
    $sql = "DELETE FROM descubrimientos WHERE idRegistro=:BId";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':BId', $BId);
    $stmt->execute();

    echo " Se eliminó correctamente";

    // CIERRO CONEXION CON DB
    $dbh = null;

} catch (PDOException $e) {
    $fecha = date("Y-m-d H:i:s");
    error_log("[$fecha] Error en la consulta: " . $e->getMessage());
    $error = ["error" => "Error en la consulta: " . $e->getMessage()];
    echo json_encode($error);
    exit();
}
?>