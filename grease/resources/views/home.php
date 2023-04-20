<?php
require dirname(dirname(__DIR__)). '/config.php';
global $_ENV;
?>

<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<title>
    Welcome 🕺 Grease
</title>

<body>
    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/header.php';
    ?>

        <a href="<?php echo $_ENV['URL_ROUTE'] ?>cadastrar">
            Cadastrar
        </a>

    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>