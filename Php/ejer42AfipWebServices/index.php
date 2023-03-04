<?php
$psPath = "powershell.exe"; 
$psDIR = "C:\\xampp\\htdocs\\prof\\Php\\ejer42AfipWebServices\\"; 
$psScript = "wsaa-cliente.ps1"; 
$runScript = $psDIR. $psScript; 
$runCMD = $psPath." ".$runScript." 2>&1";
echo "\$psPath $psPath <br>"; 
echo "\$psDIR $psDIR <br>"; 
echo "\$psScript $psScript <br>"; 
echo "\$runScript $runScript <br>"; 
echo "\$runCMD $runCMD <br>"; 

exec($runCMD,$out,$ret); 

echo "<pre>"; 
print_r($out); 
print_r($ret); 
echo "</pre>"; 

?>