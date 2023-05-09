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

 <form 
	method="POST" 
	action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Categoria/CadastroController.php">
	<input type="text" class="text" name="nome" placeholder="Corda de arame...">
	<label for="nome">Nome</label>
	<br>
		
	<button class="signin login">
		Entrar
	</button>
</form>