<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';

global $mysqli;

import_utils(['Auth']);
Auth::check('adm');

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
    $_POST['fornecedor_id'] ? true : false
);
if (!$campos_validos) {
    $_SESSION['fed_conta'] = [
        'title' => 'Erro!',
        'msg' => 'Campos Inválidos',
        'icon' => 'error'
    ];
    navegate($_ENV['ROUTE'] . 'admin.conta.index');
}

# ------ Atualizar 
$conta = new Conta($mysqli);

$dados = [
    'conta_id' => $_POST['conta_id'],
    'fornecedor_id' => $_POST['fornecedor_id'],
    'usuario_id' => $_POST['usuario_id'],
    'titulo' => $_POST['titulo'],
    'descricao' => $_POST['descricao'],
    'valor' => $_POST['valor'],
    'data_validade' => $_POST['data_validade']
];

try {
    $conta->atualizar($dados);
    $_SESSION['fed_conta'] = [
        'title' => 'Sucesso!',
        'msg' => 'Atualizado com sucesso',
        'icon' => 'success'
    ];
} catch (Exception $e) {
    $_SESSION['fed_conta'] = [
        'title' => 'Erro!',
        'msg' => 'Erro ao atualizar',
        'icon' => 'error'
    ];
}

navegate($_ENV['ROUTE'] . 'admin.conta.index');
?>