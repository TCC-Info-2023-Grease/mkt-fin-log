<?php
# ------ Dados Iniciais
global $mysqli;

import_utils([ 'navegate' ]);

Auth::check('adm');

# ----- Cadastro Sala
$contas;
$totalGasto;
$totalNecessario;
$totalContasPagas;
$totalContasAPagar;

try {
  $conta = new Conta($mysqli);
  $caixa = new Caixa($mysqli);

  $contas            = $conta->buscarTodos();
  $saldoAtual        = $caixa->obterSaldoAtual();
  $totalGasto        = $conta->totalGasto();
  $totalNecessario   = $conta->totalNecessario();
  $totalContasAPagar = $conta->totalContasAPagar();
  $totalContasPagas  = $conta->totalContasPagas();
} catch (Exception $e) {
    //ChamaSamu::debug($e);

    $_SESSION['fed_conta'] = [ 
      'title' => 'Erro!', 
      'msg' => 'Erro inesperado',
      'icon' => 'error'
    ];

}

$data = [ 
  'contas'           => $contas,
  'totalGasto'       => $totalGasto,
  'totalNecessario'  => $totalNecessario,
  'totalContasAPagar' => $totalContasAPagar,
  'totalContasPagas' => $totalContasPagas,

  'saldoAtual'      => $saldoAtual,

  'dadosStatusConta' => $conta->obterDadosStatusConta(),
  'dadosValorContasPorFornecedor' => $conta->obterValorContasPorFornecedor(),
  'dadosEvolucaoValorTotal' => $conta->obterEvolucaoValorTotal()

];

return $data;
