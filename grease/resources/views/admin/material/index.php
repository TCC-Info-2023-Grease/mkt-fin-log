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

include $_ENV['PASTA_CONTROLLER'] . '/Material/ConsultaController.php';

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
      <div class="dash-content" style="width: 80vw;">
        <div style="text-align: right;">
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.create" class="button-link">
            Novo Material
          </a>
          <span class="button-separator">|</span>
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.entrada.index" class="button-link">
            Entradas
          </a>
          <span class="button-separator">|</span>
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.saida.index" class="button-link">
            Saidas
          </a>
        </div>

        <div class="title"> <span class="text">Materiais</span> </div>
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
                      <?= $material['nome']; ?>
                    </td>
                    <td>
                      <img  
                        width="100px"
                        src="<?= $_ENV['STORAGE'].  '/image/material/' .$material['foto_material']; ?>" 
                        alt="<?= $material['nome']; ?>" 
                      />
                    </td>  
                    <td>
                      <?php echo $material['nome_categoria']; ?>
                    </td>
                    <td>
                      <?php echo $material['status_material']; ?>
                    </td>
                    <td>
                      <a href="<?= $_ENV['VIEWS']; ?>/admin/material/entrada.create.php?id=<?php echo $material['material_id']; ?>"> 
                        <i class="fa-solid fa-plus"></i>
                      </a>
                      <br><br>    

                      <?php if($material['estoque_atual'] >= 0): ?>
                      <a href="<?= $_ENV['VIEWS']; ?>/admin/material/saida.create.php?id=<?php echo $material['material_id']; ?>">
                        <i class="fa-solid fa-minus"></i>
                      </a>
                      <br><br>    
                      <?php endif; ?>

                      <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Material/ShowController.php?id=<?php echo $material['material_id']; ?>">
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
  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });

  </script>
</body>
<!-------/ BODY --------->