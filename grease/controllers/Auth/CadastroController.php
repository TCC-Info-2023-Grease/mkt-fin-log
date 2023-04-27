<?php
# ------ Dados Iniciais
require '../../config.php';

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


# ----- Cadastros 
$usuario = new Usuario($mysqli);

if ($usuario->unico('email', $_POST['email'])) 
{
    navegate($_ENV['URL_VIEWS']. '/cadastrar.php?erro=usuario_existente');
}

# ----- Cadastro Visitante
$dados = [
    1,
    $_POST['username'],
    $_POST['email'],
    $_POST['password'],
    $_POST['phone'],
    $_POST['age'],
    $_POST['genrer'],
    "",
    ""
];

$usuario->cadastrar($dados);

if (!$usuario->login($dados['email'], $dados['password']))
{
    navegate($_ENV['URL_VIEWS']. '/cadastrar.php?erro=nao_cadastro');
}

navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
