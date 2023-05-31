<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ------ Validar Envio de Dados
$campos_validos = ($_GET['id'] ? true : false);
if (!$campos_validos) { 
  navegate($_ENV['ROUTE'] . 'admin.material.index');
} 

# ----- Editar Material
$material = new Material($mysqli);
$materialData = $material->buscar($_GET['id']);
//print_r($materialData);

$url = $_ENV['URL_VIEWS'] . '/admin/material/edit.php';

# Criar um formulário oculto com os dados do material
$form = '<form id="materialForm" action="' . $url . '" method="POST">';
foreach ($materialData as $key => $value) {
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
