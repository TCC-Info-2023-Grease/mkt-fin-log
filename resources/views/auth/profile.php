<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '\config.php';
global $_ENV;

import_utils(['Auth']);

Auth::isLogged();

import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'navegate'
]);


$usuarioData = [$_SESSION['usuario']];

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  if(time() - $ultimo_acesso > 2) {
    $_SESSION['fed_profile'] = null;
  }
} 

//print_r($_SESSION['usuario']);
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
  Grease - Conta
</title>



<style type="text/css">
  header{
    background: black;
  }
</style>

<!-------/ BODY --------->
<body>
  <!-------/ HEAD --------->
  <?php if (isset($_SESSION['fed_profile']) && !empty($_SESSION['fed_profile'])): ?>
    <script>
      Swal.fire({
        title: '<?= $_SESSION['fed_profile']['title']; ?>',
        text: '<?= $_SESSION['fed_profile']['msg']; ?>',
        icon: '<?= $_SESSION['fed_profile']['icon']; ?>',
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
                <h3 class="titulo">Informações pessoais</h3>
                <p class="texto">Gerencie suas informações pessoais.</p>
              </div>

              <!-- Informações básicas -->
              <div class="perfil-usuario-footer">
                <!-- Começo do formulário -->
              <form method="POST" action="<?= $_ENV["URL_CONTROLLERS"] ?>/Profile/EditController.php">
                <h3 class="info-basica">Sobre você</h3>
                
                <ul class="lista-datos">
                <?php foreach ($usuarioData as $usuario): ?>
                  <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id']; ?>" />

                  <li>
                    <i class="infos"></i> Nome:
                    <input type="text" class="input" name="nome" value="<?= $usuario['nome']; ?>" disabled />
                    <br/>
                  </li>
                  
                  <?php if ($_SESSION['usuario']['tipo_usuario'] == 'adm'): ?>
                  <li>
                    <img style="border-radius: 12px;" width="300px" src="<?= $_ENV['STORAGE'] . '/image/usuarios/' . $usuario['foto_perfil']; ?>" alt="<?= $usuario['nome']; ?>" />
                    <br/>
                  </li>
                  <?php endif; ?>

                  <li>
                    <i class="infos"></i> Email:
                    <input type="email" class="input" name="email" value="<?= $usuario['email']; ?>" disabled />
                    <br/>
                  </li>

                  <li>
                    <i class="infos"></i> Idade:
                    <input type="number" class="input" name="idade" value="<?= $usuario['idade']; ?>" disabled />
                    <br>
                  </li>

                  <li>
                    <i class="infos"></i> Gênero:
                    <?php if ($usuario['genero'] == 'm'): ?>
                      Masculino
                    <?php elseif ($usuario['genero'] == 'f'): ?>
                      Feminino
                    <?php else: ?>
                      Outro
                    <?php endif; ?>
                    <br>
                  </li>

                  <li>
                    <i class="infos"></i> Celular:
                    <input type="text" class="text phone input" name="celular" value="<?= $usuario['celular']; ?>" disabled />          
                    <br>
                  </li>
                  
                  <?php if ($_SESSION['usuario']['tipo_usuario'] == 'adm'): ?>
                  <li>
                    <i class="infos"></i> CPF:
                      <input type="text" name="cpf" class="input" value="<?= $usuario['cpf']; ?>" disabled />
                      <br><br>
                  </li>
                  <?php endif; ?>           
                  
                  <li>
                    <i class="infos"></i> Nova Senha:
                    <input type="password" class="input" name="senha" disabled />
                    <br/>
                  </li>

                  <br>
                  <button class="btn btnEdit">Editar</button>
                <?php endforeach; ?>
                </ul>
              </form>
            <!-- Fim do formulário -->
            </div>
          </section>
          <!-- Fim das informações -->
        </section>
      </div>
    </main>

    <?php render_component('footer'); ?>
  </div>


  <?= 
    use_js_scripts([ 
      'js.masksForInputs'    
    ]);  
  ?>
  <script type="module" src="<?= assets('js/forms/', 'FormCadastroUsuario.js'); ?>"></script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.querySelector("form");
      const btnEdit = document.querySelector('.btnEdit');
      const inputs = document.querySelectorAll('.input'); 
      
      btnEdit.addEventListener('click', ( e ) => {
        e.preventDefault();

        if (btnEdit.textContent === "Salvar") {
          form.submit();
        }
        
        inputs.forEach(( input ) => { 
          // console.log('====================================');
          // console.log(input);
          // console.log('===================================='); 

          input.disabled = !input.disabled;
          btnEdit.textContent = input.disabled? "Editar" : "Salvar";
        });
      });
    });    
  </script>
</body>
<!-------/ BODY --------->