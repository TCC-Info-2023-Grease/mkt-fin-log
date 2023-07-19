<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['auth']);

//Auth::check('vis');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money'
]);

include $_ENV['PASTA_CONTROLLER'] . '/Caixa/VisitanteDashboardController.php';
//print_r($data);
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.visitante.financas' ]);
?>
<title>
  Finanças 🕺 Grease
</title>
<!------- /HEAD --------->
<style type="text/css">
  header {
    background: black;
  }
</style>

<!------- BODY --------->
<body>
  <div class="container">
    <?php
    render_component('header');
    ?>

      <div class="dash-content">
        <div class="overview" style="padding: 2rem;">
          <div class="title"> <span class="text">Olá, <?= ucfirst($_SESSION['usuario']['nome']); ?></span> </div>
          <div class="boxes">
            <div class="box <?php if ($data['saldo_atual'] < 0): ?>box2<?php elseif ($data['saldo_atual'] > 0): ?>box1<?php else: ?>box3<?php endif; ?>">
              <span class="text">Saldo Atual</span> 
              <span class="number">
                 <?= Money::format($data['saldo_atual']); ?>
              </span> 
            </div>
            <div class="box <?php if ($data['total_gasto'] < $data['total_necessario']): ?>box1<?php elseif ($data['total_gasto'] > $data['total_necessario']): ?>box2<?php else: ?>box3<?php endif; ?>">              
              <span class="text">Total Gasto</span> 
              <span class="number">
                <?= Money::format($data['total_gasto']); ?>
              </span> 
            </div>
            <div class="box box1"> 
              <span class="text">Total Necessario</span> 
              <span class="number">
                <?= Money::format($data['total_necessario']); ?>
              </span> 
            </div>
          </div>
        </div>
    
    <div class="activity">
      <div class="title">
            <span class="text">Atividades Recentes</span>
          </div>
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
          </div>

    </div>
  </div>
  <?php
  use_js_scripts([ 'js.visitante.financas' ]);
  ?>
</body>
<!------- /BODY --------->
