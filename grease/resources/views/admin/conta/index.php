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

include $_ENV['PASTA_CONTROLLER'] . '/Conta/ConsultaController.php';

ChamaSamu::debug($contas);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];

  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 4) {
    unset($_SESSION['fed_conta']);
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
  Contas Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_conta']) && !empty($_SESSION['fed_conta'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_conta']['title']; ?>',
      text: '<?php echo $_SESSION['fed_conta']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_conta']['icon']; ?>',
      confirmButtonText: 'OK'
    })
  </script>
  <?php endif; ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>

      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"> <span class="text"><h1>Contas</h1></span> </div> 

          <div>
             <a href="<?= $_ENV['ROUTE'] ?>admin.conta.create" class="button-link" style="background-color: #28a745;">
              Nova Conta
            </a>
          </div>
        </div>


      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"><span class="text">Itens</span></div>

          <div class="dropdown">
            <a target="_blank" href="<?= $_ENV['ROUTE'] ?>admin.conta.relatorio" class="dropbtn" style="text-decoration: none;">
              Exportar
            </a>
          </div>
        </div>

        <?php if (isset($contas) || !empty($contas)) { ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Titulo</th>
                    <th>Descrição</th>
                    <th>Data Vencimneto</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contas as $conta): ?>
                <tr>
                    <td>  
                        <?= $conta['usuario']? $conta['usuario'] : 'N/A'; ?>
                    </td>
                    <td>
                        <?= $conta['titulo']? $conta['titulo'] : 'N/A'; ?>
                    </td>
                    <td>
                        <?= $conta['descricao']? $conta['descricao'] : 'N/A'; ?>
                    </td>
                    <td>
                        <?= $conta['data_validade']? date('d-m-Y', strtotime($conta['data_validade'])) : 'N/A'; ?>
                    </td>
                    <td style="color: <?= ($conta['status_conta'] == 1)? 'green' : 'red'; ?>;">
                        <strong>
                            <?php if($conta['status_conta'] == 1) {
                              echo 'Pago';
                            } elseif ($conta['status_conta'] == 0) {
                              echo 'Não Pago'; 
                            } else {
                              echo 'N/A'; 
                            }?>
                          </strong>
                    </td>

                    <th style="padding: 32px;width: 90px;">
                      <a
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Conta/ShowController.php?id=<?= $conta['conta_id']; ?>"
                        class="icon-link"
                      >
                        <i class="fa-regular fa-eye"></i> 
                      </a>

                      <br>
                      <br>
                      <hr>
                      <br>

                      <a
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Conta/EditController.php?id=<?= $conta['conta_id']; ?>"
                        class="icon-link edit"
                      >
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <br><br>

                      <a
                        href="#"
                        onclick="if (confirm('Deseja excluir mesmo?')) {
                          this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Conta/DeletarController.php?id=<?= $conta['conta_id']; ?>';
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
