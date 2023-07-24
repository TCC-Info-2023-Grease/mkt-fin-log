<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['auth']);

Auth::check('adm');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money'
]);

include $_ENV['PASTA_CONTROLLER'] . '/Caixa/ConsultaController.php';

//print_r($data);
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.admin.financas' ]);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
  Finanças Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php
  render_component('sidebar');
  ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>
      <div class="dash-content">
        <div style="text-align: right;">
          <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.entrada.create" class="button-link">
            Nova Entrada
          </a>
          <span class="button-separator">|</span>
          <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.saida.create" class="button-link">
            Nova Saída
          </a>
        </div>

        <div class="title"> <span class="text">Caixa</span> </div>
      <?php if (isset($data['caixa']) && !empty($data['caixa'])) { ?>
      <table id="myTable" class="display">
        <thead>
          <tr>
            <th></th>
            <th>Usuario</th>
            <th>Valor</th>
            <th>Data</th>
            <th>Categoria</th>
            <th>Tipo Movimentação</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($data['caixa'] as $item): ?>
          <tr>
            <td>
              <a href="<?= $_ENV['URL_CONTROLLERS'] . '/Caixa/ShowController.php?id=' . $item['caixa_id']; ?>">
                <center>
                  <i class="fa fa-info-circle" style="color: #24c28d; font-size: 26px;" title="Ver mais">
                  </i>
                </center>
              </a>
            </td>
            <td>
              <?= $item['nome_usuario']; ?>
            </td>
            <td>
              <?= $item['valor']; ?>
            </td>
            <td>
              <?= date('d/m/Y', strtotime($item['data_movimentacao'])); ?>
            </td>
            <td>
              <?= $item['categoria']; ?>
            </td>
            <td>
              <?= $item['tipo_movimentacao']; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php } else { ?>
      <h3>Sem inserções no caixa</h3>
      <?php } ?>

      </div>
    </div>
  </section>

  <?php
  use_js_scripts([ 'js.admin.financas' ]);
  ?>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>
<!-------/ BODY --------->