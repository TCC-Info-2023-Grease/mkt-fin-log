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
  navegate($_ENV['ROUTE'] . 'admin.sprint.index'); 
} 

# ----- Editar 
try {
  $sprint = new Sprint($mysqli);
  $sprintData = $sprint->buscar($_GET['id']);

  if (!$sprintData) {
    $_SESSION['fed_sprint'] = [
      'title' => 'Erro!',
      'msg' => 'Sprint não encontrada.',
      'icon' => 'error'
    ];

    navegate($_ENV['ROUTE'] . 'admin.sprint.index');
  }

  $url = $_ENV['VIEWS'] . '/admin/sprint/edit.php';

  # Criar um formulário oculto com os dados da fornecedor
  $form = '<form id="sprintForm" action="' . $url . '" method="POST">';
  foreach ($sprintData as $key => $value) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
  }
  $form .= '</form>'; 

  # Script JavaScript para submeter o formulário automaticamente
  $script = '
  <script>
    window.onload = function() {
      document.getElementById("sprintForm").submit();
    }
  </script>';

  # Exibir o formulário e o script
  echo $form . $script;
} catch (Exception $e) {
  $_SESSION['fed_sprint'] = [
    'title' => 'Erro!',
    'msg' => 'Ocorreu um erro ao editar.',
    'icon' => 'error'
  ];

  navegate($_ENV['ROUTE'] . 'admin.sprint.index'); 
}
?>