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
  navegate($_ENV['ROUTE'] . 'admin.material.index');
} 


# ----- Deletar Material
$material = new Material($mysqli);
print_r($material->buscar($_GET['id']));
$material = $material->buscar($_GET['id']);

// Requisição 
$dados_query = http_build_query($dados);

$url_destino = 'outra_pagina.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dados_query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLexec($ch));

$resposta = curl_exec($ch);

echo $resposta;

curl_close($ch);

?>