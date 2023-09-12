<?php  
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';
 
global $mysqli;
import_utils(['valida_campo', 'navegate', 'EnviarEmail']);

# ----- Resetar Senha
$usuario = new Usuario($mysqli);

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();


# Definir regras para cada requisição
if (valida_campo($_POST['email'] ?? null)) {
  $email = $_POST["email"];

  if ($usuario->existeEmail($email)) {
    $token = bin2hex(random_bytes(16)); // Gera um token aleatório
    $expiration = date("Y-m-d H:i:s", strtotime("+1 hour")); // Tempo de expiração (por exemplo, 1 hora a partir de agora)

    $usuario->salvarTokenNoBanco($email, $token, $expiration);

    // Envie um e-mail com o link de redefinição de senha
    EnviarEmail::redefinicaoSenha($email, $token);
    $_SESSION['fed_recuperar_senha'] = [
        'title' => 'OK!',
        'msg' => 'Email enviado!',
        'icon' => 'success'
    ];
    navegate($_ENV['ROUTE'] . 'auth.redefinir_senha');
  } else {
    $_SESSION['fed_recuperar_senha'] = [
        'title' => 'Erro!',
        'msg' => 'Campo Invalido',
        'icon' => 'error'
    ];
    navegate($_ENV['ROUTE'] . 'auth.esqueci_senha');
  }
}  


if (valida_campo($_GET["token"] ?? NULL) && valida_campo($_POST["novaSenha"] ?? NULL)) {
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

    $_SESSION['senha_redefinida'] = 'ok';
    // Redirecione o usuário para a página de login
    navegate($_ENV['ROUTE'] . 'auth.login');

  } else {
    // Token inválido ou expirado, exiba uma mensagem de erro
    $_SESSION['fed_recuperar_senha'] = [
        'title' => 'Erro!',
        'msg' => 'Token inválido ou expirado',
        'icon' => 'error'
    ];
    navegate($_ENV['ROUTE'] . 'auth.esqueci_senha');
  }
}

