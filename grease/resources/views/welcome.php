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

        Welcome to the Grease

        <a href="<?php echo $_ENV['URL_ROUTE'] ?>auth.cadastrar">
            Cadastrar
        </a>
        |   
        <a href="<?php echo $_ENV['URL_ROUTE'] ?>auth.login">
            Login
        </a>

    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>