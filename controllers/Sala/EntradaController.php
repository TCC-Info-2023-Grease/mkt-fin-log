<?php 		
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;

import_utils([ 'Auth' ]);
Auth::check('adm');

import_utils([ 'valida_campo', 'navegate' ]);

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();


# ------ Validar Envio de Dados
$campos_validos = (
  $_POST['categoria_escolhida'] &&
  $_POST['descricao']           &&
  $_POST['valor']               &&
  $_POST['forma_pagamento']     
);
if (!$campos_validos) 
{
  $_SESSION['fed_caixa'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
  ];
  navegate($_ENV['ROUTE'] . 'admin.caixa.entrada.create');
} 


# ----- Cadastro Entrada Caixa
$caixa = new Caixa($mysqli);

print_r($_POST);

$aluno_escolhido = isset($_POST['aluno_escolhido']) || !empty($_POST['aluno_escolhido'])? $_POST['aluno_escolhido'] : '';

$dados = [
  'aluno_id'          => $aluno_escolhido,
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
  
  navegate($_ENV['ROUTE'] . 'admin.sala.index');
} catch (Exception $e) {
  //throw $e;
  $_SESSION['fed_caixa'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
  ];

  navegate($_ENV['ROUTE'] . 'admin.sala.create');
}