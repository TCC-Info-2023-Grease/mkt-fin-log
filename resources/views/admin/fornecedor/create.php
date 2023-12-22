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


//var_dump($_SESSION['fed_fornecedor']);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 4) {
    unset($_SESSION['fed_fornecedor']);
  }
} 
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.admin.financas' ]);
?>
<title>
  Fornecedor Admin 🕺 Grease
</title>
<!------- /HEAD --------->


<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_fornecedor']) && !empty($_SESSION['fed_fornecedor'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_fornecedor']['title']; ?>',
      text: '<?php echo $_SESSION['fed_fornecedor']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_fornecedor']['icon']; ?>',
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
            <span class="text">Cadastro Fornecedor</span>
          </div>
          * Campos Obrigatorios
          <br><br>

          <form 
      			method="POST" 
      			action="<?= $_ENV['URL_CONTROLLERS']; ?>/Fornecedor/CadastroController.php"
    		  >
            <input type="hidden" name="status_fornecedor" value="ativo" />

      			<label for="nome">* Nome:</label>
      			<input type="text" name="nome" placeholder="Manoel Gomes" required />
      			<br>
      			<br>

            <label for="email">CNPJ:</label>
            <input type="text" name="cnpj" class="cnpj" placeholder="XX. XXX. XXX/0001-XX" />
            <br>
            <br>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="caneta.azul@laele.com" />
            <br>
            <br>

            <label for="ender">Endereço:</label>
            <input type="text" name="ender" placeholder="Rua Lá Ele" />
            <br>
            <br>

            <label for="celular">Celular:</label>
            <input type="text" class="text phone"  name="celular" placeholder="(11) 89341-2345" />
            <br>
            <br>

            <label for="descricao">Descrição:</label><br>
            <textarea name="descricao" id="" cols="30" rows="3"
                placeholder=" Fornecedor de...">
            </textarea>
            <br><br>
    				
    			 <input type="submit" value="salvar">
    		</form>
      </div>
    </div>
  </section>


  <?php
  use_js_scripts([ 'js.lib.maskMoney', 'js.admin.financas', 'js.masksForInputs' ]);
  ?> 
</body>