<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';

global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ------ Validar Envio de Dados
$campos_validos = (
    $_GET['id'] ? true : false
);
if (!$campos_validos) {
    navegate($_ENV['ROUTE'] . 'admin.usuario.index');
}

# ----- Deletar Usuário
try {
    $usuario = new Usuario($mysqli);
    $usuario->deletar($_GET['id']);
} catch (Exception $e) {
    $_SESSION['fed_usuario'] = [
        'title' => 'Erro!',
        'msg' => 'Não é possível excluir este usuário',
        'icon' => 'error'
    ];
}

navegate($_ENV['ROUTE'] . 'admin.usuario.index');
?>
