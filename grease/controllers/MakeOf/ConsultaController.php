<?php
# ------ Dados Iniciais
global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);

# ----- Consulta Make Of
$makeOf = new MakeOf($mysqli);
 
return $data = [ 'makeOf' => $makeOf->buscarTodos() ];
