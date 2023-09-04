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

include $_ENV['PASTA_CONTROLLER'] . '/Material/ConsultaController.php';

//var_dump($quantidadeMateriais);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  if (time() - $ultimo_acesso > 2) {
    unset($_SESSION['fed_pedido_material']); 
  }
} 
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

<title>Material | Admin</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_material']) && !empty($_SESSION['fed_material'])): ?>
      <script>
          Swal.fire({
              title: '<?php echo $_SESSION['fed_material']['title']; ?>',
              text: '<?php echo $_SESSION['fed_material']['msg']; ?>',
              icon: '<?php echo $_SESSION['fed_material']['icon']; ?>',
              confirmButtonText: 'OK'
          })
      </script>   
  <?php endif; ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>
      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"> <span class="text"><h1>Materiais</h1></span> </div> 
          
          <div style="text-align: right;">
            <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.create" class="button-link btn-edit">
              Novo Material
            </a>
          </div>
        </div>

      <div class="dash-content">
          <center style="margin-bottom: 46px;"><h2>Estatisticas</h2></center>

          <div class="dash-estatistics">
             <div class="title"><span class="text">Materiais por Categoria</span></div>

            <details>
              <summary>Ver mais...</summary>

              <div class="chart-container" style="width: 100%;">
                <center>
                  <canvas id="materialCategoriaChart" style="max-width: 800px;"></canvas>
                </center>
              </div>
            </details>
          </div>
        </div>

         <div class="dash-content">
          <div class="dash-estatistics">
                <div class="title"><span class="text">Materiais por Status</span></div>

                <details>
                  <summary>Ver mais...</summary>

                  <div class="chart-container">
                    <style type="text/css">
                      #statusChart {
                        height: 300px!important;
                      }
                    </style>
                    <center>
                    <canvas id="statusChart" style="max-width: 300px;" height="300"></canvas>
                    </center>
                  </div>
                </details>
          </div>
        </div>

        <div class="dash-content">
          <div class="dash-estatistics">
            <div class="title"><span class="text">Gastos do Mês</span></div>

            <details>
              <summary>Ver mais...</summary>

              <div class="chart-container">
                <style type="text/css">
                  #categoriasChart {
                    height: 400px!important;
                  }
                </style>
                <center>
                <canvas id="graficoGastos" style="max-width: 800px;"></canvas>
                </center>
              </div>
            </details>
          </div>
        </div>

        <br><br>
        <br><br>  
        <hr>

      <div class="dash-content" style="width: 80vw;">
      
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"> <span class="text">Materiais</span> </div>
            <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.create" class="button-link btn-edit" style="height: 40px;">
              Novo Material
            </a>
        </div>

        <?php if (isset($materiais) && !empty($materiais)) { ?>
          <table id="myTable" class="display">
            <thead>
              <tr>
                <th># ID</th>
                <th>Nome</th>
                <th>Foto Material</th>
                <th>Categoria</th>   
                <th>Status</th> 
                <th>Actions</th> 
              </tr>
            </thead>
            
            <tbody>
              <?php if ($materiais): ?>
                <?php foreach ($materiais as $material): ?>
                  <tr>
                    <td>
                      <?= $material['material_id']; ?>
                    </td>
                    <td>
                      <?= $material['nome_material']; ?>
                    </td>
                    <td>
                      <img  
                        width="200px"
                        src="<?= $_ENV['STORAGE'].  '/image/material/' .$material['foto_material']; ?>" 
                        alt="<?= $material['nome_material']; ?>" 
                      />
                    </td>  
                    <td>
                      <?php echo $material['nome_categoria']; ?>
                    </td>
                    <td>
                      <?php echo $material['status_material']; ?>
                    </td>
                    <th style="padding: 26px;">
                      <a href="<?= $_ENV['VIEWS']; ?>/admin/material/entrada.create.php?id=<?php echo $material['material_id']; ?>"
                        class="icon-link edit"
                      >
                        <i class="fa-solid fa-plus"></i>
                      </a>
                      <br><br>    

                      <?php if($material['estoque_atual'] >= 0): ?>
                      <a href="<?= $_ENV['VIEWS']; ?>/admin/material/saida.create.php?id=<?php echo $material['material_id']; ?>"
                        class="icon-link delete"
                      >
                        <i class="fa-solid fa-minus"></i>
                      </a><br>
                      <br><hr><br>    
                      <?php endif; ?>

                      <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Material/ShowController.php?id=<?php echo $material['material_id']; ?>"
                        class="icon-link"
                      >
                        <i class="fa-regular fa-eye"></i>
                      </a>

                      <br><br>    
                      <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Material/EditController.php?id=<?= $material['material_id']; ?>"
                        class="icon-link edit"
                      >

                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <br><br>    
                      
                      <a href="#"
                        onclick="if (confirm('Deseja excluir mesmo?')) {
                          this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Material/DeletarController.php?id=<?= $material['material_id']; ?>';
                        }"
                        class="icon-link delete"
                      >
                        <i class="fa-solid fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        <?php } else { ?>
          <h3>Sem inserções</h3>
        <?php } ?>
      </div>
    </div>
  </section>

  <?php
  use_js_scripts([ 'js.admin.financas' ]);
  ?>

  <script>
    // Dados de exemplo (substitua isso com seus próprios dados)
    const data = {
        labels: <?= json_encode($categoriasMateriais);  ?>,
        datasets: [{
            label: 'Materiais por Categoria',
            data: <?= json_encode(array_values($quantidadeMateriais));  ?>, // Quantidade de materiais em cada categoria
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)', // Cor da categoria 1
                'rgba(54, 162, 235, 0.2)', // Cor da categoria 2
                'rgba(255, 206, 86, 0.2)'  // Cor da categoria 3
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Opções de configuração do gráfico
    const options = {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantidade de Materiais'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Categorias'
                }
            }
        }
    };

    // Obtendo o contexto do canvas
    const ctx = document.getElementById('materialCategoriaChart').getContext('2d');

    // Criando o gráfico de barras
    const myChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico
        data: data,   // Dados
        options: options // Opções de configuração
});
  </script>

  <script>
        <?php
        $statusLabels = json_encode(array_keys($dadosStatus));
        $statusContagens = json_encode(array_values($dadosStatus));
        ?>

        // Configure os dados para o gráfico de pizza
        var ctx2 = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: <?php echo $statusLabels; ?>, // Rótulos de status 
                datasets: [{
                    data: <?php echo $statusContagens; ?>, // Dados de contagem
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'], // Cores das fatias
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'], // Cores da borda das fatias
                    borderWidth: 1
                }]
            }
        });
    </script>

    <script>
        // Obtém os dados do PHP e converte para JavaScript
        const dadosGastos = <?php echo json_encode($gastosUltimoMes); ?>;

        // Prepara os dados para o gráfico
        const labels = ['Total de Gastos', 'Maior Gasto'];
        const valores = [dadosGastos.totalGastos, dadosGastos.maiorGasto];

        // Cria o gráfico
        const ctx3 = document.getElementById('graficoGastos').getContext('2d');
        const grafico = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Gastos no Último Mês',
                    data: valores,
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>



  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>
<!-------/ BODY --------->