<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
global $_ENV;

import_utils(['auth', 'extend_styles', 'render_component']);

Auth::check('adm');

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_cadastro_usuario']);
  }
} 

//print_r($_SESSION);
?>


<!------- HEAD --------->
<?php
render_component('head');
//extend_styles(['styles']);
?>
<title>
    Admin 🕺 Grease
</title>
<script 
  src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"
  type="text/javascript">
</script>
<!------- /HEAD --------->

<body>
  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/header.php';
  ?>

  <?php if (isset($_SESSION['fed_caixa']) && !empty($_SESSION['fed_caixa'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_caixa']['title']; ?>',
      text: '<?php echo $_SESSION['fed_caixa']['msg']; ?>',
      icon: 'error',
      confirmButtonText: 'OK'
    })
  </script>
  <?php endif; ?>

    
  <form 
    method="POST" 
    action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/SaidaMaterial/CadastroController.php"
    enctype="multipart/form-data"
    id="frm-entrada"
  > 
    <input 
      type="hidden" 
      name="usuario_id" 
      value="<?php echo 1; ?>" 
    />
    <input 
      type="hidden" 
      name="material_id" 
      value="<?php echo 1; ?>" 
    />
    <input 
      type="hidden" 
      name="categoria" 
      value="Saída Material" 
    />
    <input 
      type="hidden" 
      name="tipo_movimentacao" 
      value="Saida" 
    />
    <br>
    <br>
    
    <label for="forma_pagamento">Forma pagamento:</label><br>
    <select name="forma_pagamento" id="" required>
      <option value="">
        - Selecione uma opção -
      </option>
      <option value="Físico">Físico</option>
      <option value="Pix">Pix</option>
    </select>
    <br>

    <input 
      type="number"  
      class="text" 
      name="qtde_compra" 
      placeholder="2" 
    />
    <label for="qtde_compra">
      Quantidade Saída
    </label>
    <br>

    <label for="descricao">Descrição:</label><br>
    <textarea 
      name="descricao" 
      id="" 
      cols="30" 
      rows="10" 
      required
    >
    </textarea>

    <br>
    <label for="obs">Observação:</label><br>
    <textarea 
      name="obs" 
      id="" 
      cols="30" 
      rows="10"   
      placeholder="Observações adicionais.">
    </textarea>
    <br>

    <button class="signin login">
      Inserir
    </button>
  </form>

  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
  ?>

  <script>
    $(document).ready(() => {
      $('#money').maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.', decimal: ',',
        affixesStay: true
      });

      $('#frm-entrada').submit(function(event) {
        $('#money').val($('#money').maskMoney('unmasked')[0]);
      });
    });
  </script>
</body>