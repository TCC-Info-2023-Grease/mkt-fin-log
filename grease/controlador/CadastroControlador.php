<?php
# ------ Dados Iniciais
require '../config.php';
require '../database/db.php';

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


# ----- Cadastro 

$usuario = new Usuario($mysqli);

if ($usuario->unico('email', $_POST['email'])) 
{
    navegate($_ENV['URL_VIEWS']. '/cadastrar.php?erro=erro_usuario');
}

$usuario->cadastrar_visitante([
    'username' => $_POST['username'],
    'email'    => $_POST['email'],
    'password' => $_POST['password'],
    'phone'    => $_POST['phone'],
    'age'      => $_POST['age'],
    'genrer'   => $_POST['genrer']
]);

navegate($_ENV['URL_VIEWS']. '/home.php');
