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

include $_ENV['PASTA_CONTROLLER'] . '/Sala/ConsultaController.php';

//var_dump($data);

if (isset($_SESSION['ultimo_acesso'])) {
    $ultimo_acesso = $_SESSION['ultimo_acesso'];

    if (time() - $ultimo_acesso > 5) {
        unset($_SESSION['fed_sala']);
    }
}
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['css.admin.financas']);
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
    Finanças Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->

<body>
    <?php if (isset($_SESSION['fed_sala']) && !empty($_SESSION['fed_sala'])): ?>
    <script>
    Swal.fire({
        title: '<?= $_SESSION['fed_sala']['title']; ?>',
        text: '<?= $_SESSION['fed_sala']['msg']; ?>',
        icon: '<?= $_SESSION['fed_sala']['icon']; ?>',
        confirmButtonText: 'OK'
    })
    </script>
    <?php endif; ?>

    <?php
    render_component('sidebar');
    ?>

    <section class="dashboard">
        <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>

        <div class="dash-content">
            <div style="display: flex;justify-content: space-between;align-items: center;">
              <div class="title"> <span class="text"><h1>Caixa Sala</h1></span> </div> 

              <div>
                   <a href="<?= $_ENV['ROUTE'] ?>admin.sala.create" class="button-link btn-edit">
                    Nova Entrada
                  </a>
              </div>
            </div>
        </div>


        <div class="dash-content">
          <div class="boxes">
             <div 
                class="box 
                <?php if ($data['totalPagamentos'] <= 0): ?>
                    box3
                <?php elseif ($data['totalPagamentos'] > 0): ?>
                    box1
                <?php endif; ?>
              ">     
                <span class="text">Saldo Atual</span> 
                <span class="number">
                   <?= Money::format($data['totalPagamentos']); ?>
                </span> 
              </div>

              <div 
                class="box 
                    box2
              ">              
                <span class="text">Total Devedores do Mês</span> 
                <span class="number">
                    <?= abs($data['totalAlunosPagantes'] - count($data['totalAlunos'])); ?>
                </span> 
              </div> 
              
              <div class="box
                <?php if ($data['totalAlunosPagantes'] <= $data['alunosDevedores']): ?>
                    box2
                <?php elseif ($data['totalAlunosPagantes'] > $data['alunosDevedores']): ?>
                    box1
                <?php endif; ?>
                "> 
                    <span class="text">Total Alunos Pagantes</span> 
                    <span class="number">
                        <?= $data['totalAlunosPagantes']; ?>
                    </span> 
                </div>          
            </div>
        </div>

        <div class="dash-content">
            <hr color="black" />
        </div>

        <div class="dash-content">
          <center style="margin-bottom: 46px;"><h2>Estatisticas</h2></center>

          <div class="dash-estatistics">
             <div class="title"><span class="text">Pagamentos por mês</span></div>

            <details>
                <summary>Ver mais...</summary>
                <center>

                <style type="text/css">
                    table.pagamentosPorMes {
                        border-radius: 12px;
                        margin: 2rem 0;
                        /*border: 3px solid rgba(0, 0, 0, 0.7);
                        padding: 1rem;*/
                    }

                    table.pagamentosPorMes thead {
                        background: #f3f3f3;
                        border: 3px solid black;
                    }

                    table.pagamentosPorMes th {
                        padding: 0.5rem;
                    }

                    table.pagamentosPorMes td {
                        padding: 1rem;
                    }
                </style>

                <?php if (isset($data['pagamentosPorMes']) || !empty($data['pagamentosPorMes'])): ?>
                    <table class="pagamentosPorMes" style="width: 80%!important;text-align: center;" cellpadding="19px" cellspacing="5px"> 
                        <thead>
                            <tr>
                                <th>Mês</th>
                                <th>Valor Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            <style type="text/css">
                            th a i {
                                font-size: 1.7rem;
                            }
                            </style>
                            <?php foreach ($data['pagamentosPorMes'] as $item): ?>
                                <tr>
                                    <td>
                                        <?= $item['mes'] ?>
                                    </td>
                                    <td>
                                        <?= Money::format($item['total']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <br>
                    <h3>Sem dados</h3>
                <?php endif ?>
                </center>
            </details>
          </div>
        </div>

         <div class="dash-content">
          <div class="dash-estatistics">
                <div class="title"><span class="text">Top Pagadores</span></div>

                <details>
                  <summary>Ver mais...</summary>
                  
                  <br>        

                  <style>
                      .rank div {
                        width: 150px;
                        padding: 10px;
                        display: inline-block;
                        word-break: break-all;
                        height: 50px;
                        background: whitesmoke;
                        color: whitesmoke;
                        border-radius: 13px;
                        border-bottom: 2px solid #3a3b3c;
                      }

                      .rank div:hover {
                        cursor: pointer;
                        transform: scale(1.3);
                        transition: .45s all;
                      }

                      .rank div:not(:last-child) {
                        margin-right: 35px;
                      }

                      .rank .rank__1 {
                        height: 120px;
                        background: #fe9b35;
                      }
                      .rank .rank__2 {
                        height: 90px;
                        background: #9e9c9c;
                      }
                      .rank .rank__3 {
                        height: 60px;
                        background: #9a4b0ab5;
                      }

                      .rank div {
                        display: flex;
                        justify-content: center;
                        align-content: center;
                      } 
                  </style>
                    <center 
                        style="    
                            display: flex;
                            justify-content: center;
                            align-items: flex-end;
                            padding: 23px;
                            width: 100%;
                        " 
                        class="rank"
                    >
                        <div class="rank__3">
                        <?= 
                            isset($data['rankingTopPagantes'][2]['nome_aluno']) ||
                            !empty($data['rankingTopPagantes'][2]['nome_aluno'])? 
                                $data['rankingTopPagantes'][2]['nome_aluno'] : 'N/A'; 
                        ?> 
                        </div>

                        <div class="rank__1">
                        <?= 
                            isset($data['rankingTopPagantes'][0]['nome_aluno']) ||
                            !empty($data['rankingTopPagantes'][0]['nome_aluno'])? 
                                $data['rankingTopPagantes'][0]['nome_aluno'] : 'N/A'; 
                        ?> 
                        </div>

                        <div class="rank__2">
                        <?= 
                            isset($data['rankingTopPagantes'][1]['nome_aluno']) ||
                            !empty($data['rankingTopPagantes'][1]['nome_aluno'])? 
                                $data['rankingTopPagantes'][1]['nome_aluno'] : 'N/A'; 
                        ?>      
                        </div>
                    </center>
                </details>
          </div>
        </div>

        <div class="dash-content">
          <div class="dash-estatistics">
            <div class="title"><span class="text">Porcentagem Devedores X Pagadores</span></div>

            <details>
              <summary>Ver mais...</summary>
                <br>        

                <center style="    
                    display: flex;
                    align-items: center;
                    justify-content: space-around;
                    flex-direction: row;
                    flex-wrap: wrap;
                    padding: 23px;
                ">
                    <span style="
                    ">
                        <strong style="
                            border: 2px solid black; padding: 12px;border-radius: 4px;margin-right: 3px;
                            background: #55f954;
                        ">
                            Pagadores:
                        </strong> 
                        <span style="border: 2px solid black; padding: 12px;border-radius: 4px;margin-right: 12px;">
                            <?= $data['porcentagem_pagantes']; ?>%
                        </span>
                    </span>
                    <span>
                        <strong style="
                            border: 2px solid black; padding: 12px;border-radius: 4px;margin-right: 3px;
                            background: #ff0b65;
                        ">
                            Devedores:
                        </strong> 
                        <span style="border: 2px solid black; padding: 12px;border-radius: 4px;margin-right: 12px;">
                            <?= $data['porcentagem_devedores']; ?>%
                        </span>
                    </span>
                </center>
                <br>
            </details>
          </div>

          <br>
        </div>

        <br>
        <div style="width: 100%;">
            <hr color="black" />
        </div>

        <br>
        <div class="dash-content" style="padding-top: 0px;">
            <?php if (isset($data['sala']) && !empty($data['sala'])) { ?>
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
                <div>
                   <a href="<?= $_ENV['ROUTE'] ?>admin.sala.create" class="button-link btn-edit">
                    Nova Entrada
                  </a>
                </div>
                <br>    

                <table id="myTable" class="display" style="width: 100%!important;"> 
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Data</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($data['sala'] as $sala): ?>
                        <tr>
                            <td>
                                <?= $sala['nome_aluno']; ?>
                            </td>
                            <td>
                                <?= Money::format($sala['valor']); ?>
                            </td>
                            <td>
                                <?= date('d/m/Y', strtotime($sala['data_movimentacao'])); ?>
                            </td>
                            <th style="padding: 26px;">
                                <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Sala/ShowController.php?id=<?= $sala['caixa_id']; ?>"
                                    class="icon-link ">
                                    <i class="fa-regular fa-eye" style="font-size: 1.15rem!important;"></i>
                                </a>
                                <br>
                                <br>
                                <hr>
                                <br>

                                <!-- <a href="#" onclick="if (confirm('Deseja excluir mesmo?')) {
                                       this.href = '<?php //$_ENV['URL_CONTROLLERS']; ?>/Sala/DeletarController.php?id=<?php //$sala['caixa_id']; ?>';
                                   }" class="icon-link delete">
                                    <i class="fa-solid fa-trash"></i>
                                </a> -->
                                <a href="#" onclick="if (confirm('Deseja editar mesmo?')) {
                                       this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Sala/EditController.php?id=<?= $sala['caixa_id']; ?>';
                                   }" class="icon-link edit">
                                    <i class="fa-solid fa-pen" style="font-size: 1.15rem!important;"></i>
                                </a>
                            </th>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <br>
                <h3>Sem dados</h3>
            <?php } ?>
        </div>

        <br><br>
    </section>

    <?php
        use_js_scripts([ 
          'js.lib.xlsx',
          'js.lib.jspdf',
          'js.services.ChartCaixa',
          'js.services.jspdf_plugin_autotable',
          'js.services.ExportTabelaCaixa',
          'js.admin.financas'
        ]);
    ?>    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>
<!-------/ BODY --------->
