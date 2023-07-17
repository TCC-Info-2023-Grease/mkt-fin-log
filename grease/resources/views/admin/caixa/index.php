<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
import_utils(['auth', 'extend_styles', 'render_component']);

Auth::check('adm');

include $_ENV['PASTA_CONTROLLER'] . '/Caixa/ConsultaController.php';

global $_ENV;
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
  <br><br><br>

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

  <h3>
    Saldo Atual:
    <?= $data['saldo_atual']; ?>
  </h3>
  -
  <h3>
    Saldo Anterior:
    <?= $data['saldo_anterior']; ?>
  </h3>
  <?php } else { ?>
  <h3>Sem inserções no caixa</h3>
  <?php } ?>

  <?php
  render_component('footer');
  ?>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });

  </script>
</body>
<!-------/ BODY --------->