<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component']);    
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['styles']);
?>

<title>
    Hello Visitante
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
    <div>
        Olá
    </div>
</body>
<!------- /BODY --------->
