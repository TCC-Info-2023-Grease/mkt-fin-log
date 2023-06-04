<?php

class Caixa
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

  public function buscarTodos()
  {
    $stmt = $this->mysqli->query("
      SELECT 
        c.*, u.*, u.nome as nome_usario
      FROM 
        " . $this->tabela . " as c
      JOIN 
        usuarios AS u ON u.usuario_id = c.usuario_id
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
          '" . $dados['categoria'] . "',
          '" . $dados['descricao'] . "',
          '" . $dados['data_movimentacao'] . "',
          '" . $dados['valor'] . "',
          '" . $dados['tipo_movimentacao'] . "',
          '" . $dados['forma_pagamento'] . "',
          '" . $dados['obs'] . "'
        );
    ";

    $result   = $this->mysqli->query($query);
    $this->id = $this->mysqli->insert_id;

    if ($result === false) {
      die('Erro ao atualizar o valor da Caixa: ' . $this->mysqli->error);
    }
  }

  public function cadastrarSaida($dados = [])
  {
    $query = "
      INSERT INTO 
      " . $this->tabela . "
        (
          caixa_id,
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
          '" . $dados['categoria'] . "',
          '" . $dados['descricao'] . "',
          '" . $dados['data_movimentacao'] . "',
          '" . $dados['valor'] . "',
          '" . $dados['tipo_movimentacao'] . "',
          '" . $dados['forma_pagamento'] . "',
          '" . $dados['obs'] . "'
        );
    ";

    $result = $this->mysqli->query($query);
    if ($result === false) 
    {
      die('Erro ao atualizar o valor da Caixa: ' . $this->mysqli->error);
    }
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
        CAIXA
      WHERE 
        tipo_movimentacao = 'Entrada'
    ";
    $query_saida = "
      SELECT 
        SUM(valor) as 'valor_saida'
      FROM 
        CAIXA
      WHERE 
        tipo_movimentacao = 'Saida'
    ";

    $result_entrada = $this->mysqli->query($query_entrada);  
    $result_saida = $this->mysqli->query($query_saida);

    if ($result_entrada->num_rows === 0 && $result_saida->num_rows === 0) 
    {
      return null;
    }

    $result_entrada = mysqli_fetch_array($result_entrada, MYSQLI_ASSOC);
    $result_entrada = $result_entrada['valor_entrada'];
    $result_saida = mysqli_fetch_array($result_saida, MYSQLI_ASSOC);
    $result_saida = $result_saida['valor_saida'];

    $saldo_atual = $result_entrada - $result_saida;
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

}
