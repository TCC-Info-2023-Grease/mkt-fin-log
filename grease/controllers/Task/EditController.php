<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';

global $mysqli;

import_utils(['Auth']);

Auth::check('adm');

import_utils(['valida_campo', 'navegate']);

# ------ Validar Envio de Dados
$campos_validos = ($_GET['id'] ? true : false);
if (!$campos_validos) { 
  navegate($_ENV['ROUTE'] . 'admin.task.index'); 
} 

# ----- Editar 
try {
  $task = new Task($mysqli);
  $taskData = $task->buscar($_GET['id']);

  if (!$taskData) {
    $_SESSION['fed_task'] = [
      'title' => 'Erro!',
      'msg' => 'Task não encontrada.',
      'icon' => 'error'
    ];

    navegate($_ENV['ROUTE'] . 'admin.task.index');
  }

  $url = $_ENV['VIEWS'] . '/admin/task/edit.php';

  # Criar um formulário oculto com os dados da fornecedor
  $form = '<form id="taskForm" action="' . $url . '" method="POST">';
  foreach ($taskData as $key => $value) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
  }
  $form .= '</form>'; 

  # Script JavaScript para submeter o formulário automaticamente
  $script = '
  <script>
    window.onload = function() {
      document.getElementById("taskForm").submit();
    }
  </script>';

  # Exibir o formulário e o script
  echo $form . $script;
} catch (Exception $e) {
  $_SESSION['fed_task'] = [
    'title' => 'Erro!',
    'msg' => 'Ocorreu um erro ao editar.',
    'icon' => 'error'
  ];

  navegate($_ENV['ROUTE'] . 'admin.task.index'); 
}
?>
