<?php
# ------ Dados Iniciais
global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ----- Consulta Material
$material = new Material($mysqli);
 
//print_r($material->buscarTodos());
return $materiais = $material->buscarTodos();
?>