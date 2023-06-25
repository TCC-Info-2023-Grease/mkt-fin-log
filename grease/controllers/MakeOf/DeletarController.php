<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ------ Validar Envio de Dados
$campos_validos = (
    $_GET['id'] ? true : false
);	
if (!$campos_validos)
{ 
  navegate($_ENV['ROUTE'] . 'admin.makeof.index');
} 


# ----- Deletar Material
$makeOf = new MakeOf($mysqli);
$makeOf->deletar($_GET['id']);

navegate($_ENV['ROUTE'] . 'admin.makeof.index');
