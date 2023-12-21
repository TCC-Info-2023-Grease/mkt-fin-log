<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '/config.php';

global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ------ Validar Envio de Dados
$campos_validos = ($_GET['id'] ? true : false);
if (!$campos_validos) { 
  navegate($_ENV['ROUTE'] . 'admin.sala.index'); // Certifique-se de ajustar o redirecionamento
} 

# ----- Editar Sala
try {
  $sala = new Sala($mysqli);
  $salaData = $sala->buscar($_GET['id']); // Certifique-se de que o método buscarPorID() existe na classe Sala
  if (!$salaData) {
      $_SESSION['fed_sala'] = [
          'title' => 'Erro!',
          'msg' => 'Sala não encontrada.',
          'icon' => 'error'
      ];
      navegate($_ENV['ROUTE'] . 'admin.sala.index'); // Certifique-se de ajustar o redirecionamento
  }

  $url = $_ENV['VIEWS'] . '/admin/sala/edit.php'; // Certifique-se de ajustar o caminho correto para a view de edição

  # Criar um formulário oculto com os dados da sala
  $form = '<form id="salaForm" action="' . $url . '" method="POST">';
  foreach ($salaData as $key => $value) {
      $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
  }
  $form .= '</form>'; 

  # Script JavaScript para submeter o formulário automaticamente
  $script = '
  <script>
    window.onload = function() {
      document.getElementById("salaForm").submit();
    }
  </script>';

  # Exibir o formulário e o script
  echo $form . $script;
} catch (Exception $e) {
  $_SESSION['fed_sala'] = [
      'title' => 'Erro!',
      'msg' => 'Ocorreu um erro ao editar a sala.',
      'icon' => 'error'
  ];
  navegate($_ENV['ROUTE'] . 'admin.sala.index'); // Certifique-se de ajustar o redirecionamento
}
?>
