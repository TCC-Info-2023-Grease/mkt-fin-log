<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);


# ----- Cadastro Visitante
$material = new Material($mysqli);

$tipo_dados = "ssiiidiidssss";
$dados = [
    $_POST['nome'],
    $_POST['descricao'],
    $_POST['qtde_estimada'],
    $_POST['valor_estimado'],
    $_POST['valor_gasto'],
    $_POST['unidade_medida'],
    $_POST['estoque_minimo'],
    $_POST['estoque_atual'],
    $_POST['valor_unitario'],
    date("Y-m-d H:i:s"),
    $_POST['data_validade'],
    $_POST['foto_material'],
    $_POST['status_material']
];

$material->cadastrar($tipo_dados, $dados);

?>