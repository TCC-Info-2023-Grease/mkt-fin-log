<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component']);
?>

<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<title>
    Admin 🕺 Grease
</title>

 Categoria dos Materiais