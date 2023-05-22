<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';

include $_ENV['PASTA_CONTROLLER'] . '/Material/ConsultaController.php';
//print_r($materiais);
global $_ENV;   
?>

<!------- HEAD --------->
<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    
    Material        
    <br><br>

    |   
    <a href="<?php echo $_ENV['ROUTE'] ?>admin.material.create">
        Novo Material
    </a>
    <br><br><br>

    <table id="myTable" class="display">
        <thead>
            <tr>
                <th># ID</th>
                <th>Nome</th>
                <th>Foto Material</th>
                <th>Descrição</th>
                <th>Categoria</th>   
                <th>Status</th> 
                <th>Actions</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materiais as $material): ?>
            <tr>
                <td>
                    <?php echo $material['material_id']; ?>
                </td>
                <td>
                    <?php echo $material['nome']; ?>
                </td>
                <td>
                    <img 
                        width="100px"
                        src="<?php echo $_ENV['STORAGE'].  '/' .$material['foto_material']; ?>" 
                        alt="<?php echo $material['nome']; ?>" />
                </td>
                <td>
                    <?php echo $material['descricao']; ?>
                </td>   
                <td>
                    <?php echo $material['nome_categoria']; ?>
                </td>
                <td>
                    <?php echo $material['status_material']; ?>
                </td>
                <td>
                    <a href="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Material/EditController.php?id=<?php echo $material['material_id']; ?>">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>

                    <br><br>    
                    
                    <a href="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Material/DeletarController.php?id=<?php echo $material['material_id']; ?>">
                        <i class="fa-solid fa-trash"></i>
                    </a>
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
<!-------/ BODY --------->