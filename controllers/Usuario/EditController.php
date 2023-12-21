<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils(['valida_campo', 'navegate']);

# ------ Validar Envio de Dados
$campos_validos = ($_GET['id'] ? true : false);
if (!$campos_validos) { 
  navegate($_ENV['ROUTE'] . 'admin.usuario.index');
} 

# ----- Editar Material
$material = new Usuario($mysqli); 
$materialData = $material->buscarPorID($_GET['id']);
//print_r($materialData);

$url = $_ENV['VIEWS'] . '/admin/usuarios/edit.php';

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
