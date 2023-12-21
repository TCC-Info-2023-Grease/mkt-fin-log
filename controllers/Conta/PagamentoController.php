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
  
# ----- Show
$conta = new Conta($mysqli);
$contaData = $conta->buscar($_GET['id']); 

//var_dump($contaData);

$url = $_ENV['VIEWS'] . '/admin/conta/pagamento.php'; 

# Criar um formulário oculto com os dados 
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
?>
