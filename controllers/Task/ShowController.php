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

# ----- Show
$task = new Task($mysqli);
$taskData = $task->buscar($_GET['id']); 

//var_dump($taskData);

$url = $_ENV['VIEWS'] . '/admin/task/show.php'; 

# Criar um formulário oculto com os dados 
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
?>
