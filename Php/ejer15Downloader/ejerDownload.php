<?php
$file = $_GET['f'];
$longitud=filesize("./bajada/$file");
header("Expires: 0");
header("Content-Description: File Transfer");
header("Content-Type: application/force-download");
header("Content-Disposition: attachment; filename=\"$file\"");
header("Content-Transfer-Encoding: binary");

$puntFile=fopen("./bajada/$file","r");
$content = fread($puntFile,filesize("./bajada/$file"));
echo $content;
flush();

?>