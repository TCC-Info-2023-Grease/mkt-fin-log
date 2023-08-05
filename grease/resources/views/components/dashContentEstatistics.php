<?php global $data; ?>

<div class="dash-content">
  <center style="margin-bottom: 46px;"><h2>Estatisticas</h2></center>

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

 <div class="dash-content">
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

<div class="dash-content">
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
