class ChartCaixa {
  static saldoMensal ($saldos, $meses) {
    const ctx = document.getElementById("financasChart").getContext("2d");

    const chartData = {
      labels: $meses,
      datasets: [
        {
          label: "Saldo",
          data: $saldos,
          borderColor: "rgba(75, 192, 192, 1)",
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          fill: true,
        },
      ],
    };

    const chartConfig = {
      type: "line",
      data: chartData,
      options: {
        responsive: true,
        scales: {
          x: {
            display: true,
            title: {
              display: true,
              text: "Mês",
            },
          },
          y: {
            display: true,
            title: {
              display: true,
              text: "Saldo",
            },
          },
        },
      },
    };

    new Chart(ctx, chartConfig);
  }

  static despesasReceitas($porcentagemDespesas, $porcentagemReceitas) {
    const ctx2 = document.getElementById("despesasReceitasChart").getContext("2d");

    const chartData2 = {
      labels: ["Receitas", "Despesas"],
      datasets: [
        {
          data: [ $porcentagemReceitas, $porcentagemDespesas ],
          backgroundColor: ["rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)"],
          borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)"],
          borderWidth: 1,
        },
      ],
    };

    const chartConfig2 = {
      type: "pie",
      data: chartData2,
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: "bottom",
          },
        },
      },
    };

    new Chart(ctx2, chartConfig2);
  }

  static receitasDespesasPorCategoria($dados) {
    const dadosCategorias = $dados;

    let labelsCategorias = dadosCategorias.map(item => item.categoria);

    let totalDespesas = dadosCategorias.map(item => item.total_despesa);
    let totalReceitas = dadosCategorias.map(item => item.total_receita);

    
    let ctxCategorias = document.getElementById('categoriasChart').getContext('2d');
    let categoriasChart = new Chart(ctxCategorias, {
      type: 'bar',
      data: {
        labels: labelsCategorias,
        datasets: [
          {
            label: 'Despesas',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            data: totalDespesas,
          },
          {
            label: 'Receitas',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: totalReceitas,
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            stacked: true,
          },
          y: {
            beginAtZero: true,
          }
        }
      }
    });
  }
}