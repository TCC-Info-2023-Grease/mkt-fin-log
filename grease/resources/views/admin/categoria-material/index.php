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

$categoria_material = new CategoriaMaterial($mysqli);
$categorias = $categoria_material->buscarTodos();

//print_r($categorias);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 2) {
    unset($_SESSION['fed_categoria_material']);
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

<title>
  Finanças Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_categoria_material']) && !empty($_SESSION['fed_categoria_material'])): ?> 
    <script>
      Swal.fire({
        title: '<?= $_SESSION['fed_categoria_material']['title']; ?>',
        text: '<?= $_SESSION['fed_categoria_material']['msg']; ?>',
        icon: '<?= $_SESSION['fed_categoria_material']['icon']; ?>',
        confirmButtonText: 'OK'

      })
    </script>
  <?php endif; ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>
      <div class="dash-content">
        <div style="text-align: right;">
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.categoria_material.create" class="button-link btn-edit">
            Nova Categoria
          </a>
        </div>

        <div class="title"> 
            <span class="text">Categoria dos Materiais</span> 
        </div>
        
        <?php if (isset($categorias) || !empty($categorias)) { ?> 
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th># ID</th>
                    <th>Nome</th>
                    <th></th>
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
                    <th style="padding: 26px;">
                      <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/CategoriaMaterial/EditController.php?id=<?= $categoria['categoria_id']; ?>" class="icon-link edit">
                        <i class="fa-regular fa-pen-to-square"></i> Editar
                      </a>
                      <br><br>    
                      
                      <a href="#"
                        onclick="if (confirm('Deseja excluir mesmo?')) {
                          this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/CategoriaMaterial/DeletarController.php?id=<?= $categoria['categoria_id']; ?>';
                        }"
                        class="icon-link delete"
                      >
                        <i class="fa-solid fa-trash"></i> Deletar
                      </a>
                    </th>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <?php } else { ?>
            <h3>Sem inserções no caixa</h3>
            <?php } ?>
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