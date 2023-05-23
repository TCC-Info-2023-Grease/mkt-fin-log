<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
import_utils(['extend_styles', 'render_component']);

# ----- Consulta Caixa
$caixa = new Caixa($mysqli);

$data = $caixa->buscar($_GET['id']);

print_r($data);
 	
global $_ENV;   
?>