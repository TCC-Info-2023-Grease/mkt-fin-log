<?php

class Meta
{
  private $mysqli;
  private $id;
  private $tabela = 'meta';

  public function getID()
  {
    return $this->id;
  }

  /**
   * Método construtor da classe
   *
   * @param mysqli $mysqli A conexão com o banco de dados
   */
  public function __construct(mysqli $mysqli)
  {
    $this->mysqli = $mysqli;
  }

  /**
   * Método para buscar todas as metas
   *
   * @return array|null Os dados das metas encontradas
   */
  public function buscarTodos()
  {
    $stmt = $this->mysqli->query("
      SELECT *
      FROM " . $this->tabela
    );

    if ($stmt->num_rows === 0) {
      return null;
    }

    $metas = [];
    while ($meta = $stmt->fetch_assoc()) {
      $metas[] = $meta;
    }

    return $metas;
  }

   /**
   * Método para obter a meta ativa
   *
   * @return array|null Os dados da meta ativa encontrada
   */
  public function obterMetaAtiva()
  {
    $stmt = $this->mysqli->prepare("
      SELECT *
      FROM " . $this->tabela . "
      WHERE status = 1
    ");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
      return null;
    }

    return $result->fetch_assoc();
  }

 /**
 * Obtém o total necessário das metas com status ativo (1)
 *
 * @return float O total necessário das metas ativas
 */
  public function obterTotalNecessarioAtivo()
	{
	  $stmt = $this->mysqli->query("
	    SELECT total_necessario
	    FROM " . $this->tabela . "
	    WHERE status = 1
	  ");

	  if ($stmt->num_rows === 0) {
	    return 0;
	  }

	  $row = $stmt->fetch_assoc();
	  return $row['total_necessario'];
	}

  /**
   * Método para buscar uma meta pelo seu ID
   *
   * @param int $id O ID da meta a ser buscada
   * @return array|null Os dados da meta encontrada
   */
  public function buscarPorID($id)
  {
    $stmt = $this->mysqli->prepare("
      SELECT *
      FROM " . $this->tabela . "
      WHERE id = ?
    ");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
      return null;
    }

    return $result->fetch_assoc();
  }

  /**
   * Método para cadastrar uma nova meta
   *
   * @param array $dados Os dados da meta a ser cadastrada
   * @return bool True se a meta foi cadastrada com sucesso, False caso contrário
   */
  public function cadastrar($dados)
  {
    $stmt = $this->mysqli->prepare("
      INSERT INTO " . $this->tabela . " (nome, descricao, data_inicio, data_fim, total_necessario)
      VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param('ssssd', $dados['nome'], $dados['descricao'], $dados['data_inicio'], $dados['data_fim'], $dados['total_necessario']);

    if ($stmt->execute()) {
      $this->id = $stmt->insert_id;
      return true;
    } else {
      return false;
    }
  }

  /**
   * Método para atualizar os dados de uma meta
   *
   * @param int $id O ID da meta a ser atualizada
   * @param array $dados Os novos dados da meta
   * @return bool True se a meta foi atualizada com sucesso, False caso contrário
   */
  public function atualizar($dados)
  {
    $stmt = $this->mysqli->prepare("
      UPDATE " . $this->tabela . "
      SET nome = ?, descricao = ?, data_inicio = ?, data_fim = ?, total_necessario = ?
      WHERE id = ?
    ");
    $stmt->bind_param('ssssdi', $dados['nome'], $dados['descricao'], $dados['data_inicio'], $dados['data_fim'], $dados['total_necessario'], $dados['meta_id']);

    return $stmt->execute();
  }

  /**
   * Método para excluir uma meta
   *
   * @param int $id O ID da meta a ser excluída
   * @return bool True se a meta foi excluída com sucesso, False caso contrário
   */
  public function excluir($id)
  {
    $stmt = $this->mysqli->prepare("
      DELETE FROM " . $this->tabela . "
      WHERE meta_id = ?
    ");
    $stmt->bind_param('i', $id);

    return $stmt->execute();
  }

  public function alterarStatus($id, $novoStatus)
  {
      // Verifica se o novo status é um valor válido (0 para desativar, 1 para ativar)
      if ($novoStatus === 0 || $novoStatus === 1) {
          // Se o novo status for ativar (1), desativar todas as outras entradas primeiro
          if ($novoStatus === 1) {
              $query = "
                  UPDATE " . $this->tabela . "
                  SET status = 0
              ";

              $result = $this->mysqli->query($query);
              if ($result === false) {
                  die('Erro ao desativar todas as outras entradas: ' . $this->mysqli->error);
              }
          }

          // Atualiza o status da entrada desejada para o novo status
          $query = "
              UPDATE " . $this->tabela . "
              SET status = ?
              WHERE id = ?
          ";

          $stmt = $this->mysqli->prepare($query);
          if (!$stmt) {
              die('Erro na preparação da query: ' . $this->mysqli->error);
          }

          $stmt->bind_param('ii', $novoStatus, $id);

          if ($stmt->execute()) {
              return true;
          } else {
              die('Erro na execução da query: ' . $this->mysqli->error);
          }

          $stmt->close();
      }

      return false;
  }

}


