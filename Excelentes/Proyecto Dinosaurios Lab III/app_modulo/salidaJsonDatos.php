<?php
include("./manejoSesion.inc");
include("./datosConexionDB.inc");

// Configurar error logging
ini_set("log_errors", 1);
ini_set("error_log", "errores.log");

try {
    // CONECTO A DB
    $dsn = "mysql:host=$host;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //EN CASO DE ERROR, LO ADJUNTO A ARCHIVO DE ERROR Y ADEMAS LO IMPRIMO CON ECHO
    $fecha = date("Y-m-d H:i:s");
    error_log("[$fecha] Error en la consulta: " . $e->getMessage());
    $error = ["error" => "Error en la consulta: " . $e->getMessage()];
    echo json_encode($error);
    exit();
}

//OBTENGO PARAMETROS PARA LA DB
$orden = $_GET['orden'];
$filtroId = $_GET['filtroId'];
$filtroDescripcion = $_GET['filtroDescripcion'];
$filtroDino = $_GET['filtroDino'];
$filtroPeso = $_GET['filtroPeso'];
$filtroFecha = $_GET['filtroFecha'];

$sql = "SELECT * FROM descubrimientos WHERE ";

//CONCATENAMIENTO DE CONSULTA SQL PARA LOS FILTROS
$sql .= "idRegistro LIKE CONCAT('%', :filtroId, '%') AND ";
$sql .= "descripcion LIKE CONCAT('%', :filtroDescripcion, '%') AND ";

if (!empty($filtroDino)){
    $sql .= "tipoDinosaurio LIKE CONCAT('%', :filtroDino, '%') AND ";
}

$sql .= "pesoAprox LIKE CONCAT('%', :filtroPeso, '%') AND ";
$sql .= "fechaDescubrimiento LIKE CONCAT('%', :filtroFecha, '%') ";

//CHEQUEO SI HAY UN ORDER, EN CASO DE QUE SI, LO CONCATENO
if (!empty($orden)) {
    $sql .= "ORDER BY $orden";
}

try {
    //PREPARACION DE SENTENCIA
    $stmt = $dbh->prepare($sql);
    
    //BINDING DE PARAMETROS ------------------
    $stmt->bindParam(':filtroId', $filtroId);
    $stmt->bindParam(':filtroDescripcion', $filtroDescripcion);

    if (!empty($filtroDino)){
        $stmt->bindParam(':filtroDino', $filtroDino);
    }

    $stmt->bindParam(':filtroPeso', $filtroPeso);
    $stmt->bindParam(':filtroFecha', $filtroFecha);

    //EJECUCION DE LA SENTENCIA
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

} catch (PDOException $e) {
    //CARGO VARIABLE DE ERROR EN URL PARAMS
    $fecha = date("Y-m-d H:i:s");
    error_log("[$fecha] Error en la consulta: " . $e->getMessage());
    $error = ["error" => "Error en la consulta: " . $e->getMessage()];
    echo json_encode($error);
    exit();
}

//ALMACENA LOS DATOS OBTENIDOS EN UN ARRAY
$descubrimientos = [];

while ($fila = $stmt->fetch()) {
    //CREACION DE OBJETOS PARA ALMACENAR LOS DATOS
    $objDescubrimiento = new stdClass();
    $objDescubrimiento->idRegistro = $fila['idRegistro'];
    $objDescubrimiento->Descripcion = $fila['descripcion'];
    $objDescubrimiento->tipoDinosaurio = $fila['tipoDinosaurio'];
    $objDescubrimiento->pesoAprox = $fila['pesoAprox'];
    $objDescubrimiento->fechaDescubrimiento = $fila['fechaDescubrimiento'];
    $objDescubrimiento->documentacion = base64_encode($fila['documentacion']);

    array_push($descubrimientos, $objDescubrimiento);
}

// CREO OBJETO PARA LA RESPUESTA JSON FINAL
$response = new stdClass();
$response->descubrimientos = $descubrimientos;
$response->cantidad = count($descubrimientos);

// DEVUELVO RESPUESTA JSON
echo json_encode($response);

// CIERRO CONEXION CON DB
$dbh = null;
?>