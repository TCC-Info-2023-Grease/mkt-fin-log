<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ----- Cadastro Material
$material = new Material($mysqli);

$dados = [
    $_POST['nome'],
    $_POST['descricao'],
    intval($_POST['qtde_estimada']),
    floatval($_POST['valor_estimado']),
    floatval($_POST['valor_gasto']),
    floatval($_POST['unidade_medida']),
    intval($_POST['estoque_minimo']),
    intval($_POST['estoque_atual']),
    intval($_POST['valor_unitario']),
    date("Y-m-d H:i:s"),
    $_POST['data_validade'],
    $_POST['foto_material'],
    $_POST['status_material']
];

$material->cadastrar($dados);

?>