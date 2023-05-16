<?php
# ------ Configurações Básicas
require dirname(dirname(__DIR__)) . '/config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component']);
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['main']);
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

    <!--─────────────────Começo Home────────────────-->
    <main>
 
      <div id="home">
        <div class="filter"></div>
        <section class="intro">

          <h3>Grease
            <hr>
          </h3>

          <p>PLANEJAMENTO MUSICAL</p>

          <p></p>

          <p></p>

        </section>
      </div>

    </main>
      <!--─────────────────fim Home────────────────-->

    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body>
<!------- /BODY --------->
