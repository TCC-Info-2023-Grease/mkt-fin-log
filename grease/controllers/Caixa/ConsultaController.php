<?php  
# ------ Dados Iniciais

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ----- Consulta Caixa
$c = new Caixa($mysqli);
 
return $caixa = $c->buscarTodos();
?>