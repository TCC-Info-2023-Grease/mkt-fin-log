<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('adm');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money'
]);

include $_ENV['PASTA_CONTROLLER'] . '/Caixa/ConsultaController.php';

$receitas = $data['receitas'];
$despesas = $data['despesas'];
$meses    = $data['meses'];
$saldos   = $data['saldos'];

$dadosCategorias = $data['dadosCategorias'];

$totalReceitas = $data['totalReceitas'];
$totalDespesas = $data['totalDespesas'];

$porcentagemDespesas = $data['porcentagemDespesas'];
$porcentagemReceitas = $data['porcentagemReceitas'];


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

  <?php if (isset($_SESSION['fed_caixa']) && !empty($_SESSION['fed_caixa'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_caixa']['title']; ?>',
      text: '<?php echo $_SESSION['fed_caixa']['msg']; ?>',
      icon: 'error',
      confirmButtonText: 'OK'
    });
  </script>
  <?php endif; ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>

      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"> <span class="text"><h1>Caixa</h1></span> </div> 

          <div>
               <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.entrada.create" class="button-link">
                Nova Entrada
              </a>
              <span class="button-separator">|</span>
              <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.saida.create" class="button-link">
                Nova Saída
              </a>
          </div>
        </div>

        <div class="dash-content">
          <div class="boxes">
             <div 
                class="box 
                  <?php if ($data['saldo_atual'] <= 0): ?>
                    box2
                  <?php elseif ($data['saldo_atual'] > 0): ?>
                    box1
                  <?php else: ?>
                    box3
                  <?php endif; ?>
              ">
                <span class="text">Saldo Atual</span> 
                <span class="number">
                   <?= Money::format($data['saldo_atual']); ?>
                </span> 
              </div>

              <div 
                class="box 
                  <?php if ($data['total_gasto'] < $data['total_necessario']): ?>
                    box1
                  <?php elseif ($data['total_gasto'] > $data['total_necessario']): ?>
                    box2
                  <?php else: ?>
                    box3
                  <?php endif; ?>
              ">              
                <span class="text">Total Gasto</span> 
                <span class="number">
                  <?= Money::format($data['total_gasto']); ?>
                </span> 
              </div>

              <div class="box box4"> 
                <span class="text">Total Necessario</span> 
                <span class="number">
                  <?= Money::format($data['total_necessario']); ?>
                </span> 
              </div>          
            </div>
        </div>
        <br><br><br>
        <hr>

        <div class="dash-content">
          <center style="margin-bottom: 46px;"><h2>Estatisticas</h2></center>

          <div class="dash-estatistics">
             <div class="title"><span class="text">Saldo Mensal</span></div>

            <details>
              <summary>Ver mais...</summary>

              <div class="chart-container" style="width: 100%;">
                <center>
                  <canvas id="financasChart" style="max-width: 500px;"></canvas>
                </center>
              </div>
            </details>
          </div>
        </div>

         <div class="dash-content">
          <div class="dash-estatistics">
                <div class="title"><span class="text">Porcentagem de Despesas e Receitas</span></div>

                <details>
                  <summary>Ver mais...</summary>

                  <div class="chart-container">
                    <style type="text/css">
                      #despesasReceitasChart {
                        height: 300px!important;
                      }
                    </style>
                    <center>
                    <canvas id="despesasReceitasChart" style="max-width: 300px;"></canvas>
                    </center>
                  </div>
                </details>
          </div>
        </div>

        <div class="dash-content">
          <div class="dash-estatistics">
            <div class="title"><span class="text">Categorias de despesas e receitas</span></div>

            <details>
              <summary>Ver mais...</summary>

              <div class="chart-container">
                <style type="text/css">
                  #categoriasChart {
                    height: 400px!important;
                  }
                </style>
                <center>
                <canvas id="categoriasChart" style="max-width: 300px;"></canvas>
                </center>
              </div>
            </details>
          </div>
        </div>

        <br><br>
        <br><br>
        <hr>

        <div class="dash-content">
          <div style="display: flex;justify-content: space-between;align-items: center;">
            <div class="title"><span class="text">Movimentações</span></div>

            <div class="dropdown">
              <button onclick="toggleDropdown()" class="dropbtn">Exportar</button>
              <div id="myDropdown" class="dropdown-content">
                <button onclick="exportToPDF()">PDF</button>
                <button onclick="exportToExcel()">Excel</button>
              </div>
            </div>
          </div>
           
          <?php if (isset($data['caixa']) && !empty($data['caixa'])) { ?>

          <table id="myTable" class="display">
            <caption>Caixa</caption>
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
                  <?= Money::format($item['valor']); ?>            
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
    </div>
  </section>


  <?php
    use_js_scripts([ 
      'js.lib.xlsx',
      'js.lib.jspdf',
      'js.lib.jspdf_plugin_autotable',
      'js.services.ChartCaixa',
      'js.services.ExportTabelaCaixa',
      'js.admin.financas'
    ]);
  ?>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      ChartCaixa.saldoMensal(
        <?= json_encode($saldos); ?>, 
        <?= json_encode($meses); ?>
      );

      ChartCaixa.despesasReceitas(
        <?= json_encode($porcentagemDespesas); ?>, 
        <?= json_encode($porcentagemReceitas); ?>
      );

      ChartCaixa.receitasDespesasPorCategoria(
        <?= json_encode($dadosCategorias); ?>
      );
    });
  </script>
</body>
<!-------/ BODY --------->