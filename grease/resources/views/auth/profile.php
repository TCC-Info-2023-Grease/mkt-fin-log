<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '\config.php';
global $_ENV;

//print_r($_POST);
$usuarioData = [$_POST];

import_utils(['extend_styles', 'render_component']);
?>


<!------- HEAD --------->
<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
  Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!-------/ BODY --------->

<body>
  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/header.php';
  ?>
 <br><br>


  <table id="myTable" class="display">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Foto</th>
        <th>Email</th>
        <th>Idade</th>
        <th>Genero</th>
        <th>Celular</th>
        <th>CPF</th>
      </tr>
    </thead>

    <tbody>
      <?php if ($usuarioData): ?>
        <?php foreach ($usuarioData as $usuario): ?>
        <tr>
          <td>
            <?= $usuario['nome']; ?>            
          </td>
          <td>
            <?= $usuario['tipo_usuario']; ?>
          </td>
          <td>
            <img 
              width="300px" 
              src="<?= $_ENV['STORAGE'] . '/image/usuarios/' . $usuario['foto_perfil']; ?>"
              alt="<?= $usuario['nome']; ?>" 
            />
          </td>
          <td>
            <?= $usuario['email']; ?>
          </td>
          <td>
            <?= $usuario['idade']; ?>
          </td>
          <td>
            <?php if ($usuario['genero'] == 'm') { ?> 
              Masculino
            <?php } else if ($usuario['genero'] == 'f') { ?> 
              Feminino
            <?php } else { ?> 
              Outro
            <?php } ?> 
          </td>
          <td>
            <?= $usuario['celular']; ?>
          </td>
          <td>
            <?= $usuario['cpf']; ?>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>


  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
  ?>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>
<!-------/ BODY --------->