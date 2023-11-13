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

# ChamaSamu::debug($data);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso >= 2) {
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
                    <span class="text">Pagar Conta</span>
                </div>

                <form id="frm-conta" method="POST" action="<?= $_ENV['URL_CONTROLLERS']; ?>/Conta/CheckoutController.php">
                    <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario']['usuario_id']; ?>" />
                    <input type="hidden" name="conta_id" value="<?= $data['conta_id']; ?>" />
                    <input type="hidden" name="fornecedor_id" value="<?= $data['fornecedor_id']; ?>" />
                    <input type="hidden" name="status_conta" value="<?= $data['status_conta']; ?>" />


                    <label for="fornecedor_id">Fornecedor:</label>
                    <br>
                    <h4 style="margin-top: 1rem; font-weight: 400;"><?=  $data['fornecedor']; ?></h4>
                    <br>

                    <label for="email">Titulo:</label>
                    <br>
                    <h4 style="margin-top: 1rem; font-weight: 400;"><?=  $data['titulo']; ?></h4>
                    <input type="hidden" name="titulo" value="<?= $data['titulo']; ?>" />
                    <br>

                    <label for="email">Descrição:</label>
                    <br>
                    <h4 style="margin-top: 1rem; font-weight: 400;"><?=  $data['descricao']; ?></h4>
                    <input type="hidden" name="descricao" value="<?= $data['descricao']; ?>" />
                    <br>

                    <label for="ender">Valor:</label>
                    <input type="text" name="valor" style="margin-top: 1rem;"  class="money" value="<?= $data['valor'] ?>"
                        placeholder="R$ 90,00" />
                    <br>
                    <br>

                    <label for="forma_pagamento">Forma Pagamento:</label>
                    <select name="forma_pagamento" id="forma_pagamento" style="margin-top: 1rem;">
                        <option value="Físico">Físico</option>
                        <option value="PIX">PIX</option>
                        <option value="Cartão de Crédito">Cartão de Crédito</option>
                        <option value="Cartão de Débito">Cartão de Débito</option>
                    </select>
                    <br>
                    <br>

                    <label for="obs">Observação:</label>
                    <textarea style="margin-top: 1rem;" name="obs" id="" cols="20" rows="4">
                    </textarea>
                    <br>
                    <br>

                    <label for="celular">Data Vencimento:</label>
                    <br>
                    <h4 style="margin-top: 1rem; font-weight: 400;">
                        <?php
                        $data_atual = date('Y-m-d');
                        if ($data_atual >= $data['data_validade']) {
                            echo '<span style="color: red;">' . date('d-m-Y', strtotime($data['data_validade'])) . '</span>';
                        } else {
                            echo '<span style="color: green;">' . date('d-m-Y', strtotime($data['data_validade'])) . '</span>';
                        }
                        ?>
                    </h4>

                    <input type="hidden" name="data_validade" value="<?= $data['data_validade']; ?>" />
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
    <script type="text/javascript">
    $('.money').maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: true
    });

    $('#frm-conta').submit(function(event) {
        $('.money').each(function() {
            $(this).val($(this).maskMoney('unmasked')[0]);
        });
    });
    </script>
</body>