<?php

class Material
{
  private $mysqli;
  private $tabela = "materiais";

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
          id 
      FROM 
          " . $this->tabela . " 
      WHERE {$campo} = ?
    ";
    $params = [$valor];

    $stmt = $this->mysqli->prepare($query);

    if (!$stmt) {
      error_log("Erro ao preparar a consulta: " . $this->mysqli->error);
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
            m.*, c.nome AS nome_categoria
      FROM 
          " . $this->tabela . " as m
      JOIN 
          categoriasmaterial AS c ON m.categoria_id = c.categoria_id
      ORDER BY 
          m.nome ASC
    ");

    if ($stmt->num_rows === 0) {
      return null;
    }

    while ($linha = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
      $materiais[] = $linha;
    }

    return $materiais;
  }

  public function buscar($id)
  {
    $sql = $this->mysqli->query("
        SELECT 
            m.*
        FROM 
            " . $this->tabela . " as m
        WHERE 
            material_id = '" . $id . "'
        ");

    if ($sql->num_rows === 0) {
      return null;
    }

    $row = $sql->fetch_assoc();

    return $row;
  }

  public function cadastrar($dados = [])
  {
    $query = "
            INSERT INTO 
            " . $this->tabela . "
                (
                    nome, 
                    categoria_id,
                    descricao, 
                    qtde_estimada, 
                    valor_estimado, 
                    valor_gasto, 
                    unidade_medida, 
                    estoque_minimo, 
                    estoque_atual,
                    valor_unitario, 
                    datahora_cadastro, 
                    data_validade, 
                    foto_material, 
                    status_material
                ) 
            VALUES 
                (
                    '" . $dados['nome'] . "',
                    '" . $dados['categoria_id'] . "',
                    '" . $dados['descricao'] . "',
                    '" . $dados['qtde_estimada'] . "',
                    '" . $dados['valor_estimado'] . "',
                    '" . $dados['valor_gasto'] . "',
                    '" . $dados['unidade_medida'] . "',
                    '" . $dados['estoque_minimo'] . "',
                    '" . $dados['estoque_atual'] . "',
                    '" . $dados['valor_unitario'] . "',
                    '" . $dados['datahora_cadastro'] . "',
                    '" . $dados['data_validade'] . "',
                    '" . $dados['foto_material'] . "',
                    '" . $dados['status_material'] . "'
                );
        ";

    $result = $this->mysqli->query($query);

    if ($result === false) {
      die("Erro ao executar a consulta: " . $this->mysqli->error);
    }
  }

  public function setarEntradaEstoque($dados = [])
  {
    $query = "
      UPDATE
        " . $this->tabela . "
      SET 
        estoque_atual   = estoque_atual + " . $dados['qtde_compra'] . "
      WHERE material_id = " . $dados['material_id'];

    $result = $this->mysqli->query($query);

    if ($result === false) {
      die("Erro ao executar a consulta: " . $this->mysqli->error);
    }
  }
  public function setarSaidaEstoque($dados = [])
  {
    $query = "
      UPDATE
        " . $this->tabela . "
      SET 
        estoque_atual   = estoque_atual - " . $dados['qtde_compra'] . "
      WHERE material_id = " . $dados['material_id'];

    $result = $this->mysqli->query($query);

    if ($result === false) {
      die("Erro ao executar a consulta: " . $this->mysqli->error);
    }
  }

  public function atualizar($dados = [])
  {
    $query = "
      UPDATE
      " . $this->tabela . "
      SET 
          nome = '" . $dados['nome'] . "', 
          categoria_id      = '" . $dados['categoria_id'] . "',
          descricao         = '" . $dados['descricao'] . "', 
          qtde_estimada     = '" . $dados['qtde_estimada'] . "', 
          valor_estimado    = '" . $dados['valor_estimado'] . "',
          valor_gasto       = '" . $dados['valor_gasto'] . "',
          unidade_medida    = '" . $dados['unidade_medida'] . "',
          estoque_minimo    = '" . $dados['estoque_minimo'] . "',
          estoque_atual     = '" . $dados['estoque_atual'] . "',
          valor_unitario    = '" . $dados['valor_unitario'] . "',
          datahora_cadastro = '" . $dados['datahora_cadastro'] . "',
          data_validade     = '" . $dados['data_validade'] . "',
          foto_material     = '" . $dados['foto_material'] . "',
          status_material   = '" . $dados['status_material'] . "'
      WHERE material_id = '" . $dados['id'] . "'    
    ";

    $result = $this->mysqli->query($query);

    if ($result === false) {
      die("Erro ao executar a consulta: " . $this->mysqli->error);
    }
  }


  public function deletar($id)
  {
   $sql = "
      DELETE FROM 
        " . $this->tabela . "  
      WHERE material_id = ?
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

    $stmt->close();
  }


}