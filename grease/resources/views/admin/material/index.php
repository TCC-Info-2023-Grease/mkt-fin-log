<?php

require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
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
    
    Material        
    <br><br>

    |   
    <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.create">
        Novo Material
    </a>

    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>


