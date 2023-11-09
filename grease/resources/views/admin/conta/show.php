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
  'Money',
  'Mascara'
]);

global $_ENV;

$conta = $_POST;

#ChamaSamu::debug($conta);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
    $ultimo_acesso = $_SESSION['ultimo_acesso'];
    // Verifica se já passaram 5 minutos desde o último acesso
    if(time() - $ultimo_acesso >= 2) {
      unset($_SESSION['fed_conta']);
    }
  }
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['css.admin.financas']);
?>
<title>
  Conta Admin 🕺 Grease
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
            <div class="title"> <span class="text"><h1>Conta</h1></span> </div> 

            <a href="#" class="button-link btn-delete" onclick="if (confirm('Deseja excluir mesmo?')) {
               this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Conta/DeletarController.php?id=<?= $conta['conta_id']; ?>';
           }">
                <i class="fa-solid fa-trash"></i>
            </a>
            <span class="button-separator">|</span>
            <a href="#" class="button-link btn-edit" onclick="if (confirm('Deseja editar mesmo?')) {
               this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Conta/EditController.php?id=<?= $conta['conta_id']; ?>';
           }">
                <i class="fa-solid fa-pen"></i>
            </a>
            <span class="button-separator">|</span>
            <a href="#" class="button-link btn-edit" onclick="if (confirm('Deseja editar mesmo?')) {
               this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Conta/EfetuarPagamentoController.php?id=<?= $conta['conta_id']; ?>';
            }">
                <i class="fa-solid fa-pen"></i>
            </a>
        </div>

        <div class="overview">
            <div class="title"> <span class="text">Informações da Conta</span> </div>

            <div class="activity">
                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Título</span>
                        <span class="data-list">
                            <?= $conta['titulo']; ?>
                        </span>
                    </div>

                
                    <div class="data names">
                        <span class="data-title">Valor</span>
                        <span class="data-list">
                            <?= Money::format($conta['valor']); ?>
                        </span>
                    </div>

                    <div class="data names">
                        <span class="data-title">Status</span>
                        <span class="data-list" style="color: <?= ($conta['status_conta'] == 1)? 'green' : 'red'; ?>;">
                            <strong class="icon-link <?= ($conta['status_conta'] == 1)? 'edit' : 'delete'; ?>">
                                <?php if($conta['status_conta'] == 1) {
                                    echo 'Pago';
                                } elseif ($conta['status_conta'] == 0) {
                                    echo 'Não Pago'; 
                                } else {
                                    echo 'N/A'; 
                                }?>
                            </strong>
                        </span>
                        <br>
                    </div>
                </div>
                <br><br>

                <div class="activity-data">
                    <div class="data names">
                            <span class="data-title">Descrição</span>
                            <span class="data-list">
                                <details>
                                    <summary>Mostrar</summary>
                                    <br>
                                    <?= !empty($conta['descricao']) ? $conta['descricao'] : 'N/A'; ?>
                                </details>
                            </span>
                        </div>
                    </div>
            </div>
            <br><br>

            <div class="activity">
                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Data de Validade</span>
                        <span class="data-list">
                            <?= date('d-m-Y', strtotime($conta['data_validade'])); ?>
                        </span>
                    </div>
                    <br><br>

                    <div class="data names">
                        <span class="data-title">Data de Inserção</span>
                        <span class="data-list">
                            <?= date('d-m-Y', strtotime($conta['data_insercao'])); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br>
        <hr>

        <div class="overview">
            <div class="title"> <span class="text">Informações do  Admin</span> </div>

            <div class="activity">
                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Nome</span>
                        <span class="data-list">
                            <?= $conta['usuario']; ?>
                        </span>
                    </div>

                    <div class="data names">
                        <span class="data-title">Email</span>
                        <span class="data-list">
                            <?= $conta['usuario_email']; ?>
                        </span>
                    </div>

                    <div class="data names">
                        <span class="data-title">CPF</span>
                        <span class="data-list">
                            <?= Mascara::mascararCPF($conta['cpf']); ?>
                        </span>
                    </div>
                </div>
            </div>

            <br><br><br>
        <hr>

        <div class="overview">
            <div class="title"> <span class="text">Informações do  Fornecedor</span> </div>

            <div class="activity">
                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Nome</span>
                        <span class="data-list">
                            <?= $conta['fornecedor']? $conta['fornecedor'] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="data names">
                        <span class="data-title">Email</span>
                        <span class="data-list">
                            <?= $conta['fornecedor_email']? $conta['fornecedor_email'] : 'N/A'; ?>
                        </span>
                    </div>

                    <div class="data names">
                        <span class="data-title">CPF</span>
                        <span class="data-list">
                            <?= $conta['cnpj']? $conta['cnpj'] : 'N/A'; ?>
                        </span>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</section>


  <?php
    use_js_scripts([
      'js.admin.financas'
    ]);
  ?>
</body>
<!-------/ BODY --------->
