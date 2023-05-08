<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['navegate', 'extend_styles', 'render_component']);
/*
if (!isset($session['usuario'])) 
{
    navegate($_ENV['URL_VIEWS']. '/auth/login.php');
} else if ($session['usuario']['tipo_usuario'] == 'adm') 
{
    navegate($_ENV['URL_VIEWS']. '/admin/home.php');
} else if ($session['usuario']['tipo_usuario'] == 'vis') 
{
    navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
} else 
{
    navegate($_ENV['URL_VIEWS']. '/servicos/home.php');
}
*/
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
