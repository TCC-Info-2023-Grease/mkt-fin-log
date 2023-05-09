<<<<<<< HEAD
<?php
# ------ Dados Iniciais
require '../../config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ------ Validar Envio de Dados
$campos_validos =  (
    valida_campo($_POST['email'])  && 
    valida_campo($_POST['password']) 
);
if (!$campos_validos) 
{
    navegate($_ENV['URL_VIEWS'] . '/auth/login.php?erro=campos_invalidos');
} 


# ----- Login 
$usuario = new Usuario($mysqli);
$dados = [ 
    'email' => $_POST['email'] , 
    'password' => $_POST['password'] 
];

if (!$usuario->login($dados['email'], $dados['password']))
{
    navegate($_ENV['URL_VIEWS']. '/auth/login.php?erro=usuario');
}

navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
=======
<?php
# ------ Dados Iniciais
require '../../config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ------ Validar Envio de Dados
$campos_validos =  (
    valida_campo($_POST['email'])  && 
    valida_campo($_POST['password']) 
);
if (!$campos_validos) 
{
    navegate($_ENV['URL_VIEWS'] . '/auth/login.php?erro=campos_invalidos');
} 


# ----- Login 
$usuario = new Usuario($mysqli);
$dados = [ 
    'email' => $_POST['email'] , 
    'password' => $_POST['password'] 
];

if (!$usuario->login($dados['email'], $dados['password']))
{
    navegate($_ENV['URL_VIEWS']. '/auth/login.php?erro=usuario');
}

navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
>>>>>>> 286a4901e05e7d84006a15f932d5b2227f5e0c7a
