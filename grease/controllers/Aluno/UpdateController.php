<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';

global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ------ Verificar Sessão
if (isset($_SESSION['ultimo_acesso'])) {
    $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
    $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();

# ------ Validar Envio de Dados
$campos_validos = (
    $_POST['id'] ? true : false
);
if (!$campos_validos) {
    $_SESSION['fed_sala'] = [
        'title' => 'Erro!',
        'msg' => 'Campos Inválidos',
        'icon' => 'error'
    ];
    navegate($_ENV['ROUTE'] . 'admin.sala.index'); 
}

# ------ Atualizar Sala
$sala = new Sala($mysqli);

$dados = [
  'id'                => $_POST['id'],
  'usuario_id'        => $_POST['usuario_id'],
  'aluno_id'          => $_POST['aluno_escolhido'],
  'categoria'         => $_POST['categoria_escolhida'],
  'descricao'         => $_POST['descricao'],
  'data_movimentacao' => $_POST['data_movimentacao'],
  'valor'             => floatval($_POST['valor']),
  'tipo_movimentacao' => $_POST['tipo_movimentacao'],
  'forma_pagamento'   => $_POST['forma_pagamento'],
  'obs'               => $_POST['obs']
];

try {
    $sala->atualizar($dados); 
    $_SESSION['fed_sala'] = [
        'title' => 'Sucesso!',
        'msg' => 'Atualizado com sucesso',
        'icon' => 'success'
    ];
} catch (Exception $e) {
    $_SESSION['fed_sala'] = [
        'title' => 'Erro!',
        'msg' => 'Erro ao atualizar',
        'icon' => 'error'
    ];
}

navegate($_ENV['ROUTE'] . 'admin.sala.index'); 
?>
