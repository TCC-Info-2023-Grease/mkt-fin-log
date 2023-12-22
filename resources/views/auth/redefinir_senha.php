<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '\config.php';
global $_ENV;

import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'navegate'
]);


// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso']) && !empty($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  if(time() - $ultimo_acesso > 4) {
    $_SESSION['fed_recuperar_senha'] = null;
  }
} 

//print_r($_SESSION);

if (!isset($_GET['token']) && empty($_GET['token'])) navegate($_ENV['ROUTE'] . 'auth.esqueci_senha');;
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.styleconta' ]);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />

<title>
  Redefinir senha || Grease
</title>



<style type="text/css">
  header{
    background: black;
  }
</style>

<!-------/ BODY --------->
<body>
  <!-------/ HEAD --------->
  <?php if (isset($_SESSION['fed_recuperar_senha']) && !empty($_SESSION['fed_recuperar_senha'])): ?>
    <script>
      Swal.fire({
        title: '<?= $_SESSION['fed_recuperar_senha']['title']; ?>',
        text: '<?= $_SESSION['fed_recuperar_senha']['msg']; ?>',
        icon: '<?= $_SESSION['fed_recuperar_senha']['icon']; ?>',
        confirmButtonText: 'OK'
      })
    </script>   
  <?php endif; ?>


  <div class="container">
    <?php render_component('header'); ?>
    
    <main>
      <div id="home">
        <div class="filter"></div>
        <section class="intro">
          <!-- Começo das informações -->
          <section class="conta">
            <div class="usuario-body">
              <div class="info">
                <h3 class="titulo">Esqueci a senha</h3>
              </div>

              <!-- Informações básicas -->
              <div class="perfil-usuario-footer">
                <!-- Começo do formulário -->
              <form method="POST" action="<?= $_ENV["URL_CONTROLLERS"] ?>/Usuario/ResetarSenhaController.php">
                
                <ul class="lista-datos">
                  <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id']; ?>" />
                  <input type="hidden" class="input" name="token" value="<?= $_GET['token'] ?>" />

                  <li>
                    <i class="infos"></i> Nova Senha:
                    <input type="password" class="input" name="novaSenha" />
                    <br/>
                  </li>

                  <br>
                  <button class="btn btnEdit">Redefinir</button>
                </ul>
              </form>
            <!-- Fim do formulário -->
            </div>
          </section>
          <!-- Fim das informações -->
        </section>
      </div>
    </main>

  </div>


  <?= 
    use_js_scripts([ 
      'js.masksForInputs'    
    ]);  
  ?>
  <script type="module" src="<?= assets('js/forms/', 'FormCadastroUsuario.js'); ?>"></script>
</body>
<!-------/ BODY --------->