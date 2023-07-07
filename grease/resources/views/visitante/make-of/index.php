<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
import_utils(['auth', 'extend_styles', 'render_component']);

Auth::check('vis');

include $_ENV['PASTA_CONTROLLER'] . '/MakeOf/ConsultaController.php';
global $_ENV;

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_makeof']);
  }
} 
?>

<!------- HEAD --------->
<?php
render_component('head');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
  🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php
  render_component('header');
  ?>

  <h2>Make Ofs</h2>
  
  <?php if (isset($data['makeOf']) && !empty($data['makeOf'])) { ?>
    <?php foreach ($data['makeOf'] as $item): ?>
      <div>
        <div>
          <h3>
            <?= $item['titulo']; ?>
          </h3>
        </div>

        <div>
          <p>
            <?= $item['descricao']; ?>
          </p>
        </div>

        <div>
          <?= $item['uri']; ?> 
        </div>
      </div>
    <?php endforeach; ?>
  <?php } else { ?>
    <h3>Sem dados</h3>
  <?php } ?>

  <?php
  render_component('footer');
  ?>

  <script type="text/javascript">
  </script>
</body>
<!-------/ BODY --------->