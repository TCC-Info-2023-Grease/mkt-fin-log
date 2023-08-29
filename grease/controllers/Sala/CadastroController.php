<?php 		
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();


# ------ Validar Envio de Dados
$campos_validos = (
  $_POST['valor']               &&
  $_POST['forma_pagamento']     
);
if (!$campos_validos) 
{
  $_SESSION['fed_caixa'] = [ 
      'title' => 'OK!', 'msg' => 'Campos Invalidos', 'icon' => 'error'
  ];
  navegate($_ENV['ROUTE'] . 'admin.sala.create');
} 


# ----- Cadastro Entrada Caixa
$caixa = new Caixa($mysqli);

//print_r($_POST);

$dados = [
  'usuario_id'        => $_POST['usuario_id'],
  'categoria'         => $_POST['categoria_escolhida'],
  'descricao'         => $_POST['descricao'],
  'data_movimentacao' => $_POST['data_movimentacao'],
  'valor'             => floatval($_POST['valor']),
  'tipo_movimentacao' => $_POST['tipo_movimentacao'],
  'forma_pagamento'   => $_POST['forma_pagamento'],
  'obs'               => $_POST['obs']
];

try {
  $caixa->cadastrarEntrada($dados);
  $_SESSION['fed_caixa'] = [ 
    'title' => 'OK!', 'msg' => 'Tudo certo!', 'icon' => 'success'
  ];
} catch (Exception $error) {
  $_SESSION['fed_caixa'] = [ 
    'title' => 'OK!', 'msg' => 'Campos Invalidos', 'icon' => 'error'
  ];
}
navegate($_ENV['ROUTE'] . 'admin.caixa.index');
