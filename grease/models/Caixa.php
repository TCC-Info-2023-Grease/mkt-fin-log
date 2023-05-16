<?php

class Caixa
{
  private $mysqli;
  private $tabela = 'caixa';

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
                 c.*, u.*
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

    $result = $this->mysqli->query($query);

    if ($result === false) {
      die('Erro ao executar a consulta: ' . $this->mysqli->error);
    } 

    $caixa_id = $this->buscarEntrada([ $dados['usuario_id'], $dados['data_movimentacao'] ]);
    $this->atualizarEntradaCaixa([ 'valor' => $dados['valor'], 'caixa_id' => $caixa_id]); 
  }

  public function buscarEntrada($dados = []) {
    $stmt = $this->mysqli->query("
        SELECT 
              c.id
        FROM 
            " . $this->tabela . " as c
        WHERE 
        '" . $dados[0] . "',
        '" . $dados[1] . "',
    ");

    if ($stmt->num_rows === 0) {
      return null;
    }

    if ($stmt->num_rows === 0) {
      return null;
    }
  
    $row = $stmt->fetch_assoc();
    $id = $row['id'];
  }


  public function atualizarEntradaCaixa($dados = [])
  {
    $query = "
      UPDATE
      " . $this->tabela . "
      SET 
        valor = '" . $dados['valor'] . "'
      WHERE caixa_id = '" . $dados['caixa_id'] . "',
    ";

    $result = $this->mysqli->query($query);

    if ($result === false) {
      die('Erro ao executar a consulta: ' . $this->mysqli->error);
    }
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