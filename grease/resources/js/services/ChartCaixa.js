class ChartCaixa {
  static saldoMensal ($saldos, $meses) {
    const ctx = document.getElementById("financasChart").getContext("2d");

    const chartData = {
      labels: $meses,
      datasets: [{
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
      labels: ["Receitas",
        "Despesas"],
      datasets: [{
        data: [$porcentagemReceitas,
          $porcentagemDespesas],
        backgroundColor: ["rgba(75, 192, 192, 0.2)",
          "rgba(255, 99, 132, 0.2)"],
        borderColor: ["rgba(75, 192, 192, 1)",
          "rgba(255, 99, 132, 1)"],
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
        datasets: [{
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
          }]
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

  static gastosUltimoMes(gastosUltimoMes) {
    // Obtém os dados do PHP e converte para JavaScript
    const dadosGastos = gastosUltimoMes;

    // Prepara os dados para o gráfico
    const labels = ['Total de Gastos',
      'Maior Gasto'];
    const valores = [dadosGastos.totalGastos,
      dadosGastos.maiorGasto];

    // Cria o gráfico
    const ctx3 = document.getElementById('graficoGastos').getContext('2d');
    const grafico = new Chart(ctx3, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Gastos no Último Mês',
          data: valores,
          backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
          borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  }

  static materialPorStatus(statusLabels, statusContagens) {
        // Configure os dados para o gráfico de pizza
        const ctx2 = document.getElementById('statusChart').getContext('2d');
        
        const statusChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: statusLabels, // Rótulos de status 
                datasets: [{
                    data: statusContagens, // Dados de contagem
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'], // Cores das fatias
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'], // Cores da borda das fatias
                    borderWidth: 1
                }]
            }
        });
    }
    
    
  static quantidadeMateriais(quantidadeMateriais, categoriasMateriais) {
    const data = {
        labels: categoriasMateriais,
        datasets: [{
            label: 'Materiais por Categoria',
            data: quantidadeMateriais, 
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)', // Cor da categoria 1
                'rgba(54, 162, 235, 0.2)', // Cor da categoria 2
                'rgba(255, 206, 86, 0.2)'  // Cor da categoria 3
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Opções de configuração do gráfico
    const options = {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantidade de Materiais'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Categorias'
                }
            }
        }
    };

    // Obtendo o contexto do canvas
    const ctx = document.getElementById('materialCategoriaChart').getContext('2d');

    // Criando o gráfico de barras
    const myChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico
        data: data,   // Dados
        options: options // Opções de configuração
    });
  }
}