<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;

import_utils([ 'Auth' ]);
Auth::check('adm');

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
  
  navegate($_ENV['VIEWS'] . '/auth/profile.php');
} 


# ----- Show  
$usuario = new Usuario($mysqli);

if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture'])) {
  if (count($_FILES['profile_picture']['tmp_name']) > 0) {
    for ($q = 0; $q < count($_FILES['profile_picture']['tmp_name']); $q++) {
      $nomeDoArquivo = $_FILES['profile_picture']['name'][$q];
      move_uploaded_file($_FILES['profile_picture']['tmp_name'][$q], '../../storage/image/usuario/' . $nomeDoArquivo);
    }
  }
}

$dados = [
  'usuario_id' => $_POST['usuario_id'],
  'nome' => $_POST['nome'],
  'email' => $_POST['email'],
  'celular' => $_POST['celular'],
  'idade' => intval($_POST['idade']),
  'cpf' => $_POST['cpf'] ?? null,
  'foto_perfil' => $nomeDoArquivo
];

// Verifica se uma nova senha foi fornecida
if (!empty($_POST['senha'])) {
  // Se uma nova senha foi fornecida, atualiza a senha no array de dados
  $dados['senha'] = MD5($_POST['senha']);
} else {
  // Se a senha estiver vazia, busca a senha atual do usuário no banco de dados
  $usuario_atual = $usuario->buscarPorID($_POST['usuario_id']);
  $dados['senha'] = $usuario_atual['senha'];
}



try {
  print_r($_POST);
  $usuario->atualizar($dados);
  unset($_SESSION['usuario']); 
  $_SESSION['usuario'] = $usuario->buscarPorID($dados['usuario_id']);
} catch (Exception $e) {
    $_SESSION['fed_profile'] = [ 
    'title' => 'Erro!', 
    'msg'   => 'Campos Invalidos', 
    'icon'  => 'error'
  ];
  
  navegate($_ENV['VIEWS'] . '/auth/profile.php');
}

//print_r($_SESSION);

$_SESSION['fed_profile'] = [ 
  'title' => 'Sucesso!', 
  'msg'   => 'Perfil atualizado com sucesso!', 
  'icon'  => 'success'
];

navegate($_ENV['VIEWS'] . '/auth/profile.php');
