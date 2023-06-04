<?php

class SaidaMaterial
{
  private $mysqli;
  private $tabela = "saidasmaterial";

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
        saida_id,
        material_id,	
        caixa_id,	
        usuario_id,	
        qtde_compra,	
        obs
      ) 
        VALUES 
      (
        NULL,
        '" . $dados['material_id'] . "',
        '" . $dados['caixa_id'] . "',
        '" . $dados['usuario_id'] . "',
        '" . $dados['qtde_compra'] . "',
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
        saida_m.*, 
        u.*, u.nome AS nome_usuario, 
        m.*,
        c.*
      FROM 
        ". $this->tabela ." AS saida_m
      JOIN 
        materiais AS m ON m.material_id = saida_m.material_id
     JOIN 
        caixa AS c ON c.caixa_id = saida_m.caixa_id
      JOIN 
        usuarios AS u ON u.usuario_id = saida_m.usuario_id
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