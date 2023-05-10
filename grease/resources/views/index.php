<?php
# ------ Configurações Básicas
require dirname(dirname(__DIR__)) . '/config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component']);
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['styles']);
?>

<title>
Welcome 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/header.php';
    ?>

    d

    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>
<!------- /BODY --------->
