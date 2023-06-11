<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);

if (isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

// Atualiza a variável de sessão com a data e hora do último acesso
$_SESSION['ultimo_acesso'] = time();


# ------ Validar Envio de Dados
$campos_validos =  (
  $_POST['nome']  && 
  $_POST['email'] && 
  $_POST['celular']    
);
  if (!$campos_validos) 
{
  $_SESSION['fed_profile'] = [ 
    'title' => 'Erro!', 
    'msg'   => 'Campos Invalidos', 
    'icon'  => 'error'
  ];
  navegate($_ENV['URL_VIEWS'] . '/auth/profile.php');
} 


# ----- Show  
$usuario = new Usuario($mysqli);

$dados = [
  'usuario_id' => $_POST['usuario_id'],
  'nome' => $_POST['nome'],
  'email' => $_POST['email'],
  'celular' => $_POST['celular'],
  'idade' => intval($_POST['idade']),
  'cpf' => $_POST['cpf']
];

//print_r($_POST);
$usuario->atualizar($dados);
unset($_SESSION['usuario']); 
$_SESSION['usuario'] = $usuario->buscarPorID($dados['usuario_id']);
//print_r($_SESSION);

$_SESSION['fed_profile'] = [ 
  'title' => 'Sucesso!', 
  'msg'   => 'Perfil atualizado com sucesso!', 
  'icon'  => 'success'
];
navegate($_ENV['URL_VIEWS'] . '/auth/profile.php');
