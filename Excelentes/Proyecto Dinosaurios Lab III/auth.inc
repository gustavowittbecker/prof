<?php

	//PARA AUTENTICAR:

	function autenticar($login, $pass) {
		include("./datosConexionDB.inc");
		$clave = sha1($pass);

		$dsn = "mysql:host=$host;dbname=$dbname";
		$dbh = new PDO($dsn, $user, $password);

		$sql = "SELECT * FROM usuarios WHERE nickname = :login AND contraseña = :clave";
		$stmt = $dbh->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute([':login' => $login, ':clave' => $clave]);

		$fila = $stmt->fetch();

		if ($fila) {
			// SI AUTENTICO, AUMENTO CONTADOR DE USUARIO
			$contadorActualizado = $fila['contador'] + 1;
			$sqlUpdate = "UPDATE usuarios SET contador = :contador WHERE nickname = :login";
			$stmtUpdate = $dbh->prepare($sqlUpdate);
			$stmtUpdate->execute([':contador' => $contadorActualizado, ':login' => $login]);

			return true;
		} else {
				return false;
			}
		}

	//PARA DAR DE ALTA A NUEVO USUARIO:

	function registrar($login, $pass) {
		include("./datosConexionDB.inc");
		$clave = sha1($pass);

		$dsn = "mysql:host=$host;dbname=$dbname";
		$dbh = new PDO($dsn, $user, $password);

		//CHEQUEO SI EL USUARIO YA EXISTE
		$sql = "SELECT * FROM usuarios WHERE nickname = :login";
		$stmt = $dbh->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$stmt->execute([':login' => $login]);

		//RETORNO FALSE SI USUARIO YA EXISTE
		if ($stmt->fetch()) {
			return false;
		}

		//AÑADIR NUEVO USUARIO Y RETORNO TRUE
		$sql = "INSERT INTO usuarios (nickname, contraseña, contador) VALUES (:login, :clave, 1)";
		$stmt = $dbh->prepare($sql);
		$stmt->execute([':login' => $login, ':clave' => $clave]);

		return true;
	}
?>