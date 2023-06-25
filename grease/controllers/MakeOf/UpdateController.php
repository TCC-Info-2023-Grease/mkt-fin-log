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

// var_dump($_POST); 
// exit;

# ------ Validar Envio de Dados
$campos_validos = (
  $_POST['id']        &&  
  $_POST['descricao'] &&
  $_POST['titulo']    &&
  $_POST['uri']  
);
if (!$campos_validos) 
{
  $_SESSION['fed_makeof'] = [ 
    'title' => 'Erro!', 
    'msg' => 'Campos Invalidos',  
    'icon' => 'error'
  ];

  navegate($_ENV['ROUTE'] . 'admin.makeof.index');
} 


# ----- Atualizar 
$makeOf = new MakeOf($mysqli);

$dados = [
  'id'        => $_POST['id'], 
  'descricao' => $_POST['descricao'],
  'titulo'    => $_POST['titulo'],
  'uri'       => $_POST['uri']
];


$makeOf->atualizar($dados); 

$_SESSION['fed_makeof'] = [ 
  'title' => 'Sucesso!', 
  'msg' => 'Cadastro com sucesso',
  'icon' => 'success' 
];
navegate($_ENV['ROUTE'] . 'admin.makeof.index');
?> 