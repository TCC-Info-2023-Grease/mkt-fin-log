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

$fornecedor = $_POST;

//ChamaSamu::debug($fornecedor);
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
               this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Fornecedor/DeletarController.php?id=<?= $fornecedor['fornecedor_id']; ?>';
           }"
          >
            <i class="fa-solid fa-trash"></i>
          </a>
        <span class="button-separator">|</span>
        <a href="#"
          class="button-link btn-edit"
          onclick="if (confirm('Deseja editar mesmo?')) {
           this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Fornecedor/EditController.php?id=<?= $fornecedor['fornecedor_id']; ?>';
          }"
        >
          <i class="fa-solid fa-pen"></i>
        </a>
      </div>

      <div class="overview">
        <div class="title"> <span class="text">Informações do Fornecedor</span> </div>

        <div class="activity">
          <div class="activity-data">
            <div class="data names">
              <span class="data-title">Nome</span>
              <span class="data-list">
                <?= $fornecedor['nome']; ?>
              </span>
            </div>

            <div class="data names">
              <span class="data-title">Email</span>
              <span class="data-list">
                <?= $fornecedor['email']? $fornecedor['email'] : 'N/A'; ?>
              </span>
            </div>

            <div class="data names">
              <span class="data-title">CNPJ</span>
              <span class="data-list">
                <?= $fornecedor['cnpj']? $fornecedor['cnpj'] : 'N/A'; ?>
              </span>
            </div>
          </div>
        </div>
        <br><br>

        <div class="activity">
          
        <div class="activity-data">
            <div class="data names">
              <span class="data-title">Celular</span>
              <span class="data-list">
                <?= $fornecedor['celular']? $fornecedor['celular'] : 'N/A';  ?>
              </span>
            </div>
            <br><br>

            <div class="data names">
              <span class="data-title">Status</span>
              <span class="data-list">
                <?= $fornecedor['status_fornecedor']? $fornecedor['status_fornecedor'] : 'N/A'; ?>
              </span>
            </div>
          </div>

          <br><br>
          <div class="activity">    
            <div class="data names">
              <span class="data-title">Descrição</span>
              <span class="data-list">
                <details>
                  <summary>Mostrar</summary>
                  <br>

                  <?= !empty($fornecedor['descricao'])? $fornecedor['descricao'] : 'N/A'; ?>
                </details>
              </span>
            </div>
          </div>
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
