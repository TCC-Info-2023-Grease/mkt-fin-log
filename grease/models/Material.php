<?php

class Material extends Model {
    private $mysqli;
    private $tabela = "materiais";

    /**
     * Método construtor da classe
     *
     * @param  mysqli $mysqli É a conexão com o banco de dados
     * @return void
     */
    public function __construct(mysqli $mysqli) {
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

    public function cadastrar($dados = []) {
        $query = "
        INSERT INTO 
        ".$this->tabela."
            (
                nome, 
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
                ?, ?, ?, ?, ?, ?, ?, 
                ?, ?, ?, ?, ?, ?, ?
            );
        ";

        $stmt = $this->mysqli->prepare($query);
        
        $stmt->bind_param(
            "ssiiidiidssss",
            $dados['nome'],
            $dados['descricao'],
            $dados['qtde_estimada'],
            $dados['valor_estimado'],
            $dados['valor_gasto'],
            $dados['unidade_medida'],
            $dados['estoque_minimo'],
            $dados['estoque_atual'],
            $dados['valor_unitario'],
            $dados['datahora_cadastro'],
            $dados['data_validade'],
            $dados['foto_material'],
            $dados['status_material']
        );

        $stmt->execute();
        $stmt->close();
    }

    
}
