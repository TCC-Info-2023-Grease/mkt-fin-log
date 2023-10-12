<?php

class caixa
{
  private $mysqli;
  private $id;
  private $tabela = 'caixa';

  public function getID() {
    return $this->id;
  }

  /**
   * Método construtor da coolasse
   *
   * @param  mysqli $mysqli É a conexão com o banco de dados
   * @return void
   */
  public function __construct(mysqli $mysqli)
  {
    $this->mysqli = $mysqli;
  }

  /**
   * Método para verificar se determinado valor de um campo é único
   *
   * @param int $campo Nome do campo
   * @param int $valor É o valor do campo
   * @return bool|null
   */

  public function unico($campo, $valor)
  {
    $query = "
      SELECT 
          caixa_id 
      FROM 
          " . $this->tabela . " 
      WHERE {$campo} = ?
    ";
    $params = [$valor];

    $stmt = $this->mysqli->prepare($query);

    if (!$stmt) {
      error_log('Erro ao preparar a consulta: ' . $this->mysqli->error);
      return false;
    }

    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    $stmt->execute();

    return !$stmt->fetch();
  }

  public function getRegistros($limit)
  {
      $query = "
        SELECT 
          c.*, u.*, u.nome as nome_usuario
        FROM 
          " . $this->tabela . " as c
        JOIN 
          usuarios AS u ON u.usuario_id = c.usuario_id
        WHERE
          LOWER(c.tipo_movimentacao) = 'despesa' OR
          LOWER(c.tipo_movimentacao) = 'receita'
        ORDER BY data_movimentacao DESC LIMIT ?
      ";
      $stmt = $this->mysqli->prepare($query);
      $stmt->bind_param('i', $limit);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function buscarTodos()
  {
    $stmt = $this->mysqli->query("
      SELECT 
        c.*, u.*, u.nome as nome_usuario
      FROM 
        " . $this->tabela . " as c
      JOIN 
        usuarios AS u ON u.usuario_id = c.usuario_id
      WHERE
        LOWER(c.tipo_movimentacao) = 'despesa' OR
        LOWER(c.tipo_movimentacao) = 'receita'
    ");

    if ($stmt->num_rows === 0) {
      return null;
    }

    while ($linha = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
      $categoria[] = $linha;
    }

    return $categoria;
  }

  public function cadastrarEntrada($dados = [])
  {
    $query = "
      INSERT INTO 
      " . $this->tabela . "
        (
          caixa_id,
          aluno_id,
          usuario_id, 
          categoria,
          descricao, 
          data_movimentacao, 
          valor, 
          tipo_movimentacao, 
          forma_pagamento, 
          obs
        ) 
      VALUES 
        (
          NULL,
          '" . $dados['usuario_id'] . "',
          NULL,
          '" . $dados['categoria'] . "',
          '" . $dados['descricao'] . "',
          '" . $dados['data_movimentacao'] . "',
          '" . $dados['valor'] . "',
          LOWER('" . $dados['tipo_movimentacao'] . "'),
          '" . $dados['forma_pagamento'] . "',
          '" . $dados['obs'] . "'
        );
    ";

    $result   = $this->mysqli->query($query);
    $this->id = $this->mysqli->insert_id;

    if ($result === false) {
      die('Erro ao atualizar o valor da caixa: ' . $this->mysqli->error);
    }

    return $this->mysqli->insert_id;
  }

  public function cadastrarSaida($dados = [])
  {
    $query = "
      INSERT INTO 
      " . $this->tabela . "
        (
          usuario_id, 
          aluno_id,
          categoria,
          descricao, 
          data_movimentacao, 
          valor, 
          tipo_movimentacao, 
          forma_pagamento, 
          obs
        ) 
      VALUES 
        (
          '" . $dados['usuario_id'] . "',
          NULL,
          '" . $dados['categoria'] . "',
          '" . $dados['descricao'] . "',
          '" . $dados['data_movimentacao'] . "',
          '" . $dados['valor'] . "',
          LOWER('" . $dados['tipo_movimentacao'] . "'),
          '" . $dados['forma_pagamento'] . "',
          '" . $dados['obs'] . "'
        );
    ";

    $result = $this->mysqli->query($query);
    
    if ($result === false) 
    {
      die('Erro ao atualizar o valor da caixa: ' . $this->mysqli->error);
    }

    return $this->mysqli->insert_id;
  }

  public function obterSaldoAtual()
  {
    $saldo_atual    = null;
    $result_entrada = null;
    $result_saida   = null;

    $query_entrada = "
      SELECT 
        SUM(valor) as 'valor_entrada'  
      FROM 
        caixa
      WHERE 
        tipo_movimentacao = 'receita'
    ";
    $query_saida = "
      SELECT 
        SUM(valor) as 'valor_saida'
      FROM 
        caixa
      WHERE 
        tipo_movimentacao = 'despesa'
    ";

  try 
  {
    $result_entrada = $this->mysqli->query($query_entrada);  
    $result_saida = $this->mysqli->query($query_saida);

    if ($result_entrada->num_rows === 0 && $result_saida->num_rows === 0) 
    {
      return null;
    }
    
    $result_entrada = mysqli_fetch_array($result_entrada, MYSQLI_ASSOC);
    $result_entrada = $result_entrada['valor_entrada'];
    //ChamaSamu::debug($result_saida);
    $result_saida = mysqli_fetch_array($result_saida);
    $result_saida = $result_saida['valor_saida'];

    $saldo_atual = $result_entrada - $result_saida;
    } catch (Exception $error) 
    {
      $saldo_atual = 0;
    }
    return $saldo_atual;
  }

  public function obterSaldoAnterior() {
    $saldo_anterior = 0;

    $query = "
      SELECT 
        valor
      FROM 
        " . $this->tabela . "
      ORDER BY 
        caixa_id 
      DESC LIMIT 1
    ";
    $result = $this->mysqli->query($query);
    
    if ($result->num_rows === 0) 
    {
      return null;
    }

    $saldo_anterior = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $saldo_anterior['valor'];
  }

  public function obterTotalGasto()
  {
      $query = "
          SELECT 
              SUM(valor) as total_gasto
          FROM 
              " . $this->tabela . "
          WHERE 
              tipo_movimentacao = 'despesa'
      ";

      $result = $this->mysqli->query($query);

      if ($result->num_rows === 0) {
          return 0;
      }

      $row = $result->fetch_assoc();
      $totalGasto = $row['total_gasto'];

      return $totalGasto;
  }

  public function buscar($id)
  {
    $sql = $this->mysqli->query("
      SELECT 
        c.*, u.*, u.nome as nome_usuario
      FROM 
        " . $this->tabela . " as c
      JOIN 
        usuarios AS u ON u.usuario_id = c.usuario_id
      WHERE 
        caixa_id = '" . $id ."' 
    ");

    if ($sql->num_rows === 0) {
      return null;
    }

    $row = $sql->fetch_assoc();
    
    return $row;
  }

  
  public function deletar($id)
  {
    $sql = "
      DELETE FROM 
        " . $this->tabela . "  
      WHERE caixa_id = ?
    ";
    $stmt = $this->mysqli->prepare($sql);

    if (!$stmt) {
      die('Erro na preparação da query: ' . $this->mysqli->error);
    }

    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
      if ($stmt->affected_rows > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      die('Erro na execução da query: ' . $this->mysqli->error);
    }
  }

  /**
   * Obtém os dados de despesas e receitas por mês e calcula os saldos mensais
   *
   * @return array Um array associativo contendo as receitas, despesas e saldos por mês
   */
  public function obterDadosDespesasReceitasPorMes()
  {
    // Consulta para obter as receitas e despesas por mês do banco de dados
    $query = "
      SELECT 
        DATE_FORMAT(data_movimentacao, '%b') as mes,
        SUM(CASE WHEN LOWER(tipo_movimentacao) = 'receita' THEN valor ELSE 0 END) as receita,
        SUM(CASE WHEN LOWER(tipo_movimentacao) = 'despesa' THEN valor ELSE 0 END) as despesa
      FROM caixa
      GROUP BY mes
    ";
    $result = $this->mysqli->query($query);

    // Inicializa os arrays para armazenar os dados
    $meses = [];
    $receitas = [];
    $despesas = [];
    $saldos = [];
    $balance = 0;

    while ($row = $result->fetch_assoc()) {
      $meses[] = $row['mes'];
      $receitas[] = (float)$row['receita'];
      $despesas[] = (float)$row['despesa'];
      $balance += (float)$row['receita'] - (float)$row['despesa'];
      $saldos[] = $balance;
    }

    // Retornar os dados em um array associativo
    return [
      'meses' => $meses,
      'receitas' => $receitas,
      'despesas' => $despesas,
      'saldos' => $saldos
    ];
  }

  /**
   * Obtém os dados das categorias com os totais de despesas e receitas
   *
   * @return array Retorna um array com os dados das categorias e seus totais
   */
  public function obterDadosCategorias()
  {
    $dadosCategorias = array();

    // Consulta SQL para obter os totais de despesas e receitas por categoria
    $sql = "SELECT 
              categoria, 
              SUM(CASE WHEN LOWER(tipo_movimentacao) = 'despesa' THEN valor ELSE 0 END) as total_despesa,
              SUM(CASE WHEN LOWER(tipo_movimentacao) = 'receita' THEN valor ELSE 0 END) as total_receita
            FROM 
              $this->tabela
            GROUP BY categoria";

    // Executa a consulta
    $result = $this->mysqli->query($sql);

    // Verifica se a consulta foi bem-sucedida
    if ($result) {
      // Converte os resultados em um array associativo
      while ($row = $result->fetch_assoc()) {
        $dadosCategorias[] = $row;
      }
    }

    return $dadosCategorias;
  }

}