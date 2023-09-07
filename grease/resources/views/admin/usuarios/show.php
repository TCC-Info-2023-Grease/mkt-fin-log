<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('adm');
 
if (!isset($_POST) && empty($_POST)) navegate($_ENV['VIEWS']. '/adm/usuarios/');

import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money',
  'Mascara'
]);

global $_ENV;   

//print_r($_POST);
$usuario = $_POST;
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['css.admin.financas']);
?>
<title>
  Finanças Admin 🕺 Grease
</title>
<!-------/ HEAD --------->

<!------- BODY --------->
<body>
  <?php
  render_component('sidebar');
  ?>

  <section class="dashboard">
    <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>
    <div class="dash-content">
      <div style="text-align: right;">
        <?php if ($usuario['usuario_id'] != Auth::getUserData()['usuario_id']): ?>
          <a href="#" class="button-link btn-delete"
               onclick="if (confirm('Deseja excluir mesmo?')) {
                   this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Usuario/DeletarController.php?id=<?= $usuario['usuario_id']; ?>';
               }"
            >
              <i class="fa-solid fa-trash"></i>
          </a>
          <span class="button-separator">|</span>
         <?php endif; ?>
        <a href="#"
          class="button-link btn-edit"
           onclick="if (confirm('Deseja editar mesmo?')) {
               this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Usuario/EditController.php?id=<?= $usuario['usuario_id']; ?>';
           }"
        >
            <i class="fa-solid fa-pen"></i>
        </a>
      </div>

      <div class="overview">
        <div class="title"> <span class="text">Informações do Usuário</span> </div>

        <div class="activity">
          <div class="activity-data">
            <div class="data names">
              <span class="data-list">
                <img  
                  style="border-radius: 50%;border: 4px solid black;padding: 2px"
                  width="200px"
                  src="<?php 
                    if (isset($usuario['foto_perfil']) && !empty($usuario['foto_perfil'])) {
                      echo $_ENV['STORAGE']. '/image/usuarios/' .$usuario['foto_perfil'];
                    } else {
                      echo $_ENV['STORAGE']. '/image/usuarios/profile_default.png';  
                    }
                  ?>" 
                  alt="<?= $usuario['nome']; ?>" 
                />             
              </span>
            </div> 
            <div class="data names">
              <span class="data-title">Nome</span>
              <span class="data-list">
                <?= $usuario['nome']; ?>  
              </span>
            </div>

            <div class="data names">
              <span class="data-title">Email</span>
              <span class="data-list">
                <?= $usuario['email']; ?> 
              </span>
            </div>

            <div class="data names">
                <span class="data-title">Tipo Usuário</span>
                <span class="data-list">
                  <?php if ($usuario['tipo_usuario'] === 'adm'): ?> 
                    Administrador
                  <?php elseif ($usuario['tipo_usuario'] === 'vis'): ?>
                    Visitante
                  <?php endif; ?>
                </span>
              </div>
          </div>
          <br>
          <br>

          <div class="activity-data">
            <!-- Verificação de campo nulo -->
            <?php if (!empty($usuario['cpf'])): ?>
              <div class="data names">
                <span class="data-title">CPF</span>
                <span class="data-list">
                  <?= Mascara::mascararCPF($usuario['cpf']); ?> 
                </span>
              </div>
            <?php endif; ?>

            <!-- Verificação de campo nulo -->
            <?php if (!empty($usuario['idade'])): ?>
              <div class="data names">
                <span class="data-title">Idade</span>
                <span class="data-list">
                  <?= $usuario['idade']; ?> 
                </span>
              </div>
            <?php endif; ?>

            <!-- Verificação de campo nulo -->
            <?php if (!empty($usuario['genero'])): ?>
              <div class="data names">
                <span class="data-title">Gênero</span>
                <span class="data-list">
                  <?php 
                    if($usuario['genero'] === 'm') {
                      echo 'Masculino';
                    } elseif($usuario['genero'] === 'f') {
                      echo 'Feminino';
                    } elseif($usuario['genero'] === 'o') {
                      echo 'Outro';
                    } elseif($usuario['genero'] === 'n') {
                      echo 'Não especificado';
                    }
                  ?>
                </span>
              </div>
            <?php endif; ?>

            <!-- Verificação de campo nulo -->
            <?php if (!empty($usuario['celular'])): ?>
              <div class="data names">
                <span class="data-title">Celular</span>
                <span class="data-list">
                  <?= Mascara::mascararTelefone($usuario['celular']); ?> 
                </span>
              </div>
            <?php endif; ?>
          </div>
        </div>

        </div>
      </div>
    </div>
  </section>

  <?php
  use_js_scripts(['js.admin.financas']);
  ?>
</body>
<!-------/ BODY --------->
