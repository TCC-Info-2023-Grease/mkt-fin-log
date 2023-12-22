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
  $_POST['usuario_id']     &&
  $_POST['descricao']   &&
  $_POST['titulo']      &&
  $_POST['uri']  
);
if (!$campos_validos) 
{
  $_SESSION['fed_makeof'] = [ 
    'title' => 'Erro!', 
    'msg' => 'Campos Invalidos',  
    'icon' => 'error'
  ];

  navegate($_ENV['ROUTE'] . 'admin.makeof.create');
} 


# ----- Cadastro 
$makeOf = new MakeOf($mysqli);

$dados = [
  'user_id'   => intval($_POST['usuario_id']), 
  'descricao' => $_POST['descricao'],
  'titulo'    => $_POST['titulo'],
  'uri'       => $_POST['uri']
];

$makeOf->cadastrar($dados);

$_SESSION['fed_makeof'] = [ 
  'title' => 'Sucesso!', 
  'msg' => 'Cadastro com sucesso',
  'icon' => 'success' 
];

navegate($_ENV['ROUTE'] . 'admin.makeof.index');

?>