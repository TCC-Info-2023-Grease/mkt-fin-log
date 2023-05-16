<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component']);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_cadastro_usuario']);
  }
} 
?>


<!------- HEAD --------->
<?php
render_component('head');
//extend_styles(['styles']);
?>
<title>Caixa da sala</title>
<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"
  type="text/javascript"></script>
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
    action="<?php echo $_ENV["URL_CONTROLLERS"]; ?>/Caixa/EntradaController.php" 
    method="POST"
    id="frm-entrada"
  >
    <input 
      type="hidden" 
      name="usuario_id" 
      value="<?php echo 1; ?>" 
    />
    <input 
      type="hidden" 
      name="tipo_movimentacao" 
      value="Entrada" 
    />

    <label for="categoria_escolhida">
      Categoria:
    </label>
    <select 
      name="categoria_escolhida" 
      id=""
    >
      <option value="">
        - Selecione uma opção -
      </option>
      <option value="Aberta">Aberta</option>
      <option value="Despesas">Despesas</option>
      <option value="Pagamentos">Pagamentos</option>
      <option value="Transferências">Transferências</option>
      <option value="Reservas">Reservas</option>
    </select>
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

    <label for="price">Valor:</label><br>
    <input 
      type="text" 
      id="money" 
      name="valor" 
      placeholder="R$ 0,99"
      required
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

    <label for="status_caixa">Status caixa:</label><br>
    <select name="status_caixa" id="" required>
      <option value="">
        - Selecione uma opção -
      </option>
      <option value="Receitas">Aberta</option>
      <option value="Fechada">Fechada</option>
      <option value="Em andamento">Em andamento</option>
      <option value="Concluída">Concluída</option>
      <option value="Cancelada">Cancelada</option>
    </select>


    <br>

    <label for="obs">Observação:</label><br>
    <textarea 
      name="obs" 
      id="" 
      cols="30" 
      rows="10" 
      required
      placeholder="Observações adicionais sobre a movimentação.">
    </textarea>
    <br>
    
    <input type="submit" value="salvar">
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
        $('input[name=valor]').val($('input[name=valor]').maskMoney('unmasked')[0]);
      });
    });
  </script>
</body>