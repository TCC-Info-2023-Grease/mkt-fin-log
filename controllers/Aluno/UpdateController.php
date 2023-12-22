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
    $_SESSION['fed_aluno'] = [
        'title' => 'Erro!',
        'msg' => 'Campos Inválidos',
        'icon' => 'error'
    ];
    navegate($_ENV['ROUTE'] . 'admin.alunos.index'); 
}

# ------ Atualizar aluno
$aluno = new Aluno($mysqli);

$dados = [
  'id'   => $_POST['id'],
  'nome' => $_POST['nome']
];

try {
    $aluno->atualizar($dados); 
    $_SESSION['fed_aluno'] = [
        'title' => 'Sucesso!',
        'msg' => 'Atualizado com sucesso',
        'icon' => 'success'
    ];
} catch (Exception $e) {
    $_SESSION['fed_aluno'] = [
        'title' => 'Erro!',
        'msg' => 'Erro ao atualizar',
        'icon' => 'error'
    ];
}

navegate($_ENV['ROUTE'] . 'admin.alunos.index'); 
?>
