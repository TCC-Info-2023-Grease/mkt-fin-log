<?php  
# ------ Dados Iniciais
global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ----- Consulta Usuário
$sala = new Sala($mysqli);
 
$porcentagemDevedoresPagantes = $sala->porcentagemDevedoresPagantes();

return $data = [
  'sala' => $sala->obterReceitasComAluno(),
  'agruparPagamentosPorMes'      => $sala->agruparPagamentosPorMes(),
  'totalAlunosPagantes'          => $sala->calcularTotalAlunosPagantes(),
  'totalPagamentos'              => $sala->calcularTotalPagamentos(),
  'alunosDevedores'              => $sala->obterAlunosDevedores(),
  'rankingTopPagantes'           => $sala->calcularRankingTopPagantes(),
  'porcentagem_devedores'        => $porcentagemDevedoresPagantes['porcentagem_devedores'],
  'porcentagem_pagantes'         => $porcentagemDevedoresPagantes['porcentagem_pagantes']
];
?>
