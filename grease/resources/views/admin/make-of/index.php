<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
global $_ENV;

import_utils(['auth', 'extend_styles', 'render_component']);

Auth::check('adm');
 
include $_ENV['PASTA_CONTROLLER'] . '/MakeOf/ConsultaController.php';

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_makeof']);
  }
} 
?>

<!------- HEAD --------->
<?php
render_component('head');
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


<!------- BODY --------->
<body>
  <?php
  render_component('header');
  ?>

  <?php if (isset($_SESSION['fed_makeof']) && !empty($_SESSION['fed_makeof'])): ?> 
    <script>
      Swal.fire({
        title: '<?= $_SESSION['fed_makeof']['title']; ?>',
        text: '<?= $_SESSION['fed_makeof']['msg']; ?>',
        icon: '<?= $_SESSION['fed_makeof']['icon']; ?>',
        confirmButtonText: 'OK'

      })
    </script>
  <?php endif; ?>

  Make Of
  <br><br>

  |
  <a href="<?php echo $_ENV['ROUTE'] ?>admin.makeof.create">
    Novo Make Of
  </a>
  <br><br><br>

  <?php if (isset($data['makeOf']) && !empty($data['makeOf'])) { ?>
    <table id="myTable" class="display">
      <thead>
        <tr>
          <th>Titulo</th>
          <th>Descrição</th> 
          <th>Conteudo</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($data['makeOf'] as $item): ?>
        <tr>
          <td>
            <?php echo $item['titulo']; ?>
          </td>
          <td style="width: 300px">
            <?php echo $item['descricao']; ?>
          </td>
          <td style="width: 70px">
            <?php echo $item['uri']; ?> 
          </td>
          <td>
            <a 
              href="#"
              onclick="if (confirm('Deseja excluir mesmo?')) {
                this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/MakeOf/DeletarController.php?id=<?= $item['makeof_id']; ?>';
              }" 
            >
              <i class="fa-solid fa-trash"></i>
            </a>
            <br />      
            <br />
            <br />

            <a 
              href="#"
              onclick="if (confirm('Deseja editar mesmo?')) {
                this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/MakeOf/EditController.php?id=<?= $item['makeof_id']; ?>';
              }" 
            >
              <i class="fa-solid fa-pen"></i>
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php } else { ?>
    <h3>Sem dados</h3>
  <?php } ?>

  <?php
  render_component('footer');
  ?>

  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>
<!-------/ BODY --------->