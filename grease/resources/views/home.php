<?php
require dirname(dirname(__DIR__)). '/config.php';
global $_VARIAVEIS;
?>

<?php
require $_VARIAVEIS['PASTA_VIEWS'] . '/components/head.php';
?>
<title>
    Welcome 🕺 Grease
</title>

<body>
    <?php
    require $_VARIAVEIS['PASTA_VIEWS'] . '/components/header.php';
    ?>

        

    <?php
    require $_VARIAVEIS['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>