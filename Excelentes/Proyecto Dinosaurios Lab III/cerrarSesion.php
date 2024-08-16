<?php

	include("./manejoSesion.inc");

	session_destroy();

	header("location:./formularioLogin.html");
?>