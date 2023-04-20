<?php
# ------ Dados Iniciais
require '../config.php';
require '../database/db.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ------ Validar Envio de Dados
$campos_validos =  (
    valida_campo($_POST['username'])  && 
    valida_campo($_POST['password']) 
);
if (!$campos_validos) 
{
    navegate($_ENV['URL_VIEWS'] . '/cadastrar.php?erro=campos_invalidos');
} 


# ----- Login 

$usuario = new Usuario($mysqli);
$dados = [ 
    'email' => $_POST['email'] , 
    'password' => $_POST['password'] 
];

if (!$usuario->login($dados['email'], $dados['password']))
{
    navegate($_ENV['URL_VIEWS']. '/cadastrar.php?erro=erro_usuario');
}

navegate($_ENV['URL_VIEWS']. '/.php');
