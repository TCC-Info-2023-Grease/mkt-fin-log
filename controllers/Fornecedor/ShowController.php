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
    navegate($_ENV['ROUTE'] . 'admin.fornecedor.index');
}

# ----- Show
$fornecedor = new Fornecedor($mysqli);
$fornecedorData = $fornecedor->buscar($_GET['id']); 

//var_dump($fornecedorData);

$url = $_ENV['VIEWS'] . '/admin/fornecedor/show.php'; 

# Criar um formulário oculto com os dados 
$form = '<form id="fornecedorForm" action="' . $url . '" method="POST">';
foreach ($fornecedorData as $key => $value) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
}
$form .= '</form>';

# Script JavaScript para submeter o formulário automaticamente
$script = '
<script>
  window.onload = function() {
    document.getElementById("fornecedorForm").submit();
  }
</script>';

# Exibir o formulário e o script
echo $form . $script;
?>
