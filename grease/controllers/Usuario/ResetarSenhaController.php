<?php  
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';
 
global $mysqli;
import_utils(['valida_campo', 'navegate', 'EnviarEmail']);

# ----- Resetar Senha
$usuario = new Usuario($mysqli);

//$_POST['email'] = 'gustavojs417@gmail.com';

# Definir regras para cada requisição
if (valida_campo($_POST['email'] ?? null)) {
  $email = $_POST["email"];

  if ($usuario->existeEmail($email)) {
    $token = bin2hex(random_bytes(16)); // Gera um token aleatório
    $expiration = date("Y-m-d H:i:s", strtotime("+1 hour")); // Tempo de expiração (por exemplo, 1 hora a partir de agora)

    $usuario->salvarTokenNoBanco($email, $token, $expiration);

    // Envie um e-mail com o link de redefinição de senha
    EnviarEmail::redefinicaoSenha($email, $token);
  }
}  

$_GET['token']      = '39cb04caf678fb1cbc3e751d955f9db9';
$_POST['novaSenha'] = '12345678';

if (valida_campo($_GET["token"])) {
  $token = $_GET["token"];

  // Verifique se o token é válido e não expirou
  $userData = $usuario->verificarToken($token);
  //var_dump($userData);

  if ($userData) {
    // Token válido, permita ao usuário definir uma nova senha
    $novaSenha = $_POST["novaSenha"];

    // Atualize a senha no banco de dados
    $usuario->atualizarSenha($userData["email"], $novaSenha);

    // Invalida o token, para que não possa ser usado novamente
    $usuario->invalidarToken($token);

    // Redirecione o usuário para a página de login
    navegate($_ENV['ROUTE'] . 'auth.login');

  } else {
    // Token inválido ou expirado, exiba uma mensagem de erro
    echo "Token inválido ou expirado.";
  }
}

