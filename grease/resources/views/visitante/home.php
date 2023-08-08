<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('vis');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money'
]);

?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['css.styleindex']);
?>

<title>
    Hello Visitante
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
    <div class="container">
        <?php render_component('header'); ?>

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
        <hr>

        <?php render_component('sobrenos'); ?>

        <?php render_component('footer'); ?>
    </div>

    <?php
      use_js_scripts([ 'js.visitante.scriptindex' ]);
    ?>
</body>
<!------- /BODY --------->
