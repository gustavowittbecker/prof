<?php
include("./manejoSesion.inc");
include("./datosConexionDB.inc");

// Configurar error logging
ini_set("log_errors", 1);
ini_set("error_log", "errores.log");

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $fecha = date("Y-m-d H:i:s");
    error_log("[$fecha] Error en la consulta: " . $e->getMessage());
    $error = ["error" => "Error en la consulta: " . $e->getMessage()];
    echo json_encode($error);
    exit();
}

try {
    //SELECCIONO LOS CAMPOS DE LA TABLA TIPOSDINOSAURIO
    $sql = "SELECT * FROM tiposdinosaurio";
    $stmt = $dbh->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    //LOS CARGO EN UN ARRAY DINOSAURIOS
    $dinosaurios = [];
    while ($fila = $stmt->fetch()) {
        $objDinosaurio = new stdClass();
        $objDinosaurio->idTipo = $fila['idTipo'];
        $objDinosaurio->descripcionTipo = $fila['descripcionTipo'];
        array_push($dinosaurios, $objDinosaurio);
    }

    //CREO EL OBJETO Y LO PASO A JSON
    $objDinosaurios = new stdClass();
    $objDinosaurios->dinosaurios = $dinosaurios;
    $objDinosaurios->cantidad = count($dinosaurios);

    $salidaJson = json_encode($objDinosaurios);

    //DEVUELVO EL JSON (LA LISTA DE DINOSAURIOS)
    echo $salidaJson;

} catch (PDOException $e) {
    $fecha = date("Y-m-d H:i:s");
    error_log("[$fecha] Error en la consulta: " . $e->getMessage());
    $error = ["error" => "Error en la consulta: " . $e->getMessage()];
    echo json_encode($error);
    exit();
}

// CIERRO CONEXION CON DB
$dbh = null;
?>