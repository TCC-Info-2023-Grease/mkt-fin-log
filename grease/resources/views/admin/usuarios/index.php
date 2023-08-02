<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['auth']);

Auth::check('adm');

import_utils([
    'extend_styles',
    'use_js_scripts',
    'render_component',
    'Money'
]);

//print_r($_SESSION);

include $_ENV['PASTA_CONTROLLER'] . '/Usuario/ConsultaController.php';

if (isset($_SESSION['ultimo_acesso'])) {
    $ultimo_acesso = $_SESSION['ultimo_acesso'];

    // Verifica se já passaram 5 minutos desde o último acesso
    if (time() - $ultimo_acesso > 100) {
        unset($_SESSION['fed_usuario']);
    }
}
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['css.admin.financas']);
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css"/>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
    Finanças Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
<?php if (isset($_SESSION['fed_usuario']) && !empty($_SESSION['fed_usuario'])): ?>
    <script>
        Swal.fire({
            title: '<?= $_SESSION['fed_usuario']['title']; ?>',
            text: '<?= $_SESSION['fed_usuario']['msg']; ?>',
            icon: '<?= $_SESSION['fed_usuario']['icon']; ?>',
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
          <a href="<?php echo $_ENV['ROUTE'] ?>admin.usuario.create" class="button-link btn-edit">
            Novo Admin
          </a>
        </div>


        <div class="title"> <span class="text">Usuários</span> </div>

        <?php if (isset($data['usuarios']) && !empty($data['usuarios'])) { ?>
            <table id="myTable" class="display">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Idade</th>
                    <th>Tipo Usuário</th>                    
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($data['usuarios'] as $usuario): ?>
                    <tr>
                        <td>
                            <?= $usuario['nome']; ?>
                        </td>
                        <td>
                            <?= $usuario['email']; ?>
                        </td>                       
                        <td>
                            <?= $usuario['idade']; ?>
                        </td>
                        <td>
                            <?= $usuario['tipo_usuario']; ?>
                        </td>
                         <th style="padding: 26px;">
                          <a href="<?= $_ENV['URL_CONTROLLERS']; ?>/Usuario/ShowController.php?id=<?= $usuario['usuario_id']; ?>" class="icon-link ">
                            <i class="fa-regular fa-eye"></i> Ver
                          </a>
                          <br>
                          <br>

                            <a href="#"
                               onclick="if (confirm('Deseja excluir mesmo?')) {
                                   this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Usuario/DeletarController.php?id=<?= $usuario['usuario_id']; ?>';
                               }"
                                class="icon-link delete"
                            >
                                <i class="fa-solid fa-trash"></i> Deletar
                            </a>
                            <br/>
                            <br/>

                            <a href="#"
                               onclick="if (confirm('Deseja editar mesmo?')) {
                                   this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Usuario/EditController.php?id=<?= $usuario['usuario_id']; ?>';
                               }"
                                class="icon-link edit"
                            >
                                <i class="fa-solid fa-pen"></i> Editar
                            </a>
                        </td>
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
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
</body>
<!-------/ BODY --------->
