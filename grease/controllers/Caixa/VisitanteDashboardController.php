<?php  
# ------ Dados Iniciais

global $mysqli;
import_utils([ 'valida_campo' ]);


# ----- Consulta Caixa
$caixa = new Caixa($mysqli);
$meta = new Meta($mysqli);
 
return $data = [
  'caixa'             => $caixa->getRegistros(5),
  'saldo_atual'       => $caixa->obterSaldoAtual(),
  'saldo_anterior'    => $caixa->obterSaldoAnterior(),
  'total_gasto'       => $caixa->obterTotalGasto(),
  'total_necessario'  => $meta->obterTotalNecessarioAtivo()
];
?>