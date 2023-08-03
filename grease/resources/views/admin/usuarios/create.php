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
    unset($_SESSION['fed_usuario']);
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

  <?php if (isset($_SESSION['fed_usuario']) && !empty($_SESSION['fed_usuario'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_usuario']['title']; ?>',
      text: '<?php echo $_SESSION['fed_usuario']['msg']; ?>',
      icon: 'warning',
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
            <span class="text">Cadastro Admin</span>
          </div>

		       <div class="activity">
				      <form id="form-cadastro" enctype="multipart/form-data" method="post" action="<?= $_ENV['URL_CONTROLLERS']; ?>/Auth/AdminCadastroController.php">
                    <label for="username">Nome:</label>
                    <input type="text" name="username" placeholder="Stefano Jobs" required><br>
                    <span id="lblErroNome" class="error-msg"></span><br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="stefano@android.com" required><br>
                    <span id="lblErroEmail" class="error-msg"></span><br>

                    <label for="cpf">CPF:</label>
                    <input type="number" name="cpf" required><br>
                    <span id="lblErroCpf" class="error-msg"></span><br>

                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="inputPassword" required>
                    <i class="fas fa-eye-slash" id="togglePassword"></i>                    
                    <br>

                    <label for="age">Idade:</label>
                    <input type="number" name="age" required><br>
                    <span id="lblErroAge" class="error-msg"></span><br>

                    <label for="genrer">Gênero:</label>
                    <select name="genrer" required>
                        <option value="m">Masculino</option>
                        <option value="f">Feminino</option>
                        <option value="o">Outro</option>
                        <option value="n">Não informado</option>
                    </select>
                    <br><br>

                    <label for="phone">Celular:</label>
                    <input type="text" class="phone" name="phone" required><br>
                    <span id="lblErroCelular" class="error-msg"></span><br>

                    <label for="foto_perfil">Foto de Perfil:</label>
                    <input type="file" name="profile_picture[]" required class="input-file"><br><br>

                    <input type="hidden" name="tipo_usuario" value="adm">
                    <input type="submit"  value="Cadastrar">
                </form>
					</div>
      </div>
    </div>
  </section>


  <?php
  use_js_scripts([ 'js.lib.maskMoney'  ]);
  use_js_scripts([ 'js.admin.financas', 'js.masksForInputs' ]);
  ?> 
  <script type="module" src="<?= assets('js/forms/', 'FormCadastroUsuario.js'); ?>"></script>
</body>