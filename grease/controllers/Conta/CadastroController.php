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
  !empty($_POST['nome']) && isset($_POST['nome'])
);
if (!$campos_validos) 
{
  $_SESSION['fed_conta'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos', 
      'icon'  => 'error'
  ];

  //var_dump($campos_validos);
  navegate($_ENV['ROUTE'] . 'admin.conta.create');
} 


# ----- Cadastro
$conta = new Conta($mysqli);

//ChamaSamu::debug($_POST);

try {
  $dados = [
    'fornecedor_id' => $_POST['fornecedor_id'],
    'usuario_id' => $_POST['usuario_id'],
    'titulo' => $_POST['titulo'],
    'descricao' => $_POST['descricao'],
    'valor' => $_POST['valor'],
    'data_validade' => $_POST['data_validade'],
    'data_insercao' => $_POST['data_insercao']
  ];
  $conta->cadastrar($dados);
  
} catch (Exception $e) {
  //ChamaSamu::debug($e);

  $_SESSION['fed_conta'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos',
    'icon'  => 'error'
  ];

  //var_dump($dados);
  navegate($_ENV['ROUTE'] . 'admin.conta.create');
}

//ChamaSamu::debug($dados);

$_SESSION['fed_conta'] = [ 
  'title' => 'OK!', 'msg' => 'Cadastrado com sucesso',
  'icon'  => 'success'
];

navegate($_ENV['ROUTE'] . 'admin.conta.index');