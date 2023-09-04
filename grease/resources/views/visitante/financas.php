<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('vis');
 
import_utils([
  'extend_styles', 
  'use_js_scripts', 
  'render_component',
  'Money'
]);


include $_ENV['PASTA_CONTROLLER'] . '/Caixa/VisitanteDashboardController.php';

$receitas = $data['receitas'];
$despesas = $data['despesas'];
$meses    = $data['meses'];
$saldos   = $data['saldos'];

$dadosCategorias = $data['dadosCategorias'];

$totalReceitas = $data['totalReceitas'];
$totalDespesas = $data['totalDespesas'];

$porcentagemDespesas = $data['porcentagemDespesas'];
$porcentagemReceitas = $data['porcentagemReceitas'];

//print_r($data);
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.visitante.financas' ]);
?>
<title>
  Finanças 🕺 Grease
</title>

<style type="text/css">
  header {
    background: black;
  }
</style>
<!------- /HEAD --------->


<!------- BODY --------->
<body>
  <div class="container">
    <?php
    render_component('header');
    ?>

      <div class="dash-content">
        <div class="overview" style="padding: 2rem;">
          <div class="title"> <span class="text">Olá, <?= ucfirst($_SESSION['usuario']['nome']); ?></span> </div>
          <div class="boxes">
            <div class="box <?php if ($data['saldo_atual'] < 0): ?>box2<?php elseif ($data['saldo_atual'] > 0): ?>box1<?php else: ?>box3<?php endif; ?>">
              <span class="text">Saldo Atual</span> 
              <span class="number">
                 <?= Money::format($data['saldo_atual']); ?>
              </span> 
            </div>
            <div class="box <?php if ($data['total_gasto'] < $data['total_necessario']): ?>box1<?php elseif ($data['total_gasto'] > $data['total_necessario']): ?>box2<?php else: ?>box3<?php endif; ?>">              
              <span class="text">Total Gasto</span> 
              <span class="number">
                <?= Money::format($data['total_gasto']); ?>
              </span> 
            </div>
            <div class="box box1"> 
              <span class="text">Total Necessario</span> 
              <span class="number">
                <?= Money::format($data['total_necessario']); ?>
              </span> 
            </div>
          </div>
        </div>
    

        <br>
        <hr>
        <br>
        
        <?php $style_nav_secondary = "
          display:flex;
          flex-flow:row wrap;
          justify-content:space-evenly;
          align-items:center;
          list-style: none;
        "; ?>
        <style>
          a { text-decoration: none; color: black }
          .style_nav_secondary a:hover {
            transition: 0.45s all;
            text-decoration: underline;
          }
        </style>
        <section class="activity" style="margin-top: 1rem;box-shadow: 0 5px 15px rgb(214 211 211 / 92%);border-radius: 3rem;border: 2px solid #958f8f17;">
          <nav style="width: 100%">
            <ul class="style_nav_secondary" style="<?= $style_nav_secondary; ?>">
              <li><a href="#estatisticas">Estátisticas</a></li>
              <li><a href="#movimentacoes">Movimentações</a></A></li>
              <li><a href="#politicas">Nossas Politicas</a></li>
            </ul>
          </nav>
        </section>


        <div class="activity" style="padding: 0rem 2rem;padding-bottom: 2rem;" >
          <div class="dash-content" id="estatisticas" style="padding-top: 0;">
            <center style="margin-bottom: 46px;padding-top: 2.4rem;"><h2>Estátisticas</h2></center>

            <div class="dash-estatistics">
              <div class="title"><span class="text">Saldo Mensal</span></div>

              <details>
                <summary>Ver mais...</summary>

                <div class="chart-container" style="width: 100%;">
                  <center>
                    <canvas id="financasChart" style="max-width: 500px;"></canvas>
                  </center>
                </div>
              </details>
            </div>
          </div>

          <div class="dash-content" style="padding-top: 0;">
            <div class="dash-estatistics">
                  <div class="title"><span class="text">Porcentagem de Despesas e Receitas</span></div>

                  <details>
                    <summary>Ver mais...</summary>

                    <div class="chart-container">
                      <style type="text/css">
                        #despesasReceitasChart {
                          height: 300px!important;
                        }
                      </style>
                      <center>
                      <canvas id="despesasReceitasChart" style="max-width: 300px;"></canvas>
                      </center>
                    </div>
                  </details>
            </div>
          </div>

          <div class="dash-content" style="padding-top: 0;">
            <div class="dash-estatistics">
              <div class="title"><span class="text">Categorias de despesas e receitas</span></div>

              <details>
                <summary>Ver mais...</summary>

                <div class="chart-container">
                  <style type="text/css">
                    #categoriasChart {
                      height: 400px!important;
                    }
                  </style>
                  <center>
                  <canvas id="categoriasChart" style="max-width: 300px;"></canvas>
                  </center>
                </div>
              </details>
            </div>
          </div>
        </div>


      <div class="activity" id="movimentacoes" style="overflow: hidden;background: transparent;box-shadow: none;">
        <center style="margin-bottom: 34px;margin-top: 34px;"><h2>Movimentações Recentes</h2></center>
            <div class="activity-data" style="overflow: hidden;padding: 2rem;padding-bottom: 3rem;background: #f3f3f3;border-radius: 12px;border: 2px solid #958f8f17;">
              <div class="data names">
                <span class="data-title">Usuario</span>
                
                <?php foreach ($data['caixa'] as $item): ?>
                <span class="data-list">
                   <?= $item['nome_usuario']; ?>
                </span>
                <?php endforeach; ?>
              </div>

              <div class="data names">
                <span class="data-title">Valor</span>
                
                <?php foreach ($data['caixa'] as $item): ?>
                <span class="data-list">
                   <?= Money::format($item['valor']); ?>            
                 </span>
                <?php endforeach; ?>
              </div>

              <div class="data names">
                <span class="data-title">Data</span>
                
                <?php foreach ($data['caixa'] as $item): ?>
                <span class="data-list">
                   <?= date('d/m/Y', strtotime($item['data_movimentacao'])); ?>
                </span>
                <?php endforeach; ?>
              </div>

              <div class="data names">
                <span class="data-title">Tipo Movimentação</span>
                
                <?php foreach ($data['caixa'] as $item): ?>
                <span class="data-list">
                   <?= ucfirst($item['tipo_movimentacao']); ?>
                </span>
                <?php endforeach; ?>
              </div>
          </div>
      </div>

      <section class="activity" id="politicas">
        <center style="margin-bottom: 16px;margin-top: 34px;"><h2>Nossas Politicas</h2></center>
        <div class="data names" style="padding: 2rem;">
          <details>
            <summary><h2 style="display: inline; margin-left: 12px; font-size: 1.34rem;cursor: pointer;">Política Financeira:</h2></summary><br>
            

            <h3>1. Pagamentos e Cobranças:</h3> <br> 
            <p>Nossa política financeira garante transparência nas transações. Os pagamentos serão processados com segurança através de plataformas confiáveis. Cobranças e faturas serão enviadas de forma clara, detalhando os valores e serviços contratados.</p> <br>  <br> 

            <h3>2. Cancelamento e Reembolso:</h3> <br> 
            <p>Em caso de cancelamento de serviços ou produtos, reembolsos serão processados de acordo com as regras específicas de cada caso. Certifique-se de verificar os termos e condições aplicáveis antes de prosseguir com qualquer cancelamento.</p> <br> <br>

            <h3>3. Segurança dos Dados Financeiros:</h3> <br>
            <p>Nós levamos a segurança dos seus dados financeiros a sério. Utilizamos métodos de criptografia e proteção para garantir que suas informações financeiras estejam protegidas contra acessos não autorizados.</p> <br> <br>

            <h3>4. Orçamentos e Custos Adicionais:</h3> <br>
            <p>Forneceremos orçamentos detalhados e transparentes para os nossos serviços. Caso haja custos adicionais não previstos, entraremos em contato e buscaremos a sua aprovação antes de prosseguir.</p> <br> <br>

            <h3>5. Prazos de Pagamento:</h3> <br>
            <p>Os prazos de pagamento serão especificados em nossos documentos de faturamento. Pedimos que os pagamentos sejam realizados dentro dos prazos estipulados para garantir a continuidade dos serviços.</p> <br> <br>
          </details>
          <br><br>

          <details>
              <summary><h2 style="display: inline; margin-left: 12px; font-size: 1.34rem;cursor: pointer;">Política de Privacidade:</h2></summary><br>

              <h3>1. Coleta de Informações:</h3> <br>
              <p>Nós coletamos informações financeiras necessárias para processar pagamentos e garantir a prestação adequada dos serviços contratados. Essas informações serão mantidas de forma segura e não serão compartilhadas com terceiros, exceto quando exigido por lei.</p> <br> <br>

              <h3>2. Uso de Dados Financeiros:</h3> <br>
              <p>As informações financeiras fornecidas serão utilizadas apenas para processar pagamentos, cobranças e faturamento relacionado aos serviços contratados. Não utilizaremos essas informações para outros fins sem o seu consentimento expresso.</p> <br> <br>

              <h3>3. Armazenamento Seguro:</h3> <br>
              <p>Utilizamos medidas de segurança rigorosas para armazenar suas informações financeiras. Isso inclui a criptografia de dados e a proteção contra acessos não autorizados.</p> <br> <br>

              <h3>4. Acesso Restrito:</h3> <br>
              <p>Apenas pessoal autorizado terá acesso às informações financeiras. Garantimos que somente as pessoas envolvidas diretamente no processamento de pagamentos e cobranças terão acesso a esses dados.</p> <br> <br>

              <h3>5. Atualizações na Política de Privacidade:</h3> <br>
              <p>Nossa política de privacidade pode ser atualizada conforme necessário. Quaisquer alterações serão comunicadas de forma transparente e serão efetivas a partir da data de atualização.</p>
          </details>

        </div>
      </section>


  </div>
  <?php
  use_js_scripts([ 
    'js.visitante.financas', 
    'js.services.ChartCaixa' 
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
<!------- /BODY --------->
