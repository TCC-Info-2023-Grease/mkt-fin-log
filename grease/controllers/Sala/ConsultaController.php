<?php  
# ------ Dados Iniciais
global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ----- Consulta Usuário
$sala = new Sala($mysqli);
 
$porcentagemDevedoresPagantes = $sala->porcentagemDevedoresPagantes();

return $data = [
  'sala'                         => $sala->obterReceitasComAluno(),
  'pagamentosPorMes'             => $sala->agruparPagamentosPorMes(),

  'totalAlunosPagantes'          => $sala->calcularTotalAlunosPagantes(),
  'totalPagamentos'              => $sala->calcularTotalPagamentos(),

  'alunosDevedores'              => $sala->obterAlunosDevedores(),
  'rankingTopPagantes'           => $sala->calcularRankingTopPagantes(),
  
  'porcentagem_devedores'        => abs(round($porcentagemDevedoresPagantes['porcentagem_devedores'], 1)),
  'porcentagem_pagantes'         => abs(round($porcentagemDevedoresPagantes['porcentagem_pagantes'], 1))
];
?>
