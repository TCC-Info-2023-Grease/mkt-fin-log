<?php
# ------ Dados Iniciais
global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ----- Consulta Material
$saidas = new SaidaMaterial($mysqli);
 
//print_r($saidas->buscarTodos());
return $saidas = $saidas->buscarTodos();
?>