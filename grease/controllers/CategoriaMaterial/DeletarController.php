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
  navegate($_ENV['ROUTE'] . 'admin.categoria_material.index');
} 


# ----- Deletar Material
try {
  $categoria = new CategoriaMaterial($mysqli);
  $categoria->deletar($_GET['id']);
} catch (Exception $e) {
  $_SESSION['fed_categoria_material'] = [ 
    'title' => 'OK!', 'msg' => 'Não é possível excluir esse categoria', 'icon' => 'error'
  ];
}

navegate($_ENV['ROUTE'] . 'admin.categoria_material.index');
