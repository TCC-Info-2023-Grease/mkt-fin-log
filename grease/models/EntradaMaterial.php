<?php

class EntradaMaterial
{
  private $mysqli;
  private $tabela = "entradasmaterial";

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

  public function cadastrar($dados = [])
  {
    $query = "
      INSERT INTO 
        " . $this->tabela . "
      (
        entrada_id,
        material_id,	
        caixa_id,	
        usuario_id,	
        qtde_compra,	
        valor_gasto, 
        obs
      ) 
        VALUES 
      (
        NULL,
        '" . $dados['material_id'] . "',
        '" . $dados['caixa_id'] . "',
        '" . $dados['usuario_id'] . "',
        '" . $dados['qtde_compra'] . "',
        '" . $dados['valor_gasto'] . "',
        '" . $dados['obs'] . "'
      );
  ";

    $result = $this->mysqli->query($query);

    if ($result === false) {
      die("Erro ao executar a consulta: " . $this->mysqli->error);
    }
  }

  public function buscarTodos()
  {
    $stmt = $this->mysqli->query("
      SELECT 
        entrada_m.*, 
        u.*, u.nome AS nome_usuario, 
        m.*,
        c.*
      FROM 
        ". $this->tabela ." AS entrada_m
      JOIN 
        materiais AS m ON m.material_id = entrada_m.material_id
     JOIN 
        caixa AS c ON c.caixa_id = entrada_m.caixa_id
      JOIN 
        usuarios AS u ON u.usuario_id = entrada_m.usuario_id
      ORDER BY 
        m.nome ASC
    ");

    if ($stmt->num_rows === 0) {
      return null;
    }

    while ($linha = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
      $materiais[] = $linha;
    }

    // print_r($materiais);
    return $materiais;
  }

}

?>