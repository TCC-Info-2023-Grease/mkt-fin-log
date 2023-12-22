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
  'Money'
]);

include $_ENV['PASTA_CONTROLLER'] . '/Sala/ConsultaAlunosController.php';

$dados = $_POST;

//print_r($_POST);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if (isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];

  // Verifica se já passaram 5 minutos desde o último acesso
  if (time() - $ultimo_acesso > 2) {
    unset($_SESSION['fed_sala']);
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

  <?php if (isset($_SESSION['fed_sala']) && !empty($_SESSION['fed_sala'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_sala']['title']; ?>',
      text: '<?php echo $_SESSION['fed_sala']['msg']; ?>',
      icon: 'warning',
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
          <span class="text">Atualização de Entrada</span>
        </div>
        <div class="activity">
          <form action="<?php echo $_ENV["URL_CONTROLLERS"]; ?>/Sala/UpdateController.php" method="POST"
            id="frm-atualizacao">
            <input type="hidden" name="id" value="<?= $dados['caixa_id']; ?>" />
            <input type="hidden" name="usuario_id" value="<?= $dados['usuario_id']; ?>" />
            <input type="hidden" name="tipo_movimentacao" value="Receita" />
            <input type="hidden" name="status_caixa" value="ok" />
            <input type="hidden" name="categoria_escolhida" value="Pagamento aluno" />

            <label for="aluno_escolhido">
              Alunos:
            </label><br>
            <select name="aluno_escolhido" id="">
              <option value="">
                - Selecione uma opção -
              </option>
              <?php foreach ($data['alunos'] as $aluno): ?>
              <option value="<?= $aluno['aluno_id']; ?>"
                <?php if ($aluno['aluno_id'] == $dados['aluno_id']): ?> selected <?php endif; ?>>
                <?= $aluno['nome']; ?>
              </option>
              <?php endforeach; ?>
            </select>
            <br>
            <br>

            <label for="descricao">Descrição:</label><br>
            <textarea name="descricao" id="" cols="30" rows="10" required><?= $dados['descricao']; ?></textarea>
            <br>
            <br>

            <label for="price">Valor:</label><br>
            <input type="text" id="money" class="money" name="valor" class="money" placeholder="R$ 0,99"
              value="<?= $dados['valor']; ?>" required />
            <br>
            <br>

            <label for="price">Data:</label><br>
            <input 
              type="date" 
              id="date" 
              class="date" 
              name="data_movimentacao"
              value="<?= date('d/m/Y', strtotime($dados['data_movimentacao'])); ?>" 
              placeholder="<?= date('d/m/Y', strtotime($dados['data_movimentacao'])); ?>"
              required 
            />
            <br>
            <br>

            <label for="forma_pagamento">Forma pagamento:</label><br>
            <select name="forma_pagamento" id="" required>
              <option value="">
                - Selecione uma opção -
              </option>
              <option value="Físico" <?php if ($dados['forma_pagamento'] == 'Físico'): ?> selected <?php endif; ?>>
                Físico
              </option>
              <option value="Pix" <?php if ($dados['forma_pagamento'] == 'Pix'): ?> selected <?php endif; ?>>
                Pix
              </option>
            </select>
            <br>
            <br>

            <label for="obs">Observação:</label><br>
            <textarea name="obs" id="" cols="30" rows="10"
              placeholder="Observações adicionais sobre a movimentação."><?= $dados['obs']; ?></textarea>
            <br>
            <br>

            <input type="submit" value="Atualizar">
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php
  use_js_scripts([
    'js.lib.maskMoney',
    'js.admin.financas',
    'js.masksForInputs'
  ]);
  ?>
  <script type="module" src="<?= assets('js/forms/', 'FormCadastroUsuario.js'); ?>"></script>
  <script>
    $(document).ready(() => {
      $('#money').maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.',
        decimal: ',',
        affixesStay: true
      });

      $('#frm-atualizacao').submit(function(event) {
        $('.money').each(function() {
          $(this).val($(this).maskMoney('unmasked')[0]);
        });
      });
    });
  </script>
</body>