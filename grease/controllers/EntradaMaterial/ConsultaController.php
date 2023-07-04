<?php
# ------ Dados Iniciais
global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ----- Consulta Material
$entradas = new EntradaMaterial($mysqli);
 
//print_r($entradas->buscarTodos());
return $entradas = $entradas->buscarTodos();
?>