<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

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
  'password' => md5($_POST['password']) 
];

if (!$usuario->login($dados['email'], $dados['password']))
{
  navegate($_ENV['URL_VIEWS']. '/auth/login.php?erro=usuario');
}

if ($_SESSION['usuario']['tipo_usuario'] == 'adm') 
{
  navegate($_ENV['URL_VIEWS']. '/admin/home.php');
} else if ($_SESSION['usuario']['tipo_usuario'] == 'vis') 
{
  navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
} else 
{
  navegate($_ENV['URL_VIEWS']. '/servico/home.php');
}

