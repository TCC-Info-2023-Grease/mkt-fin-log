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

//var_dump($data);

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
      
        <div class="" style="    
          display: flex;
          flex-wrap: wrap;
          align-content: stretch;
          justify-content: space-between;
          align-items: center;
          gap: 2rem;
          flex-basis: min-content;
        ">
          <style type="text/css">
            .single-box span {  
              color: white;
              margin-top: 32px;
            }
          </style>
          <div class="single-box">
            <a href="#"><img src="<?= assets('images/projeto/', '1.jpg'); ?>" /></a>
              <span>Foto do Cast </span> 
          </div>
          <br>

          <div class="single-box">
            <a href="#">
                <img src="<?= assets('images/projeto/', '2.jpg'); ?>" alt="Integrantes do grupo na Semana Paulo Freire trabalhando na barraca de pipoca" />
            </a>
            <span>
              Integrantes do grupo na Semana Paulo Freire trabalhando na barraca de pipoca
            </span>
          </div>

          <div class="single-box">
            <a href="#"><img height="200" src="<?= assets('images/projeto/', '3.jpg'); ?>" alt="Integrantes do grupo na Semana Paulo Freire trabalhando na venda de pipoca" /></a>
            <span>
              Integrantes do grupo na Semana Paulo Freire trabalhando na venda de pipoca
            </span>
          </div>

          <div class="single-box">
            <a href="#">      <video width="320" height="290" controls="controls">
              <source src="<?= assets('images/projeto/', '4.mov'); ?>" type="video/mp4">
              </video></a>
          </div>

          <div class="single-box">
            <a href="#"><img src="<?= assets('images/projeto/', '5.jpg'); ?>" /></a>
          </div>

          <div class="single-box">
            <a href="#">      <video width="320" height="290" controls="controls">
              <source src="<?= assets('images/projeto/', '6.mov'); ?>" type="video/mp4">
              </video></a>
          </div>

          <?php if (isset($data['makeOf']) && !empty($data['makeOf'])): ?>
          <?php foreach ($data['makeOf'] as $makeOf) { ?>
            <div class="single-box">
              <iframe width="560" height="315" src="<?= $makeOf['uri']; ?>" title="<?= $makeOf['titulo']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
          <?php } ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="img-area" style="background: black;">
      
        <div class="wrapper" style="display: block;">
          <h3>Grease - O Musical</h3>
          <br><br>
          
          <p  
            style="color: white;"
          >
            Grease - O Musical é uma adaptação do filme Grease, lançado em 1978, que conta a história de amor entre Danny Zuko e Sandy Olsson nos anos 50. O musical estreou na Broadway em 1972 e foi um sucesso de público e crítica, sendo indicado a sete prêmios Tony. O musical tem canções famosas como "Summer Nights", "You're the One That I Want" e "Greased Lightnin'". 
          </p>
          <BR></BR>
          <p
            style="color: white;"
          >
            O musical já foi montado em vários países, incluindo o Brasil, onde teve duas versões: uma em 1994, com Edson Celulari e Claudia Raia, e outra em 2013, com Tiago Abravanel e Lívia Dabarian . Grease - O Musical é uma obra divertida, romântica e nostálgica, que retrata os costumes, as roupas e a música da juventude americana dos anos 50.
          </p>

        </div>
      </div>

      
    <!--─────────────────imagens fim────────────────-->


    <?php
    render_component('footer');
    ?>
  </div>
  
  <?php
    //use_js_scripts([ 'js.scriptprojeto' ]);
  ?>
</body>
<!-------/ BODY --------->