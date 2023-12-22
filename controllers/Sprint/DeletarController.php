<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';

global $mysqli;

import_utils(['Auth']);

Auth::check('adm');

import_utils(['valida_campo', 'navegate']);

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();

# ------ Validar Envio de Dados
$campos_validos = (
    $_GET['id'] ? true : false
);
if (!$campos_validos) {
    navegate($_ENV['ROUTE'] . 'admin.sprint.index'); 
}


# ----- Deletar 
try {
    $sprint = new Sprint($mysqli);
    $deletado = $sprint->concluirSprint($_GET['id']); 
    //ChamaSamu::debug($deletado);

    if ($deletado) {
        $_SESSION['fed_sprint'] = [
            'title' => 'Sucesso!',
            'msg' => 'Excluído com sucesso.',
            'icon' => 'success'
        ];
    } else {
        $_SESSION['fed_sprint'] = [
            'title' => 'Erro!',
            'msg' => 'Não é possível excluir.',
            'icon' => 'error'
        ];
    }
} catch (Exception $e) {
    //ChamaSamu::debug($e);

    $_SESSION['fed_sprint'] = [
        'title' => 'Erro!',
        'msg' => 'Ocorreu um erro ao excluir',
        'icon' => 'error'
    ];
}

navegate($_ENV['ROUTE'] . 'admin.sprint.index'); 
