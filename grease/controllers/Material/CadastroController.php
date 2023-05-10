<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ----- Cadastro Material
$material = new Material($mysqli);

$dados = [
    'nome' => $_POST['nome'],
    'categoria_id'      => $_POST['categoria'],
    'descricao'         => $_POST['descricao'],
    'qtde_estimada'     => $_POST['qtde_estimada'],
    'valor_estimado'    => $_POST['valor_estimado'],
    'valor_gasto'       => $_POST['valor_gasto'],
    'unidade_medida'    => $_POST['unidade_medida'],
    'estoque_minimo'    => $_POST['estoque_minimo'],
    'estoque_atual'     => $_POST['estoque_atual'],
    'valor_unitario'    => $_POST['valor_unitario'],
    'datahora_cadastro' => date("Y-m-d H:i:s"),
    'data_validade'     => $_POST['data_validade'],
    'foto_material'     => $_POST['foto_material'],
    'status_material'   => $_POST['status_material']
];

print_r($dados);
$material->cadastrar($dados);

?>