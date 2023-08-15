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

# ----- Show
$sala = new Sala($mysqli);
$salaData = $sala->buscar($_GET['id']); // Certifique-se de que o método buscar() está implementado na classe Sala
//print_r($salaData);

$url = $_ENV['VIEWS'] . '/admin/sala/show.php'; // Certifique-se de ajustar o caminho correto

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
?>
