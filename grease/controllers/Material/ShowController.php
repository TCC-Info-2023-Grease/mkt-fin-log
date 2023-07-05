<?php
# ------ Configurações Básicas
require dirname(dirname(__DIR__)) . '\config.php';
import_utils(['extend_styles', 'render_component']);

# ----- Consulta 
$material = new Material($mysqli);
$data = $material->buscar($_GET['id']);

$url = $_ENV['VIEWS'] . '/admin/material/show.php';

# Criar um formulário oculto com os dados do material
$form = '<form id="materialForm" action="' . $url . '" method="POST">';
foreach ($data as $key => $value) {
  $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}
$form .= '</form>'; 

# Script JavaScript para submeter o formulário automaticamente
$script = '
<script>
  window.onload = function() {
    document.getElementById("materialForm").submit();
  }
</script>';

# Exibir o formulário e o script
echo $form . $script;
?>