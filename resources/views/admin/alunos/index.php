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

include $_ENV['PASTA_CONTROLLER'] . '/Aluno/ConsultaController.php';

//print_r(isset($_SESSION['fed_aluno']) && !empty($_SESSION['fed_aluno']));

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];

  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 4) {
    unset($_SESSION['fed_aluno']);
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

  <?php if (isset($_SESSION['fed_aluno']) && !empty($_SESSION['fed_aluno'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_aluno']['title']; ?>',
      text: '<?php echo $_SESSION['fed_aluno']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_aluno']['icon']; ?>',
      confirmButtonText: 'OK'
    })
  </script>
  <?php endif; ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>
      <div class="dash-content">
        <div style="text-align: right;">
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.alunos.create.all" class="button-link">
            Adicionar varios Alunos
          </a>
          
          <span class="button-separator">|</span>

          <a href="<?php echo $_ENV['ROUTE'] ?>admin.alunos.create" class="button-link btn-edit">
            Adicionar um Aluno
          </a>
        </div>

        <div class="title">
            <span class="text">Alunos</span>
        </div>

        <?php if (isset($alunos) || !empty($alunos)) { ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th># ID</th>
                    <th>Nome</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td style="width: 96px;">
                        <?= $aluno['aluno_id']; ?>
                    </td>
                    <td>
                        <?= $aluno['nome']; ?>
                    </td>
                    <th style="padding: 32px;width: 90px;">
                      <a
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Aluno/ShowController.php?id=<?= $aluno['aluno_id']; ?>"
                        class="icon-link"
                      >
                        <i class="fa-regular fa-eye"></i>
                      </a>

                      <br>
                      <br>
                      <hr>
                      <br>

                      <a
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Aluno/EditController.php?id=<?= $aluno['aluno_id']; ?>"
                        class="icon-link edit"
                      >
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <br><br>

                      <a
                        href="#"
                        onclick="if (confirm('Deseja excluir mesmo?')) {
                          this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Aluno/DeletarController.php?id=<?= $aluno['aluno_id']; ?>';
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
