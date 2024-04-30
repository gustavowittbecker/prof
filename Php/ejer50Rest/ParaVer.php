
<?php

function getParams($input)
 {
    $filterParams = [];
    foreach($input as $param => $value)
    {
            $filterParams[] = "$param=:$param";
    }
    return $filterParams[1] ;
    //return implode(", ", $filterParams);
	}





echo "<br /><br /><br />";


$input=['nombre'=>'Gus', 'apellido'=>'Witt','edad'=>'67'];




echo getParams($input); 

?>