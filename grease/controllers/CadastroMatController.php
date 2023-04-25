<?php

$conn = new mysqli("localhost", "root", "", "cx_tcc");

if ($conn -> connect_error){
    echo "Erro: " . $conn -> connect_error;
}
else{
    echo "Banco de dados CONECTADO!";
}

$stmt = $conn -> prepare("INSERT INTO Materiais(nome,descricao,qtde_estimada,valor_estimado,valor_gasto, unidade_medida, estoque_minimo, estoque_atual,valor_unitario, datahora_cadastro, data_validade, foto_material, status_material) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");

$stmt -> bind_param("ssiiidiidssss", $nome, $descricao, $qtde_estimada, $valor_estimado, $valor_gasto, $unidade_medida, $estoque_minimo, $estoque_atual, $valor_unitario, $datahora_cadastro, $data_validade, $foto_material, $status_material);



$nome = $_POST[''];
$descricao = $_POST[''];
$qtde_estimada = $_POST[''];
$valor_estimado = $_POST[''];
$valor_gasto = $_POST[''];
$unidade_medida = $_POST['']; 
$estoque_minimo = $_POST[''];
$estoque_atual = $_POST[''];
$valor_unitario = $_POST[''];
$datahora_cadastro = $_POST[''];
$data_validade = $_POST[''];
$foto_material = $_POST[''];
$data_validade = $_POST[''];
$status_material = $_POST[''];




