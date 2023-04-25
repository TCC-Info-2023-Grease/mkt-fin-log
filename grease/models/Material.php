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

    public function cadastrar($dados = [], $tipos_dados) {
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
                ?, ?, ?, ?, ?, ?
            );
        ";

        $stmt = $this->mysqli->prepare($query);
        $tipo_dados = "ssiiidiidssss";
        
        $stmt->bind_param(
            $tipos_dados,
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
