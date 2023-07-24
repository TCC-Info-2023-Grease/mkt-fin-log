<?php
/**
 * Classe SaidaMaterial
 * 
 * Essa classe representa o registro de Saída de Material no sistema e gerencia suas operações.
 */
class SaidaMaterial
{
    private $mysqli;
    private $tabela = "saidasmaterial";

    /**
     * Método construtor da classe
     *
     * @param  mysqli $mysqli É a conexão com o banco de dados
     * @return void
     */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * Cadastra uma nova Saída de Material no sistema
     * 
     * @param array $dados Dados da Saída de Material a ser cadastrada
     * @return void
     */
    public function cadastrar($dados = [])
    {
        $query = "
            INSERT INTO {$this->tabela} (
                saida_id,
                material_id,  
                caixa_id, 
                usuario_id, 
                qtde_compra,  
                obs
            ) 
            VALUES (?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param(
            "iisids",
            NULL,
            $dados['material_id'],
            $dados['caixa_id'],
            $dados['usuario_id'],
            $dados['qtde_compra'],
            $dados['obs']
        );  
        
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Busca todos os registros de Saída de Material cadastrados no sistema
     * 
     * @return array|null Array contendo todos os registros de Saída de Material ou null em caso de erro
     */
    public function buscarTodos()
    {
        $stmt = $this->mysqli->query("
            SELECT 
                saida_m.*, 
                u.nome AS nome_usuario, u.*, 
                m.*, m.nome AS nome_material,
                c.*
            FROM 
                {$this->tabela} AS saida_m
            JOIN 
                materiais AS m ON m.material_id = saida_m.material_id
            JOIN 
                caixa AS c ON c.caixa_id = saida_m.caixa_id
            JOIN 
                usuarios AS u ON u.usuario_id = saida_m.usuario_id
            ORDER BY c.data_movimentacao DESC
        ");

        if ($stmt->num_rows === 0) {
            return null;
        }

        $materiais = array();
        while ($linha = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
            $materiais[] = $linha;
        }

        return $materiais;
    }
}
