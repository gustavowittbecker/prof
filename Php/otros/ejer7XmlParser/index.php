<?php



function ordenaPorId($a, $b) {
return strcmp($a->id,$b->id);
}



function ordenaPorAutor($a, $b){
return strcmp($a->autor,$b->autor);
}

function ordenaPorTipoDeRecurso($a, $b){
return strcmp($a->tipoDeRecurso,$b->tipoDeRecurso);
}
 
$documentos = simplexml_load_file('./doc000001.xml');




echo "<br />Objeto documentos: " . gettype($documentos) . "<br />";

echo "<br />Luego convertire el objeto multidimensional en un array de objetos <br />";

$arregloDocumentos=array();
foreach($documentos as $nodo) {
	//echo "<br />nodos: " . $nodo->nombre . $nodo->apellido . $nodo->edad;
	$arregloDocumentos[]=$nodo;
}

echo "<br />tipo de arregloDocumentos: " . gettype($arregloDocumentos) . "<br />";









$a=$arregloDocumentos;

//print_r($documentos);


echo "<br />pppp";



echo "<br />Sin  ordenar: <br />";
foreach( $a as $recurso ) { 
	echo 'idsssss: '.$recurso->id.'<br />';
	echo 'tipoDeRecurso: '. $recurso->tipoDeRecurso . '<br />'; 
	echo 'autor: '. $recurso->autor . '<br />'; 
            
} 

echo "<br />Ordenado por autor: <br />";
echo "aqui: " . usort($a,"ordenaPorAutor") . "<br />";		
foreach( $a as $recurso ) { 
	echo 'id: '.$recurso->id.'<br />';
	echo 'tipoDeRecurso: '. $recurso->tipoDeRecurso . '<br />'; 
	echo 'autor: '. $recurso->autor . '<br />';           
} 

	

echo "<br />Ordenado por tipoDeRecurso: <br />";
usort($a, "ordenaPorTipoDeRecurso");		
foreach( $a as $recurso ) { 
            echo 'id: '.$recurso->id.'<br />';
			echo 'tipoDeRecurso: '. $recurso->tipoDeRecurso . '<br />'; 
			echo 'autor: '. $recurso->autor . '<br />';           
} 	


echo "<br />Ordenado por id: <br />";
usort($a, "ordenaPorId");		
foreach( $a as $recurso ) { 
            echo 'id: '.$recurso->id.'<br />';
			echo 'tipoDeRecurso: '. $recurso->tipoDeRecurso . '<br />'; 
			echo 'autor: '. $recurso->autor . '<br />';           
} 	


?>
