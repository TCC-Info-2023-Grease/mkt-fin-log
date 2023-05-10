<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component']);
?>


<!------- HEAD --------->
<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<title>
    Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/header.php';
    ?>

	 <form 
		method="POST" 
		action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/CategoriaMaterial/CadastroController.php">
		<label for="nome">Nome</label>
		<input type="text" class="text" name="nome" placeholder="Corda de arame...">
		<br>
			
		<button class="signin login">
			Inserir
		</button>
	</form>

    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>
<!------- /BODY --------->