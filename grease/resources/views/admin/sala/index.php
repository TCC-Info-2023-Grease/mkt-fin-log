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

    if (time() - $ultimo_acesso > 3) {
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
            <div style="text-align: right;">
                <a href="<?php echo $_ENV['ROUTE'] ?>admin.sala.create" class="button-link btn-edit">
                    Nova entrada
                </a>
            </div>


            <div class="title"> <span class="text">Caixa Sala</span> </div>

            <?php if (isset($data['sala']) && !empty($data['sala'])) { ?>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Obs</th>
                        <th>Tipo Movimentação</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <style type="text/css">
                    th a i {
                        font-size: 1.7rem;
                    }
                    </style>
                    <?php foreach ($data['sala'] as $sala): ?>
                    <tr>
                        <td>
                            <?= $sala['nome_usuario']; ?>
                        </td>
                        <td>
                            <?= Money::format($sala['valor']); ?>
                        </td>
                        <td>
                            <?= date('d/m/Y', strtotime($sala['data_movimentacao'])); ?>
                        </td>
                        <td>
                            <?= $sala['tipo_movimentacao']; ?>
                        </td>
                        <td>
                            <?= $sala['descricao']; ?>
                        </td>
                        <td>
                            <?= $sala['obs']; ?>
                        </td>
                        <th style="padding: 26px;">
                            <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Sala/ShowController.php?id=<?= $sala['caixa_id']; ?>"
                                class="icon-link ">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <br>
                            <br>
                            <hr>
                            <br>

                            <!-- <a href="#" onclick="if (confirm('Deseja excluir mesmo?')) {
                                   this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Sala/DeletarController.php?id=<?= $sala['caixa_id']; ?>';
                               }" class="icon-link delete">
                                <i class="fa-solid fa-trash"></i>
                            </a> -->
                            <a href="#" onclick="if (confirm('Deseja editar mesmo?')) {
                                   this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Sala/EditController.php?id=<?= $sala['caixa_id']; ?>';
                               }" class="icon-link edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </th>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php } else { ?>
            <h3>Sem dados</h3>
            <?php } ?>
        </div>
    </section>

    <?php
    use_js_scripts(['js.admin.financas']);
    ?>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>
</body>
<!-------/ BODY --------->