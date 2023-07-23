<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['auth']);

//Auth::check('adm');
 
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

if (!isset($_GET['id']) || empty($_GET['id']) {
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
<script 
  src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"
  type="text/javascript">
</script>
<!------- /HEAD --------->

<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_material']) && !empty($_SESSION['fed_material'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_material']['title']; ?>',
      text: '<?php echo $_SESSION['fed_material']['msg']; ?>',
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
            <span class="text">Cadastro Saída</span>
          </div>

       <form 
          method="POST" 
          action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/SaidaMaterial/CadastroController.php"
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
            value="Saída Material" 
          />
          <input 
            type="hidden" 
            name="tipo_movimentacao" 
            value="Saida" 
          />
          <input 
            type="hidden" 
            name="descricao" 
            value="Saída Material" 
          />
          
          <label for="qtde_compra">
            Quantidade Retirada
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
            placeholder="Observações adicionais sobre a movimentação.">
          </textarea>
          <br>
          <br>

          <input type="submit" value="salvar" />
        </form>
      </div>
    </div>
  </section>


  <?php
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
        $('input[name=valor]').val($('input[name=valor]').maskMoney('unmasked')[0]);
      });
    });
  </script>
</body>