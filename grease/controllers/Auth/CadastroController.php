<?php
# ------ Dados Iniciais
require '../../config.php';

global $mysqli;
import_utils(['valida_campo', 'navegate']);

if (isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

// Atualiza a variável de sessão com a data e hora do último acesso
$_SESSION['ultimo_acesso'] = time();

# ------ Validar Envio de Dados
$campos_validos = (
  valida_campo($_POST['tipo_usuario']) &&
  valida_campo($_POST['password']) &&
  valida_campo($_POST['age']) &&
  valida_campo($_POST['email']) &&
  valida_campo($_POST['phone']) &&
  valida_campo($_POST['phone'])
);
if (!$campos_validos) {
  $_SESSION['fed_cadastro_usuario'] = [
    'title' => 'Erro!',
    'msg' => 'Campos Invalidos'
  ];
  navegate($_ENV['URL_VIEWS'] . '/auth/cadastrar.php');
}


# ----- Cadastros 
$usuario = new Usuario($mysqli);

$targetDirectory = "../storage/images/user/";
$nomeDoArquivo = $_FILES["profile_picture"]["name"];
$targetFile = $targetDirectory . basename($_FILES["profile_picture"]["name"]);

$uploadOk = true;
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "O arquivo é muito grande. Por favor, escolha um arquivo menor.";
  $uploadOk = false;
}

if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
  $_SESSION['fed_cadastro_usuario'] = [
    'title' => 'Erro!',
    'msg' => 'Somente são permitidos arquivos JPG, JPEG, PNG e GIF.'
  ];
  navegate($_ENV['URL_VIEWS'] . '/auth/cadastrar.php');
}

if ($uploadOk) {
  if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
    $_SESSION['fed_cadastro_usuario'] = [
      'title' => 'Erro!',
      'msg' => 'Ocorreu um erro ao enviar o arquivo.'
    ];
    navegate($_ENV['URL_VIEWS'] . '/auth/cadastrar.php');
  }
}

if ($usuario->unico('email', $_POST['email'])) {
  $_SESSION['fed_cadastro_usuario'] = [
    'title' => 'Erro!',
    'msg' => 'Usuario Existente'
  ];
  navegate($_ENV['URL_VIEWS'] . '/auth/cadastrar.php');
}

$dados = [
  'tipo_usuario' => $_POST['tipo_usuario'],
  'username' => $_POST['username'],
  'email' => $_POST['email'],
  'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
  'age' => intval($_POST['age']),
  'genrer' => $_POST['genrer'],
  'cell' => $_POST['phone'],
  'cpf' => $_POST['cpf'],
  'profile_picture' => $nomeDoArquivo
];

print_r($dados);
$usuario->cadastrar($dados);


if (!$usuario->login($dados['email'], $dados['password'])) {
  $_SESSION['fed_cadastro_usuario'] = [
    'title' => 'Erro!',
    'msg' => 'Usuario não cadastrado'
  ];
  navegate($_ENV['URL_VIEWS'] . '/auth/cadastrar.php');
}

$_SESSION['usuario'] = $usuario->buscar($dados['email']);
