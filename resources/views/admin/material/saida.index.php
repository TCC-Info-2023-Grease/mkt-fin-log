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

include $_ENV['PASTA_CONTROLLER'] . '/SaidaMaterial/ConsultaController.php';
//print_r($saidas);
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
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.entrada.index" class="button-link btn-edit">
            Entradas
          </a>
          <span class="button-separator">|</span>
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.saida.index" class="button-link btn-delete">
            Saidas
          </a>
        </div>

        <div class="title"> <span class="text">Saídas | Materiais</span> </div>
        <?php if (isset($saidas) && !empty($saidas)) { ?>
          <table id="myTable" class="display">
            <thead>
              <tr>
                <th>Usurio</th>
                <th>Material</th>
                <th>Foto</th>
                <th>Quantidade Retirada</th>
                <th>Estoque Atual</th>
              </tr>
            </thead>

            <tbody>
              <?php if ($saidas): ?>
                <?php foreach ($saidas as $saida): ?>
                <tr>
                  <td>
                    <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Usuario/ShowController.php?id=<?= $saida['aluno_id']; ?>">
                      <?= $saida['nome_usuario']; ?>
                    </a>
                  </td>
                  <td>
                    <a href="<?=  $_ENV['URL_CONTROLLERS']; ?>/Material/ShowController.php?id=<?= $saida['material_id']; ?>">
                      <?= $saida['nome_material']; ?>
                    </a>
                  </td>
                  <td>
                    <img 
                      width="100px" 
                      src="<?= $_ENV['STORAGE'] . '/image/material/' . $saida['foto_material']; ?>"
                      alt="<?= $saida['nome']; ?>" 
                    />
                  </td>
                  <td>
                    <?php echo $saida['qtde_compra']; ?>
                  </td>
                  <td>
                    <?php echo $saida['estoque_atual']; ?>
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