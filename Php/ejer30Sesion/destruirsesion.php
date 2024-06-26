<?php
include('./manejoSesion.inc');
include('./libreria.inc');
//infoDesesion();
session_destroy();
header('location:./formularioDeLogin.html');
?>
