<?php  
# ------ Dados Iniciais

global $mysqli;

import_utils([ 'Auth' ]);
Auth::check('adm');

import_utils([ 'valida_campo', 'navegate' ]);

# ----- Consulta Caixa
$caixa = new Caixa($mysqli);
$meta = new Meta($mysqli);

//echo $_ENV['TURMA'];

$dadosDespesasReceitasPorMes = $caixa->obterDadosDespesasReceitasPorMes();

$totalReceitas = array_sum($dadosDespesasReceitasPorMes['receitas']);
$totalDespesas = array_sum($dadosDespesasReceitasPorMes['despesas']);


if ($totalDespesas != 0 || $totalReceitas != 0) {
  $porcentagemDespesas = ($totalDespesas / ($totalReceitas + $totalDespesas)) * 100;
  $porcentagemReceitas = 100 - $porcentagemDespesas;
} else {
  $porcentagemDespesas = 0;
  $porcentagemReceitas = 0;
}


return $data = [
  'caixa'             => $caixa->buscarTodos(), // $caixa->buscarTodos($_ENV['TURMA])
  'saldo_atual'       => $caixa->obterSaldoAtual(),
  'saldo_anterior'    => $caixa->obterSaldoAnterior(),
  'total_gasto'       => $caixa->obterTotalGasto(),
  'total_necessario'  => $meta->obterTotalNecessarioAtivo(),

  'meses'             => $dadosDespesasReceitasPorMes['meses'],
  'receitas'          => $dadosDespesasReceitasPorMes['receitas'],
  'despesas'          => $dadosDespesasReceitasPorMes['despesas'],
  'saldos'            => $dadosDespesasReceitasPorMes['saldos'],

  'dadosCategorias'   => $caixa->obterDadosCategorias(),
  
  'totalReceitas'        => $totalReceitas,
  'totalDespesas'        => $totalDespesas,
  
  'porcentagemReceitas'  => $porcentagemReceitas,
  'porcentagemDespesas'  => $porcentagemDespesas
];

?>