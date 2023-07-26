<?php  
# ------ Dados Iniciais
global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ----- Consulta Usuário
$usuario = new Usuario($mysqli);
 
return $data = [
  'usuarios' => $usuario->buscarTodos()
];
?>
