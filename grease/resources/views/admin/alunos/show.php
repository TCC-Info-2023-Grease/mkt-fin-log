<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('adm');

if (!isset($_POST) && empty($_POST)) navegate($_ENV['VIEWS']. '/adm/alunos/');

import_utils([
  'extend_styles',
  'use_js_scripts',
  'render_component',
  'Money'
]);

global $_ENV;

$aluno = $_POST;

$aluno['movimentacoes'] = json_decode($aluno['movimentacoes']);

//print_r($aluno);
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['css.admin.financas']);
?>
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
          <a
            href="#"
            class="button-link btn-delete"
            onclick="if (confirm('Deseja excluir mesmo?')) {
               this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Aluno/DeletarController.php?id=<?= $aluno['aluno_id']; ?>';
           }"
          >
            <i class="fa-solid fa-trash"></i>
          </a>
        <span class="button-separator">|</span>
        <a href="#"
          class="button-link btn-edit"
          onclick="if (confirm('Deseja editar mesmo?')) {
           this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Aluno/EditController.php?id=<?= $aluno['aluno_id']; ?>';
          }"
        >
          <i class="fa-solid fa-pen"></i>
        </a>
      </div>

      <div class="overview">
        <div class="title"> <span class="text">Informações do Aluno</span> </div>

        <div class="activity">
          <div class="activity-data">
            <div class="data names">
              <span class="data-title">Nome</span>
              <span class="data-list">
                <?= $aluno['nome']; ?>
              </span>
            </div>

            <div class="data names">
              <span class="data-title"
                style="
                  margin-right: 13px;
                "
              >
                Total Pago:
              </span>
              <span
                class="data-list"
                style="
                  border: 2px solid black;
                  padding: 11px;
                  border-radius: 8px;
                  background:
                  <?php if ($aluno['total_pago'] > 0): ?>
                    #61e661
                  <?php else: ?>
                    #e66161
                  <?php endif; ?>;
                "
              >
                <?= Money::format($aluno['total_pago']); ?>
              </span>
            </div>
          </div>
        </div>

        <br><br><br>
          <hr>


          <div class="dash-content" style="padding-top: 1.1rem;">
              <?php if (isset($aluno['movimentacoes']) || !empty($aluno['movimentacoes'])) { ?>
              <div style="display: flex;justify-content: space-between;align-items: center;">
                <div class="title"><span class="text">Movimentações</span></div>

                <div class="dropdown">
                  <button onclick="toggleDropdown()" class="dropbtn">Exportar</button>
                  <div id="myDropdown" class="dropdown-content">
                    <button onclick="exportToPDF()">PDF</button>
                    <button onclick="exportToExcel()">Excel</button>
                  </div>
                </div>
              </div>

              <table id="myTable" class="display">
                <caption>Caixa</caption>
                <thead>
                  <tr>
                    <th>Admin</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($aluno['movimentacoes'] as $item): ?>
                  <tr>
                    <td>
                      <?= $item->nome_usuario; ?>
                    </td>
                    <td>
                      <?= Money::format($item->valor); ?>            
                    </td>
                    <td>
                      <?= date('d/m/Y', strtotime($item->data_movimentacao)); ?>
                    </td>
                    <td>
                      <a 
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Sala/ShowController.php?id=<?= $item->caixa_id; ?>"
                        class="icon-link "
                      >
                        <i class="fa-regular fa-eye" style="font-size: 1.15rem!important;"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <?php } else { ?>
              <h3>Sem inserções no caixa</h3>
              <?php } ?>
            </div>
        </div>
      </div>
    </div>
  </section>

  <?php
    use_js_scripts([ 
      'js.lib.xlsx',
      'js.lib.jspdf',
      'js.lib.jspdf_plugin_autotable',
      'js.services.ExportTabelaCaixa',
      'js.admin.financas'
    ]);
  ?>
</body>
<!-------/ BODY --------->
