<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['auth', 'navegate', 'extend_styles', 'render_component']);

Auth::check('adm');
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['styles']);
?>
<title>
    Admin 🕺 Grease
</title>
<!------- /HEAD --------->


<!------- BODY --------->
<body>
    <?php
    render_component('header');
    ?>

        Welcome to the Grease


		
	

    <?php
    render_component('footer');
    ?>
</body>
<!------- /BODY --------->
