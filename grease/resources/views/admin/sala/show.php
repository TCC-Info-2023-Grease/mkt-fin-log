<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('adm');
 
if (!isset($_POST) && empty($_POST)) navegate($_ENV['VIEWS']. '/adm/usuarsala/');

import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money'
]);

global $_ENV;   

//print_r($_POST);
$data = $_POST;
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
                <a href="#" class="button-link btn-edit" onclick="if (confirm('Deseja editar mesmo?')) {
                       this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Sala/EditController.php?id=<?= $data['caixa_id']; ?>';
                   }">
                    <i class="fa-solid fa-pen"></i>
                </a>
            </div>

            <div class="overview">
                <div class="title"> <span class="text">Informações da Movimentação</span> </div>

                <div class="activity">
                    <div class="activity-data">
                        <div class="data names">
                            <span class="data-title">Tipo Movimentação</span>

                            <span class="data-list">
                                <?= $data['tipo_movimentacao']; ?>
                            </span>
                        </div>

                        <div class="data names">
                            <span class="data-title">Valor</span>

                            <span class="data-list">
                                <?= Money::format($data['valor']); ?>
                            </span>
                        </div>

                        <div class="data names">
                            <span class="data-title">Data</span>

                            <span class="data-list">
                                <?= date('d/m/Y', strtotime($data['data_movimentacao'])); ?>
                            </span>
                        </div>
                    </div>
                    <br><br>

                    <div class="activity-data">
                        <div class="data names">
                            <span class="data-title">Descrição</span>

                            <span class="data-list">
                                <?= !empty($data['descricao'])? $data['descricao'] : 'N/A'; ?>
                            </span>
                        </div>
                    </div>
                    <br><br>

                    <div class="activity-data">
                        <div class="data names">
                            <span class="data-title">Obs</span>

                            <span class="data-list">
                                <?= !empty($data['obs'])? $data['obs'] : 'N/A'; ?>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <br><br>
            <hr>

            <div class="overview">
                <div class="title"> <span class="text">Informações do Aluno</span> </div>

                <div class="activity">
                    <div class="activity-data">
                        <div class="data names" style="display: inline-block;">
                            <span class="data-title" style="margin-right: 12px;">Nome</span>
                            <span class="data-list">
                                <?= $data['nome']; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <hr>


                <div class="overview">
                    <div class="title"> <span class="text">Informações do Admin</span> </div>

                    <div class="activity">
                        <div class="activity-data">
                            <div class="data names">
                                <span class="data-list">
                                    <img style="border-radius: 50%;border: 4px solid black;padding: 2px" width="200px"
                                        src="<?php 
                                        if (isset($data['foto_perfil']) && !empty($data['foto_perfil'])) {
                                          echo $_ENV['STORAGE']. '/image/usuarios/' .$data['foto_perfil'];
                                        } else {
                                          echo $_ENV['STORAGE']. '/image/usuarios/profile_default.png';  
                                        }
                                      ?>" alt="<?= $data['nome']; ?>" />
                                </span>
                            </div>
                            <div class="data names">
                                <span class="data-title">Nome</span>
                                <span class="data-list">
                                    <?= $data['nome']; ?>
                                </span>
                            </div>

                            <div class="data names">
                                <span class="data-title">Email</span>
                                <span class="data-list">
                                    <?= $data['email']; ?>
                                </span>
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