<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('adm');
if (!isset($_POST) && empty($_POST)) navegate($_ENV['VIEWS']. '/adm/caixa/');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money'
]);


//print_r($_POST);
$caixa = $_POST;
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

    <section class="dashboard">
        <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>
        <div class="dash-content">
            <div style="text-align: right;">
                <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.entrada.create" class="button-link" style="background-color: #28a745;">
                    Nova Entrada
                </a>
                <span class="button-separator">|</span>
                <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.saida.create" class="button-link" style="background-color: #dc3545;">
                    Nova Saída
                </a>
            </div>

            <div class="overview">
                <div class="title"> <span class="text">Informações da Movimentação</span> </div>

                <div class="activity">
                    <div class="activity-data">
                        <div class="data names">
                            <span class="data-list">
                                <img style="border-radius: 50%;border: 4px solid black;padding: 2px" width="200px"
                                    src="<?= $_ENV['STORAGE'].  '/image/usuarios/' .$caixa['foto_perfil']; ?>"
                                    alt="<?= $caixa['nome']; ?>" />
                            </span>
                        </div>

                        <div class="data names">
                            <span class="data-title">
                                Usúario
                            </span>

                            <span class="data-list">
                                <?= $caixa['nome_usuario']; ?>
                            </span>
                        </div>

                        <div class="data names">
                            <span class="data-title">Valor</span>

                            <span class="data-list">
                                <?= Money::format($caixa['valor']); ?>
                            </span>
                        </div>

                        <div class="data names">
                            <span class="data-title">Data</span>

                            <span class="data-list">
                                <?= date('d/m/Y', strtotime($caixa['data_movimentacao'])); ?>
                            </span>
                        </div>
                    </div>
                    <br><br>

                    <div class="activity-data">
                        <div class="data names">
                            <span class="data-title">Tipo Movimentação</span>

                            <span class="data-list">
                                <?= $caixa['tipo_movimentacao']; ?>
                            </span>
                        </div>


                        <div class="data names">
                            <span class="data-title">Categoria</span>

                            <span class="data-list">
                                <?= $caixa['categoria']; ?>
                            </span>
                        </div>


                        <div class="data names">
                            <span class="data-title">Forma de Pagamento</span>

                            <span class="data-list">
                                <?= $caixa['forma_pagamento']; ?>
                            </span>
                        </div>
                    </div>
                    <br><br>

                    <div class="activity-data">
                        <div class="data names">
                            <span class="data-title">Descrição</span>

                            <br>
                            <details>
                                <summary>Mostrar</summary>
                                <br>

                                <?= !empty($caixa['descricao'])? $caixa['descricao'] : 'N/A'; ?>
                            </details>
                        </div>
                    </div>
                    <br><br>

                    <div class="activity-data">
                        <div class="data names">
                            <span class="data-title">Obs</span>

                            <br>
                            <details>
                                <summary>Mostrar</summary>
                                <br>
                                
                                <?= !empty($caixa['obs'])? $caixa['obs'] : 'N/A'; ?>
                            </details>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>

    <?php
  use_js_scripts([ 'js.admin.financas' ]);
  ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
</body>
<!-------/ BODY --------->