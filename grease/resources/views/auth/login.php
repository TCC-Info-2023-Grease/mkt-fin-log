<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component', 'use_js_scripts']);

//print_r($_SESSION['usuario']);
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.stylelogin' ]);
use_js_scripts([ 'js.scriptindex' ]);
?>
<!-- # Sweet Alert # -->
<script 
  src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
</script> 
<!-- # /Sweet Alert # -->

<title>
    Login 🚪 Grease
</title>
<!-------/ HEAD --------->

<!------- BODY --------->
<body>
 
 <?php if (isset($_SESSION['senha_redefinida']) == 'ok'): ?>
      <script>
          Swal.fire({
              title: 'Sucesso!',
              text: 'Senha redefinida!',
              icon: 'success',
              confirmButtonText: 'OK'
          })
      </script>
  <?php endif; ?>
  <?php if (isset($_GET['erro']) == 'campos_invalidos'): ?>
      <script>
          Swal.fire({
              title: 'Erro!',
              text: 'Campos invalidos!',
              icon: 'error',
              confirmButtonText: 'OK'
          })
      </script>
  <?php endif; ?>
  <?php if (isset($_GET['erro']) == 'usuario'): ?>
      <script>
          Swal.fire({
              title: 'Erro!',
              text: 'Email e/ou senha incorretos!',
              icon: 'error',
              confirmButtonText: 'OK'
          })
      </script>
  <?php endif; ?>


 
  <div class="container">
     <!--─────────────────Home────────────────-->
    <main>
          


      <div id="home">
        <div class="filter"></div>
        <section class="intro">

  

          <div class="wrapper">
            <div class="title-text">
              <div class="title login">Login</div>
              <div class="title signup">Cadastro</div>
            </div>
      

      
            <div class="form-container">
      
              <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Cadastro</label>
                <div class="slider-tab"></div>
              </div>
      
      
              <div class="form-inner">
      
                
                <form 
                    method="POST" 
                    action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Auth/LoginController.php"
                    class="login"
                >
                    <div class="field">
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="field">                      
                      <input type="password" placeholder="Senha" name="password" id="inputPassword" required>
                    </div>

                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Login">
                   </div>
                   <div class="signup-link">
                      Crie uma conta <a href="">Cadastre-se</a>
                   </div>     
                   <div class="signup-link">
                      Esqueci a <a href="<?= $_ENV['VIEWS'] ?>/auth/esqueci_senha.php">senha</a>
                   </div>                                   
                 </form>      
      
                        <form 
                          class="signup"
                           method="POST" 
                          action="<?= $_ENV['URL_CONTROLLERS']; ?>/Auth/CadastroController.php"
                          enctype="multipart/form-data"
                        >
                          <div class="field">
                            <input 
                              type="text" 
                              required  
                              name="username" 
                              placeholder="Stefano Jobs" />
                          </div>
                          <div class="field">
                            <input type="email" placeholder="stefano@android.com" required class="text" name="email" />
                          </div>
                          <div class="field">
                             <input type="number" placeholder="Idade" required class="text" name="age">
                      
                          </div>
                          <div class="field" style="display: none;">
                            <label for="tipo-usuario" style="display: none;">Tipo Usuario</label>
                            <select name="tipo_usuario" id="tipo-usuario-select" style="display: none;">
                                <option value="vis" selected>
                                    Visitante
                                </option>
                                <option value="fig">
                                    Figurino   
                                </option>
                                <option value="cen">
                                    Cénario
                                </option>
                                <option value="enc">
                                    Encenação
                                </option>
                                <option value="adm">
                                    Admin
                                </option>
                            </select>
                          </div>
                          <div class="field">
                            <select name="genrer" id="genrer-select" class="form-select" aria-label="Default select example">
                                <option value="m">
                                    Masculino
                                </option>
                                <option value="f">
                                    Feminino
                                </option>
                                <option value="o">
                                    Outro
                                </option>
                                <option value="n">
                                    Prefiro não informar
                                </option>
                            </select>
                          </div>
                          <div class="field">
                            <input 
                              type="text" 
                              required 
                              class="text phone" 
                              name="phone"
                              placeholder="(11) 90235-9078" />
                          </div>
                          <div class="field">
                            <input type="password" name="password" id="inputPassword" placeholder="Senha" required>                           
                          </div>
                          <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Signup">
                          </div>                        
                        </form>
              </div>
      
            </div>
          </div>
          <p></p>

        </section>
      </div>


      <?php use_js_scripts([ 'js.login', 'js.masksForInputs' ]); ?>
      <script type="module" src="<?php assets('js/forms/', 'FormCadastroUsuario.js'); ?>">
      </script>
    </main>
      <!--─────────────────fim Home────────────────-->
  
<br><br><br><br><br><br>

      <!--─────────────────Footer─────────────────-->
    <footer class="copyright">
      <a href="https://goo.gl/maps/6L43o6zw5VmfJ3b99" target="_blank">ETEC DE FRANCISCO MORATO - Planejamanto e Desenvolvimento do Trabalho de Conclusão de Curso(TCC) INFORMÁTICA PARA INTERNET. </a>
    </footer>
    
      <!--─────────────────Fim Footer────────────────-->
  </div>

        
  <div vw class="enabled">
    <div vw-access-button class="active" style="background: transparent;"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>


  <script type="module" src="<?= assets('js/forms/', 'FormCadastroUsuario.js'); ?>"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>
</body>
<!------- /BODY --------->
  