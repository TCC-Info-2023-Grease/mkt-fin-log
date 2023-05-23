<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
import_utils(['extend_styles', 'render_component']);

include $_ENV['PASTA_CONTROLLER'] . '/Caixa/ConsultaController.php';
print_r($data);

global $_ENV;   
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
    <a href="<?php echo $_ENV['ROUTE'] ?>admin.caixa.entrada.create">
        Nova Entrada
    </a>
    |   
    <a href="<?php echo $_ENV['ROUTE'] ?>admin.caixa.saida.create">
        Nova Saída
    </a>
    <br><br><br>

    <?php if(isset($data['caixa']) && !empty($data['caixa'])) { ?>          
    <table id="myTable" class="display">
        <thead>
          <tr>
            <th></th> 
            <th>Usuario</th> 
            <th>Valor</th> 
            <th>Data</th> 
            <th>Categoria</th> 
          </tr>
        </thead>

        <tbody>
          <?php foreach ($data['caixa'] as $item): ?>
            <tr>
              <td>
                <a 
                  href="<?php echo $_ENV['URL_VIEWS']. '/admin/caixa/show.php?id=' .$item['caixa_id']; ?>"
                >
                  <center>
                    <i class="fa-solid fa-scroll" style="color: #24c28d; font-size: 26px;" title="Ver mais">
                    </i>                  
                  </center>
                </a>  
              </td>
              <td>
                <?php echo $item['nome']; ?>
              </td>
              <td>
                <?php echo $item['valor']; ?>
              </td>
              <td>
                <?php 
                  $data_movimentacao = new DateTimeImmutable($item['data_movimentacao']);
                  echo $data_movimentacao->format('d/m/Y'); 
                ?>
              </td>
              <td>
                <?php echo $item['categoria']; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>    

      <h3>
        Saldo Atual: <?php echo $data['saldo_atual']; ?>
      </h3>
        -
      <h3>
        Saldo Anterior: <?php echo $data['saldo_anterior']; ?>
      </h3>          
    <?php } else { ?>
      <h3>Sem inserções no caixa</h3>
    <?php } ?>  

    <?php
    render_component('footer');
    ?>

    <script type="text/javascript">
        $(document).ready( function () {
          $('#myTable').DataTable();
        });
    </script>
</body>
<!-------/ BODY --------->