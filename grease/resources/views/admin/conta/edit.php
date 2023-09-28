<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('adm');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component'
]);

# Receber os dados enviados via POST
$data = $_POST;

require $_ENV['PASTA_CONTROLLER'] . '/Fornecedor/ConsultaController.php';

//ChamaSamu::debug($data);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 4) {
    unset($_SESSION['fed_conta']);
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

  <?php if (isset($_SESSION['fed_conta']) && !empty($_SESSION['fed_conta'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_conta']['title']; ?>',
      text: '<?php echo $_SESSION['fed_conta']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_conta']['icon']; ?>',
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
            <span class="text">Editar Conta</span>
          </div>

          <form 
      			method="POST" 
      			action="<?= $_ENV['URL_CONTROLLERS']; ?>/Conta/UpdateController.php"
    		  >
            <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario']['usuario_id']; ?>" />
            <input type="hidden" name="conta_id" value="<?= $data['conta_id']; ?>" />
            

      			<label for="fornecedor_id">Fornecedor:</label>
      			<select name="fornecedor_id">
                <option value="">
                    - Selecione -
                </option>
                <?php if (!empty($fornecedores)): ?>
                  <?php foreach ($fornecedores as $fornecedor): ?>
                    <option 
                      value="<?= $fornecedor['fornecedor_id']; ?>" 
                      <?= ($data['fornecedor_id'] == $fornecedor['fornecedor_id']) ? 'selected' : ''; ?>
                    >
                        <?php echo $fornecedor['nome']; ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <br><br>

            <label for="email">Titulo:</label>
            <input type="text" name="titulo" value="<?= $data['titulo'] ?>" placeholder="Compra dos Paletes" />
            <br>
            <br>

            <label for="email">Descrição:</label>
            <textarea name="descricao" id="" cols="30" rows="10">
              <?= $data['descricao']?>
            </textarea>
            <br>
            <br>

            <label for="ender">Valor:</label>
            <input type="text" name="valor" class="money" value="<?= $data['valor'] ?>" placeholder="R$ 90,00" />
            <br>
            <br>

            <label for="celular">Data Vencimento:</label>
            <input type="date" value="<?= $data['data_validade'] ?>" name="data_validade" placeholder="01/12/2023" />
            <br>
            <br>

            <select name="status_conta" id="status_conta">
              <?php foreach([0 => 'Não Pago', 1 => 'Pago'] as $status => $valor): ?>
                <option 
                  value="<?= $status; ?>" 
                  <?= ($data['status_conta'] == $status) ? 'selected' : ''; ?>
                >
                  <?= $valor; ?>
                </option>
              <?php endforeach; ?>
            </select>
            <br><br>
    				
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