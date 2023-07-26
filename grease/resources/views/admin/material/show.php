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

global $_ENV;   

//print_r($_POST);
$material = $_POST;

if (!isset($_POST) && empty($_POST)) navegate($_ENV['VIEWS']. '/adm/material/');
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.admin.financas' ]);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
          <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.entrada.create" class="button-link btn-edit">
            Nova Entrada
          </a>
          <span class="button-separator">|</span>
          <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.saida.create" class="button-link btn-delete">
            Nova Saída
          </a>
        </div>

        <div class="overview">
        <div class="title"> <span class="text">Informações do Material</span> </div>
        
        <div class="activity">
          <div class="activity-data">
              <div class="data names">
                <span class="data-list">
                    <img  
                      style="border-radius: 50%;border: 4px solid black;padding: 2px"
                      width="200px"
                      src="<?= $_ENV['STORAGE'].  '/image/material/' .$material['foto_material']; ?>" 
                      alt="<?= $material['nome']; ?>" 
                    />             
                  </span>
              </div>
              
              <div class="data names">
                <span class="data-title">Valor Unitário</span>
                
                <span class="data-list">
                   <?= Money::format($material['valor_unitario']); ?>            
                 </span>
              </div>

              <div class="data names">
                <span class="data-title">Valor Estimado</span>
                
                <span class="data-list">
                   <?= Money::format($material['valor_estimado']); ?>            
                 </span>
              </div>

              <div class="data names">
                <span class="data-title">Valor Gasto</span>
                
                <span class="data-list">
                   <?= Money::format($material['valor_gasto']); ?>            
                 </span>
              </div>
            </div>
             <br><br>

          <div class="activity-data">
            <div class="data names">
                <span class="data-title">
                  Material
                </span>
                
                <span class="data-list">
                   <?= $material['nome']; ?>
                </span>
            </div>

              <div class="data names">
                <span class="data-title">Data Cadastro</span>
                
                <span class="data-list">
                   <?= date('d/m/Y', strtotime($material['datahora_cadastro'])); ?>
                </span>
              </div>

              <div class="data names">
                <span class="data-title">Categoria</span>
                
                <span class="data-list">
                  <?= $material['nome_categoria']; ?>    
                </span>
              </div>
          </div>
          <br><br>

          <div class="activity-data">
            <div class="data names">
                <span class="data-title">Descrição</span>
                
                <span class="data-list">
                  <?= !empty($material['descricao'])? $material['descricao'] : 'N/A'; ?>
                </span>
              </div>
          </div>
          <br><br>
          
          <div class="activity-data">
              <div class="data names">
                <span class="data-title">Obs</span>
                
                <span class="data-list">
                  <?= !empty($material['obs'])? $material['obs'] : 'N/A'; ?>
                </span>
              </div>
        </div>  

        <br><br>
        <div class="activity-data">
            <div class="data names">
                <span class="data-title">Estoque Minimo</span>
                
                <span class="data-list">
                  <?= $material['estoque_minimo']; ?>  
                </span>
              </div>

              <div class="data names">
                <span class="data-title">Estoque Atual</span>
                
                <span class="data-list">
                  <?= $material['estoque_atual']; ?>  
                </span>
              </div>

              <div class="data names">
                <span class="data-title">Status Material</span>
                
                <span class="data-list">
                  <?= $material['status_material']; ?>  
                </span>
              </div>
        </div>  
        <br><br>

        <div class="activity-data">
            <div class="data names">
                <span class="data-title">Unidade Medida</span>
                
                <span class="data-list">
                  <?= $material['unidade_medida']; ?>  
                </span>
              </div>

              <div class="data names">
                <span class="data-title">Data Validade</span>
                
                <span class="data-list">
                  <?= date('d/m/Y', strtotime($material['data_validade'])); ?> 
                </span>
              </div>

              <div class="data names">
                <span class="data-title">Status Material</span>
                
                <span class="data-list">
                  <?= $material['status_material']; ?>  
                </span>
              </div>
        </div> 
        <br>

         <div class="title"> <span class="text">Informações do Usuario</span> </div>

         <div class="activity-data">
            <div class="data names">
                <span class="data-list">
                    <img  
                      style="border-radius: 50%;border: 4px solid black;padding: 2px"
                      width="200px"
                      src="<?= $_ENV['STORAGE'].  '/image/usuario/' .$material['foto_perfil']; ?>" 
                      alt="<?= $material['nome_usuario']; ?>" 
                    />             
                  </span>
              </div>

            <div class="data names">
                <span class="data-title">Usuario</span>
                
                <span class="data-list">
                  <?= $material['nome_usuario']; ?>  
                </span>
              </div>

              <div class="data names">
                <span class="data-title">Email</span>
                
                <span class="data-list">
                  <?= $material['email']; ?> 
                </span>
              </div>
        </div>  
      </div>
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

