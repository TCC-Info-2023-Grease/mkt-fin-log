<?php
# ------ Dados Iniciais
require '../config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ------ Validar Envio de Dados
$campos_validos =  (
    valida_campo($_POST['username'])  && 
    valida_campo($_POST['password']) && 
    valida_campo($_POST['phone'])    &&
    valida_campo($_POST['age'])      &&
    valida_campo($_POST['genrer'])
);
if (!$campos_validos) 
{
    navegate($_ENV['URL_VIEWS'] . '/cadastrar.php?erro=campos_invalidos');
} 


# ----- Cadastro Visitante
$usuario = new Usuario($mysqli);

if ($usuario->unico('email', $_POST['email'])) 
{
    navegate($_ENV['URL_VIEWS']. '/cadastrar.php?erro=erro_usuario');
}

$dados = [
    'tipo_usuario' => 1,
    'username'     => $_POST['username'],
    'email'        => $_POST['email'],
    'password'     => $_POST['password'],
    'phone'        => $_POST['phone'],
    'age'          => $_POST['age'],
    'genrer'       => $_POST['genrer']
];

$usuario->cadastrar_visitante($dados);

if (!$usuario->login($dados['email'], $dados['password']))
{
    navegate($_ENV['URL_VIEWS']. '/login.php?erro=usuario');
}

navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
