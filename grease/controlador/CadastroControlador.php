<?php
require '../config.php';
require '../database/db.php';

global $mysqli;

import_utils([ 'valida_campo' ]);

$campos_validos =  
    valida_campo($_POST['username'])  && 
    valida_campo($_POST['password']) && 
    valida_campo($_POST['phone'])    &&
    valida_campo($_POST['age'])      &&
    valida_campo($_POST['genrer'])
;

if (!$campos_validos) 
{
    header('Location: ' . $_ENV['URL_VIEWS'] . '/cadastrar.php?erro=campos_invalidos');
} 

$usuario = new Usuario($mysqli);

if (!$usuario->unico('email', $_POST['email'])) 
{
    header('Location: '. $_ENV['URL_VIEWS']. '/cadastrar.php?erro=erro_usuario');
}