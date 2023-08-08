<?php  
# ------ Dados Iniciais

global $mysqli;
import_utils([ 'valida_campo' ]);


# ----- Consulta Caixa
$caixa = new Caixa($mysqli);
$meta = new Meta($mysqli);
 

$data = [
  'caixa'             => $caixa->getRegistros(10),
  'saldo_atual'       => $caixa->obterSaldoAtual(),
  'saldo_anterior'    => $caixa->obterSaldoAnterior(),
  'total_gasto'       => $caixa->obterTotalGasto(),
  'total_necessario'  => $meta->obterTotalNecessarioAtivo()
];

return $data;
?>