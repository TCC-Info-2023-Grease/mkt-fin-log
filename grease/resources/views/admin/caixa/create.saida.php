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
    unset($_SESSION['fed_cadastro_usuario']);
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


   <section class="dashboard">

    <div class="top">
      <i class="uil uil-bars sidebar-toggle"></i>
    </div>
    <div class="dash-content">
        <div class="overview">
          <div class="title">
            <span class="text">Cadastro Saída</span>
          </div>

          <form 
            action="<?php echo $_ENV["URL_CONTROLLERS"]; ?>/Caixa/EntradaController.php" 
            method="POST"
            id="frm-entrada"
          >
          <input 
            type="hidden" 
            name="usuario_id" 
            value="<?= $_SESSION['usuario']['usuario_id']; ?>" 
          />
          <input 
            type="hidden" 
            name="tipo_movimentacao" 
            value="Despesa" 
          />
          <input 
            type="hidden" 
            name="status_caixa" 
            value="ok" 
          />

          <label for="categoria_escolhida">                                                   
            Categoria:
          </label><br>
          <select 
            name="categoria_escolhida" 
            id="categoria_escolhida"
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
          <br>

          <label for="price">Valor:</label><br>
          <input 
            type="text" 
            id="money"  class="money"
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
          <br>

          <label for="obs">Observação:</label><br>
          <textarea 
            name="obs" 
            id="" 
            cols="30" 
            rows="10"   
            placeholder="Observações adicionais sobre a movimentação.">
          </textarea>
          <br>
          <br>
          
          <input type="submit" value="salvar">
        </form>
      </div>
    </div>
  </section>



  <?php
  use_js_scripts([ 'js.admin.financas' ]);
  use_js_scripts([ 'js.lib.maskMoney' ]);
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
  
        $('.money').val($('.money').maskMoney('unmasked')[0]);
      });
    });
  </script>
</body>