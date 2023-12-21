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


include $_ENV['PASTA_CONTROLLER'] . '/Caixa/ConsultaController.php';

$receitas = $data['receitas'];
$despesas = $data['despesas'];
$meses = $data['meses'];
$saldos = $data['saldos'];

$dadosCategorias = $data['dadosCategorias'];

$totalReceitas = $data['totalReceitas'];
$totalDespesas = $data['totalDespesas'];

$porcentagemDespesas = $data['porcentagemDespesas'];
$porcentagemReceitas = $data['porcentagemReceitas'];


//ChamaSamu::debug($data);
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['css.admin.financas']);
?>

<title>
  Finanças Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
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
      <div style="display: flex;justify-content: space-between;align-items: center;">
        <div class="title">
          <span class="text"><h1>Caixa</h1></span>
        </div>

        <div>
          <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.entrada.create" class="button-link" style="background-color: #28a745;">
            Nova Entrada
          </a>
          <span class="button-separator">|</span>
          <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.saida.create" class="button-link" style="background-color: #dc3545;">
            Nova Saída
          </a>
        </div>
      </div>

      <div class="dash-content">
        <div class="boxes">
          <div
            class="box
            <?php if ($data['saldo_atual'] <= 0): ?>
            box2
            <?php elseif ($data['saldo_atual'] > 0): ?>
            box1
            <?php else : ?>
            box3
            <?php endif; ?>
            ">
            <span class="text">Saldo Atual</span>
            <span class="number">
              <?= Money::format($data['saldo_atual']); ?>
            </span>
          </div>

          <div
            class="box
            <?php if ($data['total_gasto'] < $data['total_necessario']): ?>
            box1
            <?php elseif ($data['total_gasto'] > $data['total_necessario']): ?>
            box2
            <?php else : ?>
            box3
            <?php endif; ?>
            ">
            <span class="text">Total Gasto</span>
            <span class="number">
              <?= Money::format($data['total_gasto']); ?>
            </span>
          </div>

          <div class="box box4">
            <span class="text">Total Necessario</span>
            <span class="number">
              <?= Money::format($data['total_necessario']); ?>
            </span>
          </div>
        </div>
      </div>
      <br><br><br>
      <hr>

      <div class="dash-content">
        <center style="margin-bottom: 46px;"><h2>Estatística</h2></center>

        <div class="dash-estatistics">
          <div class="title">
            <span class="text">Saldo Mensal</span>
          </div>

          <details>
            <summary>Ver mais...</summary>

            <div class="chart-container" style="width: 100%;">
              <center>
                <canvas id="financasChart" style="max-width: 800px;"></canvas>
              </center>
            </div>
          </details>
        </div>
      </div>

      <div class="dash-content">
        <div class="dash-estatistics">
          <div class="title">
            <span class="text">Porcentagem de Despesas e Receitas</span>
          </div>

          <details>
            <summary>Ver mais...</summary>

            <div class="chart-container">
              <style type="text/css">
                #despesasReceitasChart {
                  height: 300px!important;
                }
              </style>
              <center>
                <canvas id="despesasReceitasChart" style="max-width: 800px;"></canvas>
              </center>
            </div>
          </details>
        </div>
      </div>

      <div class="dash-content">
        <div class="dash-estatistics">
          <div class="title">
            <span class="text">Categorias de despesas e receitas</span>
          </div>

          <details>
            <summary>Ver mais...</summary>

            <div class="chart-container">
              <style type="text/css">
                #categoriasChart {
                  height: 400px!important;
                }
              </style>
              <center>
                <canvas id="categoriasChart" style="max-width: 800px;"></canvas>
              </center>
            </div>
          </details>
        </div>
      </div>

      <br><br>
      <br><br>
      <hr>

      <div class="dash-content">
        <?php if (isset($data['caixa']) && !empty($data['caixa'])) {
          ?>
          <div style="display: flex;justify-content: space-between;align-items: center;">
            <div class="title">
              <span class="text">Movimentações</span>
            </div>

            <div class="dropdown">
              <a target="_blank" href="<?= $_ENV['ROUTE'] ?>admin.caixa.relatorio" class="dropbtn" style="text-decoration: none;">
                Relatório
              </a>
            </div>
          </div>

          <table id="myTable" class="display">
            <caption>Caixa</caption>
            <thead>
              <tr>
                <th></th>
                <th>Usuario</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Categoria</th>
                <th>Tipo Movimentação</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($data['caixa'] as $item): ?>
              <tr>
                <td>
                  <a href="<?= $_ENV['URL_CONTROLLERS'] . '/Caixa/ShowController.php?id=' . $item['caixa_id']; ?>">
                    <center>
                      <i class="fa fa-info-circle" style="color: #24c28d; font-size: 26px;" title="Ver mais">
                      </i>
                    </center>
                  </a>
                </td>
                <td>
                  <?= $item['nome_usuario']; ?>
                </td>
                <td>
                  <?= Money::format($item['valor']); ?>
                </td>
                <td>
                  <?= date('d-m-Y H:m:s', strtotime($item['data_movimentacao'])); ?>
                </td>
                <td>
                  <?= $item['categoria']; ?>
                </td>
                <td>
                  <?= $item['tipo_movimentacao']; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php
        } else {
          ?>
          <h3>Sem inserções</h3>
          <?php
        } ?>
      </div>
    </div>
  </div>


  <section class="activity" id="politicas" style="width: 80%;padding: 12px;border-radius: 12px;border: 2px solid #f5f5f5;margin: 5rem 0">
    <center style="margin-bottom: 16px;margin-top: 34px;"><h2>Nossas Politicas</h2></center>
    <div class="data names" style="padding: 2rem;">
      <details>
        <summary><h2 style="display: inline; margin-left: 12px; font-size: 1.34rem;cursor: pointer;">Política Financeira:</h2></summary><br>


        <h3>1. Pagamentos e Cobranças:</h3> <br>
        <p>
          Nossa política financeira garante transparência nas transações. Os pagamentos serão processados com segurança através de plataformas confiáveis. Cobranças e faturas serão enviadas de forma clara, detalhando os valores e serviços contratados.
        </p>
        <br>  <br>

        <h3>2. Cancelamento e Reembolso:</h3> <br>
        <p>
          Em caso de cancelamento de serviços ou produtos, reembolsos serão processados de acordo com as regras específicas de cada caso. Certifique-se de verificar os termos e condições aplicáveis antes de prosseguir com qualquer cancelamento.
        </p>
        <br> <br>

        <h3>3. Segurança dos Dados Financeiros:</h3> <br>
        <p>
          Nós levamos a segurança dos seus dados financeiros a sério. Utilizamos métodos de criptografia e proteção para garantir que suas informações financeiras estejam protegidas contra acessos não autorizados.
        </p>
        <br> <br>

        <h3>4. Orçamentos e Custos Adicionais:</h3> <br>
        <p>
          Forneceremos orçamentos detalhados e transparentes para os nossos serviços. Caso haja custos adicionais não previstos, entraremos em contato e buscaremos a sua aprovação antes de prosseguir.
        </p>
        <br> <br>

        <h3>5. Prazos de Pagamento:</h3> <br>
        <p>
          Os prazos de pagamento serão especificados em nossos documentos de faturamento. Pedimos que os pagamentos sejam realizados dentro dos prazos estipulados para garantir a continuidade dos serviços.
        </p>
        <br> <br>
      </details>
      <br><br>

      <details>
        <summary><h2 style="display: inline; margin-left: 12px; font-size: 1.34rem;cursor: pointer;">Política de Privacidade:</h2></summary><br>

        <h3>1. Coleta de Informações:</h3> <br>
        <p>
          Nós coletamos informações financeiras necessárias para processar pagamentos e garantir a prestação adequada dos serviços contratados. Essas informações serão mantidas de forma segura e não serão compartilhadas com terceiros, exceto quando exigido por lei.
        </p>
        <br> <br>

        <h3>2. Uso de Dados Financeiros:</h3> <br>
        <p>
          As informações financeiras fornecidas serão utilizadas apenas para processar pagamentos, cobranças e faturamento relacionado aos serviços contratados. Não utilizaremos essas informações para outros fins sem o seu consentimento expresso.
        </p>
        <br> <br>

        <h3>3. Armazenamento Seguro:</h3> <br>
        <p>
          Utilizamos medidas de segurança rigorosas para armazenar suas informações financeiras. Isso inclui a criptografia de dados e a proteção contra acessos não autorizados.
        </p>
        <br> <br>

        <h3>4. Acesso Restrito:</h3> <br>
        <p>
          Apenas pessoal autorizado terá acesso às informações financeiras. Garantimos que somente as pessoas envolvidas diretamente no processamento de pagamentos e cobranças terão acesso a esses dados.
        </p>
        <br> <br>

        <h3>5. Atualizações na Política de Privacidade:</h3> <br>
        <p>
          Nossa política de privacidade pode ser atualizada conforme necessário. Quaisquer alterações serão comunicadas de forma transparente e serão efetivas a partir da data de atualização.
        </p>
      </details>

    </div>
  </section>

</section>

<?php
use_js_scripts([
  'js.lib.xlsx',
  'js.lib.jspdf',
  'js.lib.jspdf_plugin_autotable',
  'js.services.ChartCaixa',
  'js.services.ExportTabelaCaixa',
  'js.admin.financas'
]);
?>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    ChartCaixa.saldoMensal(
      <?= json_encode($saldos); ?>,
      <?= json_encode($meses); ?>
    );

    ChartCaixa.despesasReceitas(
      <?= json_encode($porcentagemDespesas); ?>,
      <?= json_encode($porcentagemReceitas); ?>
    );

    ChartCaixa.receitasDespesasPorCategoria(
      <?= json_encode($dadosCategorias); ?>
    );
  });
</script>
</body>
<!-------/ BODY --------->