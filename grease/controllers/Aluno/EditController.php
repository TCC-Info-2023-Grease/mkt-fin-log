<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';

global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ------ Validar Envio de Dados
$campos_validos = ($_GET['id'] ? true : false);
if (!$campos_validos) { 
  navegate($_ENV['ROUTE'] . 'admin.alunos.index'); 
} 

# ----- Editar aluno
try {
  $aluno = new Aluno($mysqli);
  $alunoData = $aluno->buscar($_GET['id']);

  if (!$alunoData) {
    $_SESSION['fed_aluno'] = [
      'title' => 'Erro!',
      'msg' => 'Aluno não encontrada.',
      'icon' => 'error'
    ];

    navegate($_ENV['ROUTE'] . 'admin.alunos.index');
  }

  $url = $_ENV['VIEWS'] . '/admin/alunos/edit.php';

  # Criar um formulário oculto com os dados da aluno
  $form = '<form id="alunoForm" action="' . $url . '" method="POST">';
  foreach ($alunoData as $key => $value) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
  }
  $form .= '</form>'; 

  # Script JavaScript para submeter o formulário automaticamente
  $script = '
  <script>
    window.onload = function() {
      document.getElementById("alunoForm").submit();
    }
  </script>';

  # Exibir o formulário e o script
  echo $form . $script;
} catch (Exception $e) {
  $_SESSION['fed_aluno'] = [
    'title' => 'Erro!',
    'msg' => 'Ocorreu um erro ao editar a aluno.',
    'icon' => 'error'
  ];

  navegate($_ENV['ROUTE'] . 'admin.alunos.index'); 
}
?>
