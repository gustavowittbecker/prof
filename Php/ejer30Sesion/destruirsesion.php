<?php
include('./manejoSesion.inc');
include('./libreria.inc');
//session_unset();
session_destroy();
header('Location:./formularioDeLogin.html');
?>
