/**
 * A classe ChartCaixa fornece métodos estáticos para criar diversos tipos de gráficos usando a biblioteca Chart.js.
 * @class
 */
class ChartCaixa {
  /**
   * Gera um gráfico de linha para exibir o saldo mensal ao longo do tempo.
   * @static
   * @param {number[]} $saldos - Array contendo os saldos mensais.
   * @param {string[]} $meses - Array contendo os nomes dos meses correspondentes.
   */
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

    /**
   * Gera um gráfico de pizza para exibir a distribuição percentual entre despesas e receitas.
   * @static
   * @param {number} $porcentagemDespesas - Percentual de despesas.
   * @param {number} $porcentagemReceitas - Percentual de receitas.
   */
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

    /**
   * Gera um gráfico de pizza para exibir a distribuição percentual entre despesas e receitas.
   * @static
   * @param {number} $porcentagemDespesas - Percentual de despesas.
   * @param {number} $porcentagemReceitas - Percentual de receitas.
   */ 
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

    /**
   * Gera um gráfico de pizza para exibir a distribuição percentual entre despesas e receitas.
   * @static
   * @param {number} $porcentagemDespesas - Percentual de despesas.
   * @param {number} $porcentagemReceitas - Percentual de receitas.
   */
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

   /**
   * Gera um gráfico de pizza para exibir a distribuição percentual de materiais por status.
   * @static
   * @param {string[]} statusLabels - Array contendo rótulos de status.
   * @param {number[]} statusContagens - Array contendo contagens de materiais por status.
   */
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
    
   /**
   * Gera um gráfico de barras para exibir a quantidade de materiais por categoria.
   * @static
   * @param {number[]} quantidadeMateriais - Array contendo a quantidade de materiais por categoria.
   * @param {string[]} categoriasMateriais - Array contendo as categorias de materiais.
   */
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
  
  /**
   * Gera um gráfico de pizza mostrando o status das contas, com base na data especificada.

  * @param {Date} data A data a partir da qual o status das contas será gerado.

  * @returns {void}
  */
  static statusConta(data) {
    var dados = {
      labels: ['Não Pago', 'Pago'],
      datasets: [{
        data: data,
        backgroundColor: ['red', 'green']
      }]
    };

    var ctx = document.getElementById('statusContaChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: dados,
    });
  }

  /**
   * Gera um gráfico de barras mostrando o valor total das contas por fornecedor.

  * @param {string[]} fornecedores Uma lista de fornecedores.

  * @param {number[]} valores Uma lista de valores totais das contas, por fornecedor.

  * @returns {void}
  */
  static contasPorFornecedor(fornecedores, valores) {
    var dados = {
      labels: fornecedores,
      datasets: [{
        label: 'Valor em R$',
        data: valores
      }]
    };

    var ctx = document.getElementById('valorFornecedorChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: dados,
    });
  }


  /**
   * Gera um gráfico de linha mostrando a evolução do valor total das contas ao longo dos meses especificados.

  * @param {string[]} meses Uma lista de meses.

  * @param {number[]} data Uma lista de valores totais das contas, por mês.

  * @returns {void}
  */
  static contasEvolucaoValorTota(meses, data) {
    var dados = {
      labels: meses,
      datasets: [{
        label: 'Valor em R$',
        data: data,
        borderColor: 'blue',
        fill: false
      }]
    };

    var ctx = document.getElementById('evolucaoValorChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: dados,
    });
  }

}