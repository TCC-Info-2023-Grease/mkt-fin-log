<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '\config.php';
import_utils(['auth', 'extend_styles', 'render_component']);

Auth::check('vis');

include $_ENV['PASTA_CONTROLLER'] . '/Caixa/ConsultaController.php';

global $_ENV;

//print_r($data);
?>

<!------- HEAD --------->
<?php
render_component('head');
//extend_styles(['styles']);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
    Finanças | Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php
  render_component('header');
  ?>

   <?php if (isset($data['caixa']) && !empty($data['caixa'])) { ?>
      <table id="myTable" class="display">
        <thead>
          <tr>            
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
              <?= $item['nome_usario']; ?>
            </td>
            <td>
              <?= $item['valor']; ?>
            </td>
            <td>
              <?php
              $data_movimentacao = new DateTimeImmutable($item['data_movimentacao']);
              echo $data_movimentacao->format('d/m/Y  h:s');
              ?>
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
        
        <span 
            style="color: <?php 
                if ($data['saldo_atual'] > 0) echo 'green';
                else if ($data['saldo_atual'] < 0) echo 'red';
                else echo 'yellow'; ?>;"
        >
            <?= $data['saldo_atual']; ?>
        </span>
      </h3>
      -
      <h3>
        Saldo Anterior:
        <span
            style="color: <?php 
                if ($data['saldo_anterior'] > 0) echo 'green';
                else if ($data['saldo_anterior'] < 0) echo 'red';
                else echo 'yellow'; ?>;"
        >
            <?= $data['saldo_anterior']; ?>        
        </span>
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
<!------- /BODY --------->
