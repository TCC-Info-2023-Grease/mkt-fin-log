<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

$categoria_material = new CategoriaMaterial($mysqli);
$categorias = $categoria_material->buscarTodos();

import_utils(['extend_styles', 'render_component']);
?>

<!------- HEAD --------->
<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
    Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/header.php';
    ?>

    Categoria dos Materiais
    <br>

    <a href="<?php echo $_ENV['ROUTE'] ?>admin.categoria_material.create">
        Nova Categoria
    </a>


    <table id="myTable" class="display">
        <thead>
            <tr>
                <th># ID</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td>
                    <?php echo $categoria['categoria_id']; ?>
                </td>
                <td>
                    <?php echo $categoria['nome']; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
</body>
<!------- /BODY --------->
