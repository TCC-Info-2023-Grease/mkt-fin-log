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
    unset($_SESSION['fed_material']);
  }
} 

if (!isset($_GET['id']) || empty($_GET['id'])) {
  navegate($_ENV['ROUTE'] . 'admin.material.saida.index');
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
    });
  </script>
  <?php endif; ?>


  <section class="dashboard">

    <div class="top">
      <i class="uil uil-bars sidebar-toggle"></i>
    </div>
    <div class="dash-content">
        <div class="overview">
          <div class="title">
            <span class="text">Cadastro Entrada</span>
          </div>

         <form 
          method="POST" 
          action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/EntradaMaterial/CadastroController.php"
          enctype="multipart/form-data"
          id="frm-entrada"
        >
          <input 
            type="hidden" 
            name="usuario_id" 
            value="<?php echo $_SESSION['usuario']['usuario_id']; ?>" 
          />
          <input 
            type="hidden" 
            name="material_id" 
            value="<?php echo $_GET['id']; ?>" 
          />
          <input 
            type="hidden" 
            name="categoria" 
            value="Entrada Material" 
          />
          <input 
            type="hidden" 
            name="tipo_movimentacao" 
            value="Entrada" 
          />
          <input 
            type="hidden" 
            name="descricao" 
            value="Entrada Material" 
          />

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
          
          <label for="valor_gasto">
            Valor gasto
          </label>
          <input 
            type="text" 
            id="money" 
            class="text" 
            name="valor_gasto"  
            placeholder="R$50.00" 
          />
          <br><br>

          <label for="qtde_compra">
            Quantidade Comprada
          </label>
          <input 
            type="number"  
            class="text" 
            name="qtde_compra" 
            placeholder="2" 
          />
          <br>
          <br>

          <label for="obs">Observação:</label><br>
          <textarea 
            name="obs" 
            id="" 
            cols="30" 
            rows="10"   
            placeholder="Observações adicionais.">
          </textarea>
          <br><br>

          <input type="submit" value="Salvar" />
        </form>
      </div>
    </div>
  </section>


  <?php
  use_js_scripts([ 'js.lib.maskMoney'  ]);
  use_js_scripts([ 'js.admin.financas' ]);
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