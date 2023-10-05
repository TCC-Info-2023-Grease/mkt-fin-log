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

include $_ENV['PASTA_CONTROLLER'] . '/Fornecedor/ConsultaController.php';

//print_r(isset($_SESSION['fed_fornecedor']) && !empty($_SESSION['fed_fornecedor']));

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];

  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 4) {
    unset($_SESSION['fed_fornecedor']);
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
  Fornecedores Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_fornecedor']) && !empty($_SESSION['fed_fornecedor'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_fornecedor']['title']; ?>',
      text: '<?php echo $_SESSION['fed_fornecedor']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_fornecedor']['icon']; ?>',
      confirmButtonText: 'OK'
    })
  </script>
  <?php endif; ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>

      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"> <span class="text"><h1>Fornecedores</h1></span> </div> 

          <div>
             <a href="<?= $_ENV['ROUTE'] ?>admin.fornecedor.create" class="button-link" style="background-color: #28a745;">
              Novo Fornecedor
            </a>
          </div>
        </div>


      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"><span class="text">Itens</span></div>

          <div class="dropdown">
            <a target="_blank" href="<?= $_ENV['ROUTE'] ?>admin.fornecedor.relatorio" class="dropbtn" style="text-decoration: none;">
              Relatório
            </a>
          </div>
        </div>

        <?php if (isset($fornecedores) || !empty($fornecedores)) { ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th># ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fornecedores as $fornecedor): ?>
                <tr>
                    <td style="width: 96px;">
                        <?= $fornecedor['fornecedor_id']; ?>
                    </td>
                    <td>
                        <?= $fornecedor['nome']? $fornecedor['nome'] : 'N/A'; ?>
                    </td>
                    <td>
                        <?= $fornecedor['email']? $fornecedor['email'] : 'N/A'; ?>
                    </td>
                    <td style="color: <?= ($fornecedor['status_fornecedor'] == 'ativo')? 'green' : 'red'; ?>;">
                        <strong><?= $fornecedor['status_fornecedor']? $fornecedor['status_fornecedor'] : 'N/A'; ?></strong>
                    </td>
                    <th style="padding: 32px;width: 90px;">
                      <a
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Fornecedor/ShowController.php?id=<?= $fornecedor['fornecedor_id']; ?>"
                        class="icon-link"
                      >
                        <i class="fa-regular fa-eye"></i> 
                      </a>

                      <br>
                      <br>
                      <hr>
                      <br>

                      <a
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Fornecedor/EditController.php?id=<?= $fornecedor['fornecedor_id']; ?>"
                        class="icon-link edit"
                      >
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <br><br>

                      <a
                        href="#"
                        onclick="if (confirm('Deseja excluir mesmo?')) {
                          this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Fornecedor/DeletarController.php?id=<?= $fornecedor['fornecedor_id']; ?>';
                        }"
                        class="icon-link delete"
                      >
                        <i class="fa-solid fa-trash"></i>
                      </a>
                    </th>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <?php } else { ?>
            <h3>Sem inserções</h3>
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
