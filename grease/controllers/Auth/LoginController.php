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
  navegate($_ENV['VIEWS'] . '/auth/login.php?erro=campos_invalidos');
} 

# ----- Login 
$usuario = new Usuario($mysqli);
$dados = [ 
  'email' => $_POST['email'] , 
  'password' => md5($_POST['password']) 
];

if (!$usuarioData = $usuario->login($dados['email'], $dados['password']))
{
  navegate($_ENV['VIEWS']. '/auth/login.php?erro=usuario');
}

$_SESSION['usuario'] = $usuarioData;

  if ($_SESSION['usuario']['tipo_usuario'] == 'adm') 
{
  navegate($_ENV['VIEWS']. '/admin/dashboard.php');
} 
  else if ($_SESSION['usuario']['tipo_usuario'] == 'vis') 
{
  navegate($_ENV['VIEWS']. '/visitante/home.php');
} 
  else 
{
  navegate($_ENV['VIEWS']. '/servico/home.php');
}

