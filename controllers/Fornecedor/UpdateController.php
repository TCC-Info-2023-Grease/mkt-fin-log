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
    $_SESSION['fed_fornecedor'] = [
        'title' => 'Erro!',
        'msg' => 'Campos Inválidos',
        'icon' => 'error'
    ];
    navegate($_ENV['ROUTE'] . 'admin.fornecedor.index'); 
}

# ------ Atualizar 
$fornecedor = new Fornecedor($mysqli);

$dados = [
   'fornecedor_id'        => $_POST['fornecedor_id'],
   'nome_fornecedor'      => $_POST['nome'],
   'cnpj'                 => $_POST['cnpj'],
   'ender'                => $_POST['ender'],
   'email_fornecedor'     => $_POST['email'],
   'celular'              => $_POST['celular'],
   'descricao_fornecedor' => $_POST['descricao'],
   'status_fornecedor'    => $_POST['status_fornecedor']
];

try {
    $fornecedor->atualizar($dados); 
    $_SESSION['fed_fornecedor'] = [
        'title' => 'Sucesso!',
        'msg' => 'Atualizado com sucesso',
        'icon' => 'success'
    ];
} catch (Exception $e) {
    $_SESSION['fed_fornecedor'] = [
        'title' => 'Erro!',
        'msg' => 'Erro ao atualizar',
        'icon' => 'error'
    ];
}

navegate($_ENV['ROUTE'] . 'admin.fornecedor.index'); 
?>
