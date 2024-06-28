<?php
include('./manejoSesion.inc');
//include('./libreria.inc');
session_destroy();
header('location:./formularioDeLogin.html');
?>
