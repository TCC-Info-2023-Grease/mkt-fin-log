<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
import_utils(['extend_styles', 'render_component', 'navegate']);

global $_ENV;   

//print_r($_POST);
$material = $_POST;

if (!isset($_POST) && empty($_POST)) navegate($_ENV['VIEWS']. '/adm/material/');
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

  Material
  <br><br>
  <?= $material['nome']; ?>    
  <br><br>

  <?= $material['nome_categoria']; ?>    
  <br><br>

  <?= $material['valor_unitario']; ?>    
  <br><br>

  <?= $material['descricao']; ?>    
  <br><br>

  <img  
    width="100px"
    src="<?= $_ENV['STORAGE'].  '/image/material/' .$material['foto_material']; ?>" 
    alt="<?= $material['nome']; ?>" 
  />
  <br><br>
  
  <?= date('d-m-Y', strtotime($material['data_validade'])); ?>    
  <br><br>
  
  <?= $material['estoque_minimo']; ?>    
  <br><br>

  <?= $material['estoque_atual']; ?>    
  <br><br>

  <?= $material['status_material']; ?>    
  <br><br>

  <?php
  render_component('footer');
  ?>

  <script type="text/javascript">
  </script>
</body>
<!-------/ BODY --------->  
