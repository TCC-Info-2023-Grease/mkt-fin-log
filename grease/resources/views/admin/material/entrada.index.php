<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
global $_ENV;

include $_ENV['PASTA_CONTROLLER'] . '/EntradaMaterial/ConsultaController.php';
//print_r($saidas);

import_utils(['extend_styles', 'render_component']);
?>


<!------- HEAD --------->
<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
  Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!-------/ BODY --------->
<body>
  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/header.php';
  ?>
 <br><br>

  <table id="myTable" class="display">
    <thead>
      <tr>
        <th>Usurio</th>
        <th>Material</th>
        <th>Foto</th>
        <th>Quantidade Entrada</th>
        <th>Valor Pago</th>
        <th>Estoque Atual</th>
      </tr>
    </thead>

    <tbody>
      <?php if ($entradas): ?>
        <?php foreach ($entradas as $entrada): ?>
        <tr>
          <td>
            <a href="<?= $_ENV['VIEWS']; ?>/admin/usuario/show.php?id=<?= $saida['usuario_id']; ?>">
              <?= $saida['nome_usuario']; ?>
            </a>
          </td>
          <td>
            <a href="<?= $_ENV['VIEWS']; ?>/admin/material/show.php?id=<?= $entrada['material_id']; ?>">
              <?= $entrada['nome']; ?>
            </a>
          </td>
          <td>
            <img 
              width="100px" 
              src="<?= $_ENV['STORAGE'] . '/image/material/' . $entrada['foto_material']; ?>"
              alt="<?= $entrada['nome']; ?>" 
            />
          </td>
          <td>
            <?= $entrada['qtde_compra']; ?>
          </td>
          <td>
            <?= $entrada['valor_gasto']; ?>
          </td>
          <td>
            <?= $entrada['estoque_atual']; ?>
          </td>
          <!-- 
          <td>
            <a href="<?= $_ENV['VIEWS']; ?>/admin/material/show.php?id=<?php echo $material['material_id']; ?>">
              <i class="fa-regular fa-eye"></i>
            </a>

            <br><br>
            <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Material/EditController.php?id=<?= $material['material_id']; ?>">
              <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <br><br>

            <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Material/DeletarController.php?id=<?= $material['material_id']; ?>">
              <i class="fa-solid fa-trash"></i>
            </a>
          </td> -->
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>


  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
  ?>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>
<!-------/ BODY --------->