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
    navegate($_ENV['ROUTE'] . 'admin.alunos.index'); 
}

# ----- Deletar 
try {
    $aluno = new Aluno($mysqli);
    $deletado = $aluno->deletar($_GET['id']); 

    if ($deletado) {
        $_SESSION['fed_aluno'] = [
            'title' => 'Sucesso!',
            'msg' => 'Excluído com sucesso.',
            'icon' => 'success'
        ];
    } else {
        $_SESSION['fed_aluno'] = [
            'title' => 'Erro!',
            'msg' => 'Não é possível excluir.',
            'icon' => 'error'
        ];
    }
} catch (Exception $e) {
    $_SESSION['fed_aluno'] = [
        'title' => 'Erro!',
        'msg' => 'Ocorreu um erro ao excluir',
        'icon' => 'error'
    ];
}

navegate($_ENV['ROUTE'] . 'admin.alunos.index'); 
?>
