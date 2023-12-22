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
  !empty($_POST['titulo']) && isset($_POST['titulo']) &&
  !empty($_POST['descricao']) && isset($_POST['descricao']) &&
  !empty($_POST['sprint_id']) && isset($_POST['sprint_id'])  &&
  !empty($_POST['data_de_vencimento']) && isset($_POST['data_de_vencimento']) &&
  !empty($_POST['aluno_id']) && isset($_POST['aluno_id']) &&
  !empty($_POST['status_tarefa']) && isset($_POST['status_tarefa']) 
);
if (!$campos_validos) 
{
  $_SESSION['fed_task'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos', 
      'icon'  => 'error'
  ];

  //var_dump($campos_validos);
  navegate($_ENV['ROUTE'] . 'admin.task.create');
} 


# ----- Cadastro
$task = new Task($mysqli);

//ChamaSamu::debug($_POST);

try {
  $dados = [
    'titulo' => $_POST['titulo'],
    'descricao' => $_POST['descricao'],
    'data_de_vencimento' => $_POST['data_de_vencimento'],
    'aluno_id' => $_POST['aluno_id'],
    'sprint_id' => $_POST['sprint_id'],
    'status_tarefa' => $_POST['status_tarefa'],
  ];
  $task->cadastrar($dados);
  
} catch (Exception $e) {
  //ChamaSamu::debug($e);

  $_SESSION['fed_task'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos',
    'icon'  => 'error'
  ];

  //var_dump($dados);
  navegate($_ENV['ROUTE'] . 'admin.task.create');
}

//ChamaSamu::debug($dados);

$_SESSION['fed_task'] = [ 
  'title' => 'OK!', 'msg' => 'Cadastrado com sucesso',
  'icon'  => 'success'
];

navegate($_ENV['ROUTE'] . 'admin.task.index');