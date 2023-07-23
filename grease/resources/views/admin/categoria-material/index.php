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

$categoria_material = new CategoriaMaterial($mysqli);
$categorias = $categoria_material->buscarTodos();

//print_r($categorias);
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
      <div class="dash-content">
        <div style="text-align: right;">
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.categoria_material.create" class="button-link">
            Nova Categoria
          </a>
        </div>

        <div class="title"> 
            <span class="text">Categoria dos Materiais</span> 
        </div>
        
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th># ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td>
                        <?php echo $categoria['categoria_id']; ?>
                    </td>
                    <td>
                        <?php echo $categoria['nome']; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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