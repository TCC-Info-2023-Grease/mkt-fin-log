<<<<<<< HEAD
<?php
# ------ Dados Iniciais
require '../../config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

// Atualiza a variável de sessão com a data e hora do último acesso
$_SESSION['ultimo_acesso'] = time();

# ------ Validar Envio de Dados
$campos_validos =  (
    valida_campo($_POST['username'])  && 
    valida_campo($_POST['password']) && 
    valida_campo($_POST['phone'])    
);
if (!$campos_validos) 
{
    $_SESSION['fed_cadastro_usuario'] = [ 
        'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
    ];
    navegate($_ENV['URL_VIEWS'] . '/auth/cadastrar.php');
} 


# ----- Cadastros 
$usuario = new Usuario($mysqli);

if ($usuario->unico('email', $_POST['email'])) 
{
    $_SESSION['fed_cadastro_usuario'] = [ 
        'title' => 'Erro!', 'msg' => 'Usuario Existente' 
    ];
    navegate($_ENV['URL_VIEWS']. '/auth/cadastrar.php');
}

# ----- Cadastro Visitante
$dados = [
    'tipo_usuario' => $_POST['tipo_usuario'],
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'password' => $_POST['password'], # password_hash($_POST['password'], PASSWORD_DEFAULT),
    'age' => intval($_POST['age']),
    'genrer' => $_POST['genrer'],
    'cell' => $_POST['phone'],
    'cpf' => $_POST['cpf'],
    'profile_picture' => $_POST['profile_picture']
];

print_r($dados);
$usuario->cadastrar($dados);


if (!$usuario->login($dados['email'], $dados['password']))
{
    $_SESSION['fed_cadastro_usuario'] = [ 
        'title' => 'Erro!', 'msg' => 'Usuario não cadastrado' 
    ];
    navegate($_ENV['URL_VIEWS']. '/auth/cadastrar.php');
}

$_SESSION['usuario'] = $usuario->buscar($dados['email']);
navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
=======
<?php
# ------ Dados Iniciais
require '../../config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

// Atualiza a variável de sessão com a data e hora do último acesso
$_SESSION['ultimo_acesso'] = time();

# ------ Validar Envio de Dados
$campos_validos =  (
    valida_campo($_POST['username'])  && 
    valida_campo($_POST['password']) && 
    valida_campo($_POST['phone'])    
);
if (!$campos_validos) 
{
    $_SESSION['fed_cadastro_usuario'] = [ 
        'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
    ];
    navegate($_ENV['URL_VIEWS'] . '/auth/cadastrar.php');
} 


# ----- Cadastros 
$usuario = new Usuario($mysqli);

if ($usuario->unico('email', $_POST['email'])) 
{
    $_SESSION['fed_cadastro_usuario'] = [ 
        'title' => 'Erro!', 'msg' => 'Usuario Existente' 
    ];
    navegate($_ENV['URL_VIEWS']. '/auth/cadastrar.php');
}

# ----- Cadastro Visitante
$dados = [
    'tipo_usuario' => $_POST['tipo_usuario'],
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'password' =>  password_hash($_POST['password'], PASSWORD_DEFAULT),
    'age' => intval($_POST['age']),
    'genrer' => $_POST['genrer'],
    'cell' => $_POST['phone'],
    'cpf' => $_POST['cpf'],
    'profile_picture' => $_POST['profile_picture']
];

print_r($dados);
$usuario->cadastrar($dados);


if (!$usuario->login($dados['email'], $dados['password']))
{
    $_SESSION['fed_cadastro_usuario'] = [ 
        'title' => 'Erro!', 'msg' => 'Usuario não cadastrado' 
    ];
    navegate($_ENV['URL_VIEWS']. '/auth/cadastrar.php');
}

$_SESSION['usuario'] = $usuario->buscar($dados['email']);
if ($dados['tipo_usuario'] == 'adm') {
    navegate($_ENV['URL_VIEWS']. '/admin/home.php');
} else if ($dados['tipo_usuario'] == 'vis') {
    navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
} else {
    navegate($_ENV['URL_VIEWS']. '/servico/home.php');
}

>>>>>>> 286a4901e05e7d84006a15f932d5b2227f5e0c7a
