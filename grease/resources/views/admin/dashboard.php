<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['auth']);

Auth::check('adm');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money'
]);

include $_ENV['PASTA_CONTROLLER'] . '/Caixa/AdminDashboardController.php';
//print_r($data);
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.admin.financas' ]);
?>
<title>
  Finanças Admin 🕺 Grease
</title>
<!------- /HEAD --------->


<!------- BODY --------->
<body>
    <?php
    render_component('sidebar');
    ?>

    <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>
      <div class="dash-content">
        <div class="overview">
          <div class="title"> <span class="text">Olá, <?= ucfirst($_SESSION['usuario']['nome']); ?></span> </div>
          <div class="boxes">
            <div 
                class="box 
                  <?php if ($data['saldo_atual'] < 0): ?>
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
        <br><br>
        <hr>
        <div class="activity">
          <div class="title">
            <span class="text">Atividades Recentes</span>
          </div>
          <?php if (isset($data['caixa']) && is_array($data['caixa']) && count($data['caixa']) > 0): ?>
            <div class="activity-data">
              <div class="data names">
                <span class="data-title">Usuario</span>
                
                <?php foreach ($data['caixa'] as $item): ?>
                <span class="data-list">
                   <?= $item['nome_usuario']; ?>
                </span>
                <?php endforeach; ?>
              </div>

              <div class="data names">
                <span class="data-title">Valor</span>
                
                <?php foreach ($data['caixa'] as $item): ?>
                <span class="data-list">
                   <?= Money::format($item['valor']); ?>            
                 </span>
                <?php endforeach; ?>
              </div>

              <div class="data names">
                <span class="data-title">Data</span>
                
                <?php foreach ($data['caixa'] as $item): ?>
                <span class="data-list">
                   <?= date('d/m/Y', strtotime($item['data_movimentacao'])); ?>
                </span>
                <?php endforeach; ?>
              </div>

              <div class="data names">
                <span class="data-title">Tipo Movimentação</span>
                
                <?php foreach ($data['caixa'] as $item): ?>
                <span class="data-list">
                   <?= $item['tipo_movimentacao']; ?>
                </span>
                <?php endforeach; ?>
              </div>
          </div>
          <?php else: ?>
            <p>Nenhuma atividade recente encontrada.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>

  <?php
  use_js_scripts([ 'js.admin.financas' ]);
  ?>
</body>
<!------- /BODY --------->
