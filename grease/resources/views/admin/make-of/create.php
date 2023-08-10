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

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 2) {
    unset($_SESSION['fed_makeof']);
  }
} 
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.admin.financas' ]);
?>
<title>
  Admin 🕺 Grease
</title>
<!------- /HEAD --------->


<body>
  <?php
  render_component('sidebar');
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


   <section class="dashboard">

    <div class="top">
      <i class="uil uil-bars sidebar-toggle"></i>
    </div>
    <div class="dash-content">
        <div class="overview">
          <div class="title">
            <span class="text">Cadastro Make Of</span>
          </div>

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

          <label for="titulo">Titulo:</label><br>
          <input 
            type="text" 
            name="titulo" 
            required
          />
          <br><br>

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
          <br><br>

          <label for="uri">Link Make Ofs</label>
          <input 
            type="text" 
            name="uri" 
            required      
          />   
          <br><br>
          
          <input type="submit" value="salvar">
        </form>
      </div>
    </div>
  </section>


  <?php
  use_js_scripts([ 'js.admin.financas' ]);
  ?> 
</body>