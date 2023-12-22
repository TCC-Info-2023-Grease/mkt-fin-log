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


//var_dump($_SESSION['fed_aluno']);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 4) {
    unset($_SESSION['fed_aluno']);
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

  <?php if (isset($_SESSION['fed_aluno']) && !empty($_SESSION['fed_aluno'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_aluno']['title']; ?>',
      text: '<?php echo $_SESSION['fed_aluno']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_aluno']['icon']; ?>',
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
            <span class="text">Cadastro de Alunos em Massa</span>
          </div>

          <form 
      			method="POST" 
      			action="<?= $_ENV['URL_CONTROLLERS']; ?>/Aluno/CadastroEmMassaController.php"
    		  >
    			<label for="nome">Nomes</label>
          <p style="margin-top: 0.5rem;">
            Exemplo de uso: Stefano Jobs;Markinhos Zuckeberg;
          </p>
    			<input
            name="nomes_alunos" 
            id="nomes_alunos"
            style="
              resize: none;
              width: 100%;
              height: 40px;
              margin-top: 1rem;
              padding: 1rem;
            "
          />
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