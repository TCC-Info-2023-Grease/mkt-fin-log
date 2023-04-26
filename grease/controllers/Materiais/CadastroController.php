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

if (!$usuario->unico('nome', $dados['nome'])) 
{
    navegate($_ENV['URL_VIEWS']. '/admin/cadastrar_material
    
    .php?erro=usuario_existente');
}

$material->cadastrar($dados);

?>