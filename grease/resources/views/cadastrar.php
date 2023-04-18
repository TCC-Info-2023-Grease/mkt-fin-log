<?php
require dirname(dirname(__DIR__)). '/config.php';
global $_VARIAVEIS;
?>

<?php
require $_VARIAVEIS['PASTA_VIEWS'] . '/components/head.php';
?>
<title>
    Cadastrar 🤗 Grease
</title>

<body>
    <?php
    require $_VARIAVEIS['PASTA_VIEWS'] . '/components/header.php';
    ?>

        <form method="POST" action="
        <?php echo URL; ?>/CadastrarControlador.php'
        ">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>
            <br>
            <button type="submit">Entrar</button>
        </form>

    <?php
    require $_VARIAVEIS['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>