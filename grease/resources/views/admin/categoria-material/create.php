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
  if(time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_categoria_material']);
  }
} 
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.admin.financas' ]);
?>
<title>
  Finanças Admin 🕺 Grease
</title>
<!------- /HEAD --------->


<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_categoria_material']) && !empty($_SESSION['fed_categoria_material'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_categoria_material']['title']; ?>',
      text: '<?php echo $_SESSION['fed_categoria_material']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_categoria_material']['icon']; ?>',
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
            <span class="text">Cadastro Materiais</span>
          </div>

          <form 
      			method="POST" 
      			action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/CategoriaMaterial/CadastroController.php"
    		  >
    			<label for="nome">Nome:</label>
    			<input type="text" name="nome" placeholder="Corda de arame...">
    			<br>
    			<br>
    				
    			<input type="submit" value="salvar">
    		</form>
      </div>
    </div>
  </section>


  <?php
  use_js_scripts([ 'js.lib.maskMoney'  ]);
  use_js_scripts([ 'js.admin.financas' ]);
  ?> 
</body>