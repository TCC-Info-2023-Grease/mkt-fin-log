<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['auth']);

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
    unset($_SESSION['fed_meta']);
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
<script 
  src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"
  type="text/javascript">
</script>
<!------- /HEAD --------->


<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_meta']) && !empty($_SESSION['fed_meta'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_meta']['title']; ?>',
      text: '<?php echo $_SESSION['fed_meta']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_meta']['icon']; ?>',
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
            <span class="text">Cadastro Meta</span>
          </div>

          <form method="POST" id="frm-entrada" action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Meta/CadastroController.php">

              <label for="nome">Nome:</label>
              <input type="text" name="nome" placeholder="Corda de arame...">
              <br>
              <br>

              <!-- Preencha os outros campos com os valores correspondentes do array $dados -->
              <label for="descricao">Descrição:</label>
              <input type="text" name="descricao" placeholder="Descrição...">
              <br>
              <br>

              <label for="data_inicio">Data de Início:</label>
              <input type="date" name="data_inicio">
              <br>
              <br>

              <label for="data_fim">Data de Fim:</label>
              <input type="date" name="data_fim">
              <br>
              <br>

              <label for="total_necessario">Total Necessário:</label>
              <input type="text" name="total_necessario" class="money" placeholder="R$ 9,99">
              <br>
              <br>

              <input type="hidden" name="status" value="0"/>
  
              <input type="submit" value="Salvar">
            </form>

      </div>
    </div>
  </section>


  <?php
  use_js_scripts([ 'js.admin.financas' ]);
  ?> 
  <script>
    $(document).ready(() => {
      $('.money').maskMoney({
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