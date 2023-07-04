<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component']);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
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
//extend_styles(['styles']);
?>

<title>
    Admin 🕺 Grease
</title>
<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"
  type="text/javascript"></script>
<!------- /HEAD --------->

<body>
  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/header.php';
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

  <form 
    action="<?= $_ENV["URL_CONTROLLERS"]; ?>/MakeOf/CreateController.php" 
    method="POST"
    id="frm-entrada"
  >
    <input 
      type="hidden" 
      name="usuario_id" 
      value="<?= $_SESSION['usuario']['usuario_id'] ?>" 
    />
    <br>    

    <label for="titulo">Titulo:</label><br>
    <input 
      type="text" 
      name="titulo" 
      required
    />

    <br>
    <label for="descricao">Descrição:</label><br>
    <textarea 
      name="descricao" 
      id="" 
      cols="30" 
      rows="10" 
      required 
    >
    </textarea>
    <br>

    <label for="uri">Link Make Ofs</label>
    <input 
      type="text" 
      name="uri" 
      required      
    />   
    <br>
    
    <input type="submit" value="salvar">
  </form>

  <?php
  render_component('footer');
  ?>
  <script>
  </script>
</body>