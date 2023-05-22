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
  $_POST['categoria_escolhida'] &&
  $_POST['descricao']           &&
  $_POST['valor']               &&
  $_POST['forma_pagamento']     &&
  $_POST['status_caixa']        &&
  $_POST['obs']
);
if (!$campos_validos) 
{
  $_SESSION['fed_caixa'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
  ];
  navegate($_ENV['ROUTE'] . 'admin.caixa.saida.create');
} 


# ----- Cadastro Entrada Caixa
$caixa = new Caixa($mysqli);

print_r($_POST);

$dados = [
  'usuario_id'        => $_POST['usuario_id'],
  'categoria'         => $_POST['categoria_escolhida'],
  'descricao'         => $_POST['descricao'],
  'data_movimentacao' => date("Y-m-d H:i:s"),
  'valor'             => floatval($_POST['valor']),
  'tipo_movimentacao' => $_POST['tipo_movimentacao'],
  'forma_pagamento'   => $_POST['forma_pagamento'],
  'obs'               => $_POST['obs']
];

$caixa->cadastrarSaida($dados);
navegate($_ENV['ROUTE'] . 'admin.caixa.index');
