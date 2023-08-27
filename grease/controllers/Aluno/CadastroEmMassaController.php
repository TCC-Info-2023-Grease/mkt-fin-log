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
  !empty($_POST['nomes_alunos']) && isset($_POST['nomes_alunos'])
);
if (!$campos_validos) 
{
  $_SESSION['fed_aluno'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos', 
      'icon'  => 'error'
  ];

  //var_dump($campos_validos);
  navegate($_ENV['ROUTE'] . 'admin.alunos.create.all');
} 


# ----- Cadastro
$aluno = new Aluno($mysqli);

//print_r($_POST);

try {
  $dados = [
    'nomes_alunos' => $_POST['nomes_alunos']
  ];
  $aluno->cadastrarEmMassa($dados);
  
  //navegate($_ENV['ROUTE'] . 'admin.alunos.index');
} catch (Exception $e) {
  //throw $e;
  $_SESSION['fed_aluno'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos',
    'icon'  => 'error'
  ];

  //var_dump($dados);
  navegate($_ENV['ROUTE'] . 'admin.alunos.create.all');
}

var_dump($aluno->cadastrarEmMassa($dados));

$_SESSION['fed_aluno'] = [ 
  'title' => 'OK!', 'msg' => 'Cadastrado com sucesso',
  'icon'  => 'success'
];

navegate($_ENV['ROUTE'] . 'admin.alunos.index');