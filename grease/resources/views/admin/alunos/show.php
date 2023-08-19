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

print_r($_POST);
$aluno = $_POST;
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
        </div>
      </div>
    </div>
  </section>

  <?php
  use_js_scripts(['js.admin.financas']);
  ?>
</body>
<!-------/ BODY --------->
