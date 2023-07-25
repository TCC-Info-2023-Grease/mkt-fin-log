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
    $_POST['id'] ? true : false
);
if (!$campos_validos) 
{
  $_SESSION['fed_meta'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos',
    'icon' => 'error'
  ];
  navegate($_ENV['ROUTE'] . 'admin.meta.index');
} 


# ----- Atualizar 
$meta = new Meta($mysqli);

$dados = [
  'meta_id' => $_POST['id'],
  'nome' => $_POST['nome'],
  'descricao' => $_POST['descricao'],
  'data_inicio' => $_POST['data_inicio'],
  'data_fim' => $_POST['data_fim'],
  'total_necessario' => $_POST['total_necessario'],
  'status' => intval($_POST['status'])
];


print_r($_POST);
try {
  $meta->atualizar($dados);
} catch (Exception $e) {
  $_SESSION['fed_meta'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos',
    'icon' => 'error'
  ];
}

$_SESSION['fed_meta'] = [ 
    'title' => 'OK!', 'msg' => 'Atualizado com sucesso',
    'icon' => 'success'
  ];

navegate($_ENV['ROUTE'] . 'admin.meta.index');

?>