<<<<<<< HEAD
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
    
</title>
<script>
    $(document).ready(function () {
        $('.phone').inputmask('(99) - 99999-9999');
    });  
</script>
<!-------/ HEAD --------->


<!------- BODY --------->

<body>
    <div>
        Olá
    </div>
</body>
<!------- /BODY --------->
=======
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
>>>>>>> 286a4901e05e7d84006a15f932d5b2227f5e0c7a
