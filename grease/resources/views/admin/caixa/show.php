<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
import_utils(['extend_styles', 'render_component', 'navegate']);

global $_ENV;   

//print_r($_POST);
$caixa = $_POST;

if (!isset($_POST) && empty($_POST)) navegate($_ENV['VIEWS']. '/adm/caixa/');
?>

<!------- HEAD --------->
<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
    Admin 🕺 Grease
</title>
<!-------/ HEAD --------->

<!------- BODY --------->
<body>
  <?php
  render_component('header');
  ?>

  Caixa
  <br><br>

  |
  <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.entrada.create">
    Nova Entrada
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.saida.create">
    Nova Saída
  </a>
  <br><br><br
  >
  
  
  <?= $caixa['foto_perfil']; ?>    
  <br><br>

  <?= $caixa['nome_usuario']; ?>    
  <br><br>

  <?= $caixa['valor']; ?>    
  <br><br>

  <?= $caixa['descricao']; ?>    
  <br><br>

  <?= $caixa['tipo_movimentacao']; ?>    
  <br><br>
  
  <?= $caixa['data_movimentacao']; ?>    
  <br><br>
  
  <?= $caixa['obs']; ?>    
  <br><br>

  <?php
  render_component('footer');
  ?>

  <script type="text/javascript">
  </script>
</body>
<!-------/ BODY --------->  
