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

$metas = new Meta($mysqli);
$metas = $metas->buscarTodos();

//print_r($metas);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_meta']);
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

  <?php if (isset($_SESSION['fed_meta']) && !empty($_SESSION['fed_meta'])): ?> 
    <script>
      Swal.fire({
        title: '<?= $_SESSION['fed_meta']['title']; ?>',
        text: '<?= $_SESSION['fed_meta']['msg']; ?>',
        icon: '<?= $_SESSION['fed_meta']['icon']; ?>',
        confirmButtonText: 'OK'

      })
    </script>
  <?php endif; ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>
      <div class="dash-content">
        <div style="text-align: right;">
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.meta.create" class="button-link">
            Nova Meta
          </a>
        </div>

        <div class="title"> 
            <span class="text">Meta</span> 
        </div>
        
        <table id="myTable" class="display" style="width:950px;">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Total Necessário</th>
                    <th>Data Inicio</th>
                    <th>Data Fim</th>
                    <th>Status</th>                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($metas as $meta): ?>
                <tr>
                    <td>
                        <?php echo $meta['nome']; ?>
                    </td>
                    <td>
                        <?php echo Money::format($meta['total_necessario']); ?>
                    </td>
                    <td>
                        <?= date('d/m/Y', strtotime($meta['data_inicio'])); ?> 
                    </td>
                    <td>
                        <?= date('d/m/Y', strtotime($meta['data_fim'])); ?> 
                    </td>
                    <td>
                      <?= ($meta['status'] == 1)? 'Ativado' : 'Desativado'; ?>
                    </td>
                   <th style="padding: 26px;">
                      <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Meta/EditController.php?id=<?= $meta['id']; ?>" class="icon-link edit">
                        <i class="fa-regular fa-pen-to-square"></i> Editar
                      </a>
                      <br><br>    

                      <?php if ($meta['status'] == 1): ?>
                        <!-- Link para desativar a meta -->
                        <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Meta/AlterarStatusController.php?id=<?= $meta['id']; ?>&acao=desativar" class="icon-link delete" onclick="return confirm('Deseja desativar a meta?');">
                          <i class="fa-solid fa-ban"></i> Desativar
                        </a>
                      <?php else: ?>
                        <!-- Link para ativar a meta -->
                        <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Meta/AlterarStatusController.php?id=<?= $meta['id']; ?>&acao=ativar" class="icon-link activate" onclick="return confirm('Deseja ativar a meta?');">
                          <i class="fa-solid fa-check-circle"></i> Ativar
                        </a>
                      <?php endif; ?>
                    </th>

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