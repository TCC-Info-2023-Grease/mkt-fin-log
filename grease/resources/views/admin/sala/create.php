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

include $_ENV['PASTA_CONTROLLER'] . '/Sala/ConsultaAlunosController.php';

//var_dump($data);

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  if(time() - $ultimo_acesso > 3) {
    unset($_SESSION['fed_sala']);
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

  <?php if (isset($_SESSION['fed_usuario']) && !empty($_SESSION['fed_usuario'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_usuario']['title']; ?>',
      text: '<?php echo $_SESSION['fed_usuario']['msg']; ?>',
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
            <span class="text">Cadastro Entrada</span>
          </div>

		       <div class="activity">
				      <form action="<?php echo $_ENV["URL_CONTROLLERS"]; ?>/Sala/EntradaController.php" method="POST"
                    id="frm-entrada">
                    <input type="hidden" name="usuario_id" value="<?= $_SESSION['usuario']['usuario_id']; ?>" />
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
                        <option value="<?= $aluno['aluno_id']; ?>">
                          <?= $aluno['nome']; ?>
                        </option>
                       <?php endforeach; ?>
                    </select>
                    <br>
                    <br>

                    <label for="descricao">Descrição:</label><br>
                    <textarea name="descricao" id="" cols="30" rows="10" required>
                    </textarea>
                    <br>
                    <br>

                    <label for="price">Valor:</label><br>
                    <input type="text" id="money" class="money" name="valor" class="money" placeholder="R$ 0,99"
                        required />
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

                    <label for="obs">Observação:</label><br>
                    <textarea name="obs" id="" cols="30" rows="10"
                        placeholder="Observações adicionais sobre a movimentação.">
                    </textarea>
                    <br>
                    <br>

                    <input type="submit" value="salvar">
                </form>
					</div>
      </div>
    </div>
  </section>


  <?php
  use_js_scripts([ 'js.lib.maskMoney'  ]);
  use_js_scripts([ 'js.admin.financas', 'js.masksForInputs' ]);
  ?> 
  <script type="module" src="<?= assets('js/forms/', 'FormCadastroUsuario.js'); ?>"></script>
</body>