<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

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
$campos_validos = (
    $_GET['id'] ? true : false
);	
if (!$campos_validos)
{ 
  navegate($_ENV['ROUTE'] . 'admin.material.index');
} 


# ----- Cadastro Material
$material = new Material($mysqli);
$material->deletar($_GET['id']);

navegate($_ENV['ROUTE'] . 'admin.material.index');
