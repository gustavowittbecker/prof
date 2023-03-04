<?php
/*
La funcion principal de este script es crear las clases que se usaran en el index y en la mayoria de los
scripts de esta aplicacion.
Este script es un .inc de manera que cualquier otro inc que se necesite debe ser llamado desde el php
que tiene el include() o el requiered() original (por ejemplo datosConexionBase.inc)
*/


class claseUsuarios {
/*
Esta clase genera objetos que contienen un grupo de registros de una consulta sql.
El metodo magico constructor recibe como argumentos a los filtros y el orden y luego
arma el objeto con los datos ya filtrados y en orden
El primer atributo sera un array con todos los registros de la consulta
El segundo atributo sera el numero de registros filtrados en la consulta
Tiene un metodo magico constructor que como tal se ejecuta en el instanciamiento del objeto.
*/

public $usuarios = array();
public $nroUsuarios;
public $sqlString;
public $errorConeccionMotor;
public $errorEnLaConsulta;


public function __construct($filtroLoginDeUsuario,$filtroApellido,$filtroNombres,$filtroArea,$orden) {
	/*Este metodo debera recibir estos argumentos cuando sea invocado*/

	$usuarios = array();

	/*
	Dentro de esta función debo declarar la variable $usuarios. Luego de llenarla de datos se los copiare a 
	la variable externa a dicha función que fue declarada como publica. Esta copia a realizare
	mediante la siguiente sentencia:
	$this->usuarios = $usuarios;
	*/

	$punteroConn=mysqli_connect(SERVER,USUARIO,PASS,BASE);

	if (mysqli_connect_errno()) {
		$this->errorConeccionMotor="Falla en la conexion a al motor MySql: " . mysqli_connect_error();
	}
	else {
		$sqlString="select * from usuarios where loginDeUsuario like '%" . $filtroLoginDeUsuario . "%' and apellido like '%" . $filtroApellido . "%' and nombres like '%" . $filtroNombres . "%' and area like '%" . $filtroArea . "%' order by " . $orden;
		$this->sqlString = $sqlString;
		$resultado=mysqli_query($punteroConn,$sqlString);
		if ($resultado) {
			while($fila=mysqli_fetch_assoc($resultado)) {
				array_push($usuarios, $fila);
			}
			$this->usuarios = $usuarios;
			$resultadoCuenta=mysqli_num_rows($resultado);
			$this->nroUsuarios = $resultadoCuenta;
		}
		else {
			$this->errorEnLaConsulta="Error en la consulta sql";
		}
		
	} //Cierra if de coneccion al motor
	mysqli_close($punteroConn);
} //Cierra funcion constructora

} //Cierra clase





class claseUsuario {
public $sqlString;
public $usuario = array();
public $errorConeccionMotor;
public $errorEnLaConsulta;

public function __construct($idUsuario) {
	$usuario = array();
	$punteroConn=mysqli_connect(SERVER,USUARIO,PASS,BASE);
	if (mysqli_connect_errno()) {
		$this->errorConeccionMotor="Falla en la conexion a al motor MySql: " . mysqli_connect_error();
	}
	else {
		$sqlString="select * from usuarios where idUsuario = $idUsuario";
		$this->sqlString=$sqlString;
		$resultado=mysqli_query($punteroConn,$sqlString);
		
		if ($resultado) {
			$fila=mysqli_fetch_assoc($resultado);
			$this->usuario = $fila;		
		}
		else {
			$this->errorEnLaConsulta="Error en la consulta sql";
		}		
	}
	mysqli_close($punteroConn);
} //cierra public function


public function modi($loginDeUsuario,$apellido,$nombres,$area,$clave) {
$punteroConn=mysqli_connect(SERVER,USUARIO,PASS,BASE);
if (mysqli_connect_errno()) {
	$resultadoFuncion = "Error de coneccion: " . mysqli_connect_errno() ;
}
else {

	$sqlString="update usuarios set " . 
	"loginDeUsuario='$loginDeUsuario'," .
	"apellido='$apellido'," .	
	"nombres='$nombres'," .
	"area='$area'," .
	"clave='$clave'" .
	"where idUsuario = '" . $this->usuario['idUsuario']. "'";
	$resultado=mysqli_query($punteroConn,$sqlString);
	if ($resultado) {
			$resultadoFuncion = "Consulta exitosa: " . $sqlString;
			}
	else {
			$resultadoFuncion = "consulta fallada " . $sqlString;
	}		

}
return $resultadoFuncion;
mysqli_close($punteroConn);
}


public function alta($idUsuario,$loginDeUsuario,$apellido,$nombres,$area,$clave) {
$punteroConn=mysqli_connect(SERVER,USUARIO,PASS,BASE);
if (mysqli_connect_errno()) {
	$resultadoFuncion = "Error de coneccion: " . mysqli_connect_errno() ;
}
else {

	$sqlString="insert into usuarios set " .
	"idUsuario='$idUsuario'," . 
	"loginDeUsuario='$loginDeUsuario'," .
	"apellido='$apellido'," .	
	"nombres='$nombres'," .
	"area='$area'," .
	"clave='$clave'";
	$resultado=mysqli_query($punteroConn,$sqlString);
	if ($resultado) {
			$resultadoFuncion = "Consulta exitosa: " . $sqlString;
			}
	else {
			$resultadoFuncion = "consulta fallada " . $sqlString;
	}		




}
return $resultadoFuncion;
mysqli_close($punteroConn);
}




} //cierra class





?>