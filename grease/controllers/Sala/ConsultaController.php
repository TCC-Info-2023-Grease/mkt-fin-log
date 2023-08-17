<?php  
# ------ Dados Iniciais
global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ----- Consulta Usuário
$sala = new Sala($mysqli);
 
return $data = [
  'sala' => $sala->obterReceitasComAluno()
];
?>
