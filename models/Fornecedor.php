<?php
/**
 * fornecedor
*/
class Fornecedor
{
    private $mysqli;
    private $tabela = 'fornecedores';

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function cadastrar($dados)
    {
        $query = "
            INSERT INTO 
                {$this->tabela} 
                    (nome, cnpj, ender, email, celular, descricao, status_fornecedor)
            VALUES 
                    (?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param(
            "sssssss",
            $dados['nome_fornecedor'],
            $dados['cnpj'],
            $dados['ender'],
            $dados['email_fornecedor'],
            $dados['celular'],
            $dados['descricao_fornecedor'],
            $dados['status_fornecedor']
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
                fornecedor_id = ?";
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
            UPDATE {$this->tabela}
            SET 
                nome = ?,
                cnpj = ?,
                email = ?,
                ender = ?,
                celular = ?,
                descricao = ?,
                status_fornecedor = ?
            WHERE 
                fornecedor_id = ?
        ";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            die('Erro na preparação da query: ' . $this->mysqli->error);
        }

        $stmt->bind_param(
            'sssssssi',
            $dados['nome_fornecedor'],
            $dados['cnpj'],
            $dados['email_fornecedor'],
            $dados['ender'],
            $dados['celular'],
            $dados['descricao_fornecedor'],
            $dados['status_fornecedor'],
            $dados['fornecedor_id']
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
                nome as nome_fornecedor,
                ender as ender_fornecedor, 
                celular as celular_fornecedor,
                fornecedores.*
            FROM 
                {$this->tabela}
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $fornecedores = [];
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $fornecedores[] = $linha;
        }

        return $fornecedores;
    }

    public function buscar($id)
    {
        $fornecedor = [];

        $sql = $this->mysqli->query("
            SELECT 
                *
            FROM 
                fornecedores
            WHERE 
                fornecedor_id = '".$id."'
        ");


        if ($sql->num_rows === 0) {
            return null;
        }

        $fornecedor = $sql->fetch_assoc();

        return $fornecedor;
    }
}
 
