<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';

global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ------ Verificar Sessão
if (isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();

# ------ Validar Envio de Dados
$campos_validos = (
    $_POST['id'] ? true : false
);
if (!$campos_validos) {
  $_SESSION['fed_usuario'] = [
    'title' => 'Erro!',
    'msg' => 'Campos Inválidos',
    'icon' => 'error'
  ];
  navegate($_ENV['ROUTE'] . 'admin.usuario.index');
}

# ------ Atualizar Usuário
$usuario = new Usuario($mysqli);

if (isset($_FILES['profile_picture']) && !empty($_FILES['profile_picture'])) {
  if (count($_FILES['profile_picture']['tmp_name']) > 0) {
    for ($q = 0; $q < count($_FILES['profile_picture']['tmp_name']); $q++) {
      $nomeDoArquivo = $_FILES['profile_picture']['name'][$q];
      move_uploaded_file($_FILES['profile_picture']['tmp_name'][$q], '../../storage/image/usuarios/' . $nomeDoArquivo);
    }
  }
}

$dados = [];

$dados = [
    'usuario_id' => $_POST['id'],
    'nome' => $_POST['nome'],
    'email' => $_POST['email'],
    'cpf' => $_POST['cpf'],
    'idade' => $_POST['idade'],
    'genero' => $_POST['genero'],
    'celular' => $_POST['celular'],
    'foto_perfil' => $nomeDoArquivo
];

// Verifica se uma nova senha foi fornecida
if (!empty($_POST['senha'])) {
    // Se uma nova senha foi fornecida, atualiza a senha no array de dados
    $dados['senha'] = $_POST['senha'];
} else {
    // Se a senha estiver vazia, busca a senha atual do usuário no banco de dados
    $usuario_atual = $usuario->buscarPorID($_POST['id']);
    $dados['senha'] = $usuario_atual['senha'];
}


try {
  $usuario->atualizar($dados);
} catch (Exception $e) {
  $_SESSION['fed_usuario'] = [
    'title' => 'Erro!',
    'msg' => 'Erro ao atualizar usuário',
    'icon' => 'error'
  ];
}

$_SESSION['fed_usuario'] = [
  'title' => 'Sucesso!',
  'msg' => 'Usuário atualizado com sucesso',
  'icon' => 'success'
];

navegate($_ENV['ROUTE'] . 'admin.usuario.index');
