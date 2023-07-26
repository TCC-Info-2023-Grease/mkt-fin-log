<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['auth']);

Auth::check('adm');

if (!isset($_POST) && empty($_POST)) navegate($_ENV['VIEWS']. '/adm/usuarios/');

import_utils([
  'extend_styles',
  'use_js_scripts',
  'render_component',
  'Money'
]);

# Receber os dados enviados via POST
$dados = $_POST;

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if (isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];

  // Verifica se já passaram 5 minutos desde o último acesso
  if (time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_usuario']);
  }
}
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['css.admin.financas']);
?>
<title>
  Finanças Admin 🕺 Grease
</title>
<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js" type="text/javascript">
</script>
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
      icon: '<?php echo $_SESSION['fed_usuario']['icon']; ?>',
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
          <span class="text">Editar Categoria</span>
        </div>

        <form method="POST" id="frm-usuario" enctype="multipart/form-data" action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Usuario/UpdateController.php">
          <input type="hidden" name="id" value="<?php echo isset($dados['usuario_id']) ? $dados['usuario_id'] : ''; ?>">

          <label for="nome">Nome:</label>
          <input type="text" name="nome" placeholder="Nome do usuário" value="<?php echo isset($dados['nome']) ? $dados['nome'] : ''; ?>">
          <br>
          <br>

          <label for="email">E-mail:</label>
          <input type="email" name="email" placeholder="E-mail do usuário" value="<?php echo isset($dados['email']) ? $dados['email'] : ''; ?>">
          <br>
          <br>

          <label for="cpf">CPF:</label>
          <input type="text" name="cpf" placeholder="CPF do usuário" value="<?php echo isset($dados['cpf']) ? $dados['cpf'] : ''; ?>">
          <br>
          <br>

          <label for="senha">Senha:</label>
          <input type="password" name="senha" placeholder="Nova senha">
          <br>
          <br>

          <label for="idade">Idade:</label>
          <input type="number" name="idade" placeholder="Idade do usuário" value="<?php echo isset($dados['idade']) ? $dados['idade'] : ''; ?>">
          <br>
          <br>

          <label for="genero">Gênero:</label>
          <select name="genero">
            <option value="m" <?php echo isset($dados['genero']) && $dados['genero'] === 'm' ? 'selected' : ''; ?>>Masculino</option>
            <option value="f" <?php echo isset($dados['genero']) && $dados['genero'] === 'f' ? 'selected' : ''; ?>>Feminino</option>
            <option value="o" <?php echo isset($dados['genero']) && $dados['genero'] === 'o' ? 'selected' : ''; ?>>Outro</option>
            <option value="n" <?php echo isset($dados['genero']) && $dados['genero'] === 'n' ? 'selected' : ''; ?>>Não especificado</option>
          </select>
          <br>
          <br>

          <label for="celular">Celular:</label>
          <input type="text" name="celular" placeholder="Celular do usuário" value="<?php echo isset($dados['celular']) ? $dados['celular'] : ''; ?>">
          <br>
          <br>

          <label for="foto_perfil">Foto de Perfil: <br> <br>        
          <center>
              <img  
            style="border-radius: 50%;border: 4px solid black;padding: 2px"
            width="200px"
            src="<?= $_ENV['STORAGE']. '/image/usuario/' .$dados['foto_perfil']; ?>" 
            alt="<?= $usuario['nome']; ?>" 
          />    
          </center>         
          </label><br>
          <input type="file" name="profile_picture[]" class="input-file" placeholder="Foto de perfil" />
          <br>
          <br>

          <input type="submit" value="Salvar">
        </form>
      </div>
    </div>
  </section>

  <?php
  use_js_scripts(['js.admin.financas']);
  ?>
  <script>
    $(document).ready(() => {
      $('#frm-usuario').submit(function(event) {
        $('.money').val($('.money').maskMoney('unmasked')[0]);
      });
    });
  </script>
</body>
