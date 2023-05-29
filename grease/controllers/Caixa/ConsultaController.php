<?php  
# ------ Dados Iniciais

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ----- Consulta Caixa
$caixa = new Caixa($mysqli);
 
return $data = [
  'caixa'          => $caixa->buscarTodos(),
  'saldo_atual'    => $caixa->obterSaldoAtual(),
  'saldo_anterior' => $caixa->obterSaldoAnterior()
];
?>