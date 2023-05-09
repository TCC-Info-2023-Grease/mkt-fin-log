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
  
    <a href="<?php echo $_ENV['ROUTE'] ?>adm.categoria_material.create">
		Cadastrar Categoria Material
	</a>
	<a href="<?php echo $_ENV['ROUTE'] ?>adm.material.create">
		Cadastar Material
	</a>


    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>
<!------- /BODY --------->
