<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('vis');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component'
]);

include $_ENV['PASTA_CONTROLLER'] . '/MakeOf/ConsultaController.php';

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 2) {
    unset($_SESSION['fed_makeof']);
  }
} 
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.styleprojeto' ]);
?>

<title>
  Grease - Projeto
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <div class="container">
    <?php
    render_component('header');
    ?>


     <!--─────────────────Home────────────────-->
     <main>
 
      <div id="home">
        <div class="filter"></div>
        <section class="intro">

          <h3>Making Of
            <hr>
          </h3>

          <p>Confira abaixo o Making Of do nosso musical!</p>

          <p></p>

          <p></p>

        </section>


      </div>


    </main>
      <!--─────────────────fim Home────────────────-->

    <hr>
      <!--─────────────────imagens começo────────────────-->

      <div class="img-area">
      
        <div class="wrapper">

          <div class="single-box">
            <a href="#"><img src="<?= assets('images/projeto/', '1.jpg'); ?>" /></a>
          </div>

          <div class="single-box">
            <a href="#"><img src="<?= assets('images/projeto/', '2.jpg'); ?>" /></a>
          </div>

          <div class="single-box">
            <a href="#"><img src="<?= assets('images/projeto/', '3.jpg'); ?>" /></a>
          </div>

          <div class="single-box">
            <a href="#">      <video width="320" height="290" controls="controls">
              <source src="<?= assets('images/projeto/', '4.jpg'); ?>" type="video/mp4">
              </video></a>
          </div>

          <div class="single-box">
            <a href="#"><img src="<?= assets('images/projeto/', '5.jpg'); ?>" /></a>
          </div>

          <div class="single-box">
            <a href="#">      <video width="320" height="290" controls="controls">
              <source src="<?= assets('images/projeto/', '6.jpg'); ?>" type="video/mp4">
              </video></a>
          </div>

        </div>
      </div>

      <div class="img-area" style="background: black;">
      
        <div class="wrapper" style="display: block;">
          <h3>Grease - O Musical</h3>
          <br><br>
          
          <p  
            style="color: white;"
          >
            Na Califórnia na década de 50, Danny (John Travolta) e Sandy (Olivia Newton-John), um casal de estudantes, trocam juras de amor mas se separam, pois ela voltará para a Austrália. Entretanto, os planos mudam e Sandy por acaso se matricula na escola de Danny. Para fazer gênero ele infantilmente lhe dá uma esnobada, mas os dois continuam apaixonados, apesar do relacionamento ter ficado em crise. Esta trama serve como pano de fundo para retratar o comportamento dos jovens da época.

          </p>

        </div>
      </div>

      
    <!--─────────────────imagens fim────────────────-->


    <?php
    render_component('footer');
    ?>
  </div>
  
  <?php
    use_js_scripts([ 'js.scriptprojeto' ]);
  ?>
</body>
<!-------/ BODY --------->