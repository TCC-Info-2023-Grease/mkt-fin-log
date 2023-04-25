<?php

require dirname(dirname(dirname(__DIR__))) . '\config.php';
global $_ENV;   

?>

<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<title>
    Admin 🕺 Grease
</title>


<body>
    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/header.php';
    ?>
    
        <form method="POST" action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Materiais/CadastroController.php">
        <input type="text" class="text" name="fnome" placeholder="Corda de arame...">
        <label for="nome">Nome</label>
        <br>

        <input type="text" class="text" name="fdescricao" placeholder="Uma corda de arame preta...">
        <label for="descricao">Descrição</label>
        <br>

        <input type="number" class="text" name="fqtde_estimada" placeholder="5 unidades...">
        <label for="qtde_estimada">Quantidade estimada</label>
        <br>

        <input type="text" class="text" name="fvalor_estimado" placeholder="R$10.00">
        <label for="valor_estimado">Valor estimado</label>
        <br>

        <input type="text" class="text" name="fvalor_gasto" placeholder="R$50.00">
        <label for="valor_gasto">Valor gasto</label>
        <br>

        <input type="text" class="text" name="funidade_medida" placeholder="10 metros">
        <label for="unidade_medida">Unidade de medida em Metros</label>
        <br>

        <input type="number" class="text" name="festoque_minimo" placeholder="5 unidades">
        <label for="estoque_minimo">Estoque mínimo</label>
        <br>

        <input type="number" class="text" name="festoque_atual" placeholder="2 unidades">
        <label for="estoque_atual">Estoque atual</label>
        <br>

        <input type="text" class="text" name="fvalor_unitario" placeholder="R$15.00">
        <label for="valor_unitario">Valor unitário</label>
        <br>

        <input type="date" class="text" name="fdata_validade" placeholder="10/09/2024">
        <label for="data_validade">Data de validade</label>
        <br>

        <input type="file" class="text" name="ffoto_material">
        <label for="foto_material">Foto do material</label>
        <br>

        <input type="text" class="text" name="fstatus_material" placeholder="Status ok">
        <label for="status_material">Status do material</label>
        <br>

        <button class="signin login">
            Entrar
        </button>
        </form>

        <?php
        require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
        ?>
</body>


