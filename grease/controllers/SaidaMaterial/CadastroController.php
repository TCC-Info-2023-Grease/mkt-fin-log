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
  $_POST['material_id']     &&
  $_POST['usuario_id']      &&
  $_POST['qtde_compra']     
);
if (!$campos_validos) 
{
  $_SESSION['fed_material'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
  ];
  navegate($_ENV['ROUTE'] . 'admin.material.saida.create');
} 


# ----- Cadastro Entrada Caixa
$caixa = new Caixa($mysqli);
print_r($_POST);

$dados = [  
  'usuario_id'        => $_POST['usuario_id'],
  'material_id'       => $_POST['material_id'],
  'categoria'         => $_POST['categoria'],
  'descricao'         => $_POST['descricao'],
  'data_movimentacao' => date("Y-m-d H:i:s"),
  'qtde_compra'       => $_POST['qtde_compra'],
  'valor_gasto'       => 0,
  'valor'             => 0,
  'tipo_movimentacao' => "Saida",
  'forma_pagamento'   => "N/A",
  'obs'               => $_POST['obs']
];

$dados['caixa_id'] = $caixa->cadastrarSaida($dados);

# ----- Cadastro Saida Material
$saidaMaterial = new SaidaMaterial($mysqli);
$saidaMaterial->cadastrar($dados);

$material = new Material($mysqli);
$material->setarSaidaEstoque($dados);


navegate($_ENV['ROUTE'] . 'admin.material.saida.index');
