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
