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
  navegate($_ENV['ROUTE'] . 'admin.conta.index'); 
} 

# ----- Editar 
try {
  $conta = new Conta($mysqli);
  $contaData = $conta->buscar($_GET['id']);

  if (!$contaData) {
    $_SESSION['fed_conta'] = [
      'title' => 'Erro!',
      'msg' => 'Conta não encontrada.',
      'icon' => 'error'
    ];

    navegate($_ENV['ROUTE'] . 'admin.conta.index');
  }

  $url = $_ENV['VIEWS'] . '/admin/conta/edit.php';

  # Criar um formulário oculto com os dados da fornecedor
  $form = '<form id="contaForm" action="' . $url . '" method="POST">';
  foreach ($contaData as $key => $value) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
  }
  $form .= '</form>'; 

  # Script JavaScript para submeter o formulário automaticamente
  $script = '
  <script>
    window.onload = function() {
      document.getElementById("contaForm").submit();
    }
  </script>';

  # Exibir o formulário e o script
  echo $form . $script;
} catch (Exception $e) {
  $_SESSION['fed_conta'] = [
    'title' => 'Erro!',
    'msg' => 'Ocorreu um erro ao editar.',
    'icon' => 'error'
  ];

  navegate($_ENV['ROUTE'] . 'admin.conta.index'); 
}
?>
