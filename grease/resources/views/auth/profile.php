<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '\config.php';
global $_ENV;

import_utils([ 'auth', 'use_js_scripts', 'extend_styles', 'render_component', 'navegate' ]);

Auth::check('all');

$usuarioData = [$_SESSION['usuario']];

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  if(time() - $ultimo_acesso > 100) {
    $_SESSION['fed_profile'] = '';
  }
} 
?>


<!------- HEAD --------->
<?php
render_component('head');
//extend_styles([ 'styles' ]);
use_js_scripts([ 'inputmask', 'masksForInputs', 'vw_cadastrar_usuario' ], $_ENV['LIST_SCRIPTS']);
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


<!-------/ BODY --------->

<body>
  <?php render_component('header'); ?>
  <br><br><br>

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

  <?php if ($usuarioData): ?>
  <form method="POST" action="<?= $_ENV["URL_CONTROLLERS"] ?>/Profile/EditController.php">      
    <?php foreach ($usuarioData as $usuario): ?>
      <input
        type="hidden"
        name="usuario_id"
        value="<?= $usuario['usuario_id']; ?>"
      />

      <label>Nome</label>
      <input  
        type="text" 
        class="input"
        name="nome"
        value="<?= $usuario['nome']; ?>"
        disabled
      />      

      <br/>
      <?php if ($_SESSION['usuario']['tipo_usuario'] == 'adm') { ?>
        <img 
          width="300px" src="<?= $_ENV['STORAGE'] . '/image/usuarios/' . $usuario['foto_perfil']; ?>"
          alt="<?= $usuario['nome']; ?>" 
        />
        <br>
      <?php } ?>

      <label for="email">Email</label>
      <input 
        type="email" 
        class="input"
        name="email"
        value="<?= $usuario['email']; ?>"
        disabled
      />
      <br>

      <label for="age">Idade</label>
      <input 
        type="number" 
        class="input"
        name="idade"
        value="<?= $usuario['idade']; ?>"
        disabled
      />      
      <br>

      <label for="genrer">Gênero</label>
      <?php if ($usuario['genero'] == 'm') { ?>
        Masculino
      <?php } else if ($usuario['genero'] == 'f') { ?>
        Feminino
      <?php } else { ?>
        Outro
      <?php } ?>
      <br>

      <label for="phone">
        Celular
      </label>
      <input 
        type="text" 
        class="text phone input" 
        name="celular"
        value="<?= $usuario['celular']; ?>"
        disabled
      />
      <br>

      <?php if ($_SESSION['usuario']['tipo_usuario'] == 'adm') { ?>
      <label for="cpf">CPF</label>
      <input 
        type="text" 
        name="cpf"
        class="input"
        value="<?= $usuario['cpf']; ?>"
        disabled
      />
      <br><br>
      <?php } ?>

      <button class="btnEdit">
        Editar
      </button>
    <?php endforeach; ?>
  </form>
  <?php endif; ?>

  <br>
  <br>

  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
  ?>

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
          console.log('====================================');
          console.log(input);
          console.log('===================================='); 

          input.disabled = !input.disabled;
          btnEdit.textContent = input.disabled? "Editar" : "Salvar";
        });
      });

    });    
  </script>
</body>
<!-------/ BODY --------->