<?php
/**
 * conta
*/
class Conta 
{
    private $mysqli;
    private $tabela = 'contas';

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function cadastrar($dados)
    {
        $query = "
            INSERT INTO 
                {$this->tabela} 
                    (fornecedor_id, usuario_id, titulo, descricao, valor, data_validade, data_insercao)
            VALUES 
                    (?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param(
            "iissdss",
            $dados['fornecedor_id'],
            $dados['usuario_id'],
            $dados['titulo'],
            $dados['descricao'],
            $dados['valor'],
            $dados['data_validade'],
            $dados['data_insercao']
        );

        if (!$stmt->execute()) {
            die("Erro ao criar fornecedor: " . $stmt->error);
        }

        $stmt->close();
    }


    public function deletar($id)
    {
        // Não há pagamentos, pode deletar 
        $sql = "
            DELETE FROM "
                . $this->tabela . " 
            WHERE 
                conta_id = ?";
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


    public function atualizar($dados)
    {
        $query = "
            UPDATE 
                {$this->tabela}
            SET 
                fornecedor_id = ?,
                usuario_id = ?,
                titulo = ?,
                descricao = ?,
                valor = ?,
                data_validade = ?
            WHERE 
                {$this->tabela}_id = ?
        ";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            die('Erro na preparação da query: ' . $this->mysqli->error);
        }

        $stmt->bind_param(
            "iissdsi",
            $dados['fornecedor_id'],
            $dados['usuario_id'],
            $dados['titulo'],
            $dados['descricao'],
            $dados['valor'],
            $dados['data_validade'],
            $dados['conta_id']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            die('Erro na execução da query: ' . $stmt->error);
        }
    }

    public function buscarTodos()
    {
        $query = "
            SELECT 
                c.conta_id,
                c.titulo,
                c.descricao,
                c.valor,
                c.data_validade,
                c.data_insercao,
                f.nome as fornecedor,
                u.nome as usuario,
                u.*, f.*, c.*
            FROM 
                {$this->tabela} as c
            LEFT JOIN 
                fornecedores f ON c.fornecedor_id = f.fornecedor_id
            LEFT JOIN 
                usuarios u ON c.usuario_id = u.usuario_id
            ORDER BY c.data_validade ASC
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $contas = [];
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $contas[] = $linha;
        }

        return $contas;
    }

    public function buscar($id)
    {
        $conta = [];

        $sql = $this->mysqli->query("
            SELECT 
                c.conta_id,
                c.titulo,
                c.descricao,
                c.valor,
                c.data_validade,
                c.data_insercao,
                f.nome as fornecedor,
                u.nome as usuario,
                u.*, f.*, c.*
            FROM 
                {$this->tabela} as c
            LEFT JOIN 
                fornecedores f ON c.fornecedor_id = f.fornecedor_id
            LEFT JOIN 
                usuarios u ON c.usuario_id = u.usuario_id
            WHERE 
                {$this->tabela}_id = '".$id."'
        ");


        if ($sql->num_rows === 0) {
            return null;
        }

        $conta = $sql->fetch_assoc();

        return $conta;
    }
}
 
