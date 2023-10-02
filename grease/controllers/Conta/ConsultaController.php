<?php
# ------ Dados Iniciais
global $mysqli;

import_utils([ 'navegate' ]);

Auth::check('adm');

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();


# ----- Cadastro Sala
$contas;
$totalGasto;
$totalContasAPagar;
$totalNecessario;

try {
  $conta = new Conta($mysqli);
  $caixa = new Caixa($mysqli);

  $contas            = $conta->buscarTodos();
  $saldoAtual        = $conta->obterSaldoAtual();
  $totalGasto        = $conta->totalGasto();
  $totalContasAPagar = $conta->totalContasAPagar();
  $totalNecessario   = $caixa->totalNecessario();
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
  'totalContasPagar' => $totalContasAPagar,

  'saldo_atual'      => $saldoAtual
];

return $data;
