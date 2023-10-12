<?php     
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';
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
  !empty($_POST['nome']) && isset($_POST['nome'])
);
if (!$campos_validos) 
{
  $_SESSION['fed_fornecedor'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos', 
      'icon'  => 'error'
  ];

  //var_dump($campos_validos);
  navegate($_ENV['ROUTE'] . 'admin.fornecedor.create');
} 


# ----- Cadastro
$fornecedor = new Fornecedor($mysqli);

//print_r($_POST);

try {
  $dados = [
    'nome_fornecedor' => $_POST['nome'],
    'cnpj' => $_POST['cnpj'],
    'email' => $_POST['email'],
    'ender' => $_POST['ender'],
    'celular' => $_POST['celular'],
    'descricao' => $_POST['descricao'],
    'status_fornecedor' => $_POST['status_fornecedor']
  ];
  $fornecedor->cadastrar($dados);
  
} catch (Exception $e) {
  throw $e;
  $_SESSION['fed_fornecedor'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos',
    'icon'  => 'error'
  ];

  //var_dump($dados);
  navegate($_ENV['ROUTE'] . 'admin.fornecedor.create');
}

//ChamaSamu::debug($dados);

$_SESSION['fed_fornecedor'] = [ 
  'title' => 'OK!', 'msg' => 'Cadastrado com sucesso',
  'icon'  => 'success'
];

navegate($_ENV['ROUTE'] . 'admin.fornecedor.index');