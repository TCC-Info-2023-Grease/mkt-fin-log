<?php
/**
 * Aluno
*/
class Aluno
{
    private $mysqli;
    private $tabela = 'alunos';
    private $tabela_secundaria = 'caixa';
    private $tabela_terciaria = 'usuarios';

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function cadastrar($dados)
    {
        $query = "
            INSERT INTO 
                {$this->tabela} 
                    (nome)
            VALUES 
                    (?)
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param(
            "s",
            $dados['nome']
        );

        if (!$stmt->execute()) {
            die("Erro ao criar aluno: " . $stmt->error);
        }

        $stmt->close();
    }


    public function cadastrarEmMassa($dados)
    {
        $textComNomeDosAlunos = $dados['nomes_alunos'];

        $listaDeNomesDosAlunos = explode(';', $textComNomeDosAlunos);
        
        $values = '';

        foreach ($listaDeNomesDosAlunos as $key => $value) {

            if (!empty($value) && isset($value)) {
                $values .= "('{$value}')";
                if ($key <= count($listaDeNomesDosAlunos) - 2) {
                    $values .= " , ";
                } else {
                    $values .= " ";
                }
            } else {
                $values .= " ";
            }
            
        }

        $query = "
            INSERT INTO 
                alunos
                (nome)
            VALUES 
                ". $values;

        $stmt = $this->mysqli->query($query);

        return $query;
    }


    public function deletar($id)
    {
        // Verifica se há pagamentos associados a esse aluno
        $sqlPagamentos = "SELECT aluno_id FROM caixa WHERE aluno_id = ?";
        $stmtPagamentos = $this->mysqli->prepare($sqlPagamentos);
        $stmtPagamentos->bind_param('i', $id);
        $stmtPagamentos->execute();
        $resultPagamentos = $stmtPagamentos->get_result();

        if ($resultPagamentos->num_rows > 0) {
            // Aluno tem pagamentos, não pode ser deletado
            return false;
        }

        // Não há pagamentos, pode deletar o aluno
        $sql = "DELETE FROM " . $this->tabela . " WHERE aluno_id = ?";
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
            SET nome = ?
            WHERE aluno_id = ?
        ";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            die('Erro na preparação da query: ' . $this->mysqli->error);
        }

        $stmt->bind_param(
            'si',
            $dados['nome'],
            $dados['id']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            die('Erro na execução da query: ' . $stmt->error);
        }
    }

    public function buscarTodos()
    {
        $query = "SELECT * FROM {$this->tabela}";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $alunos = [];
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $alunos[] = $linha;
        }

        return $alunos;
    }

    public function buscar($id)
    {
        $aluno = [];

        // -- pegar os dados do usuario
        $sql = $this->mysqli->query("
            SELECT 
                a.nome AS nome_aluno, 
                a.*,
                SUM(c.valor) AS total_pago
            FROM 
                {$this->tabela} AS a
            JOIN 
                {$this->tabela_secundaria} AS c 
            ON 
                c.aluno_id = a.aluno_id
            WHERE 
                c.aluno_id = '".$id."'
        ");


        if ($sql->num_rows === 0) {
            return null;
        }

        $aluno = $sql->fetch_assoc();

        // -- pegar as movimentações
        $result = $this->mysqli->query("
            SELECT 
                c.caixa_id,
                c.`categoria`,
                c.`descricao`,
                c.`data_movimentacao`,
                c.`valor`,
                c.`tipo_movimentacao`,
                c.`forma_pagamento`,
                c.`obs`,
                u.nome as nome_usuario
            FROM 
                alunos AS a
            JOIN 
                caixa AS c 
            ON 
                c.aluno_id = a.aluno_id
            JOIN 
                usuarios AS u
            ON 
                u.usuario_id = c.usuario_id
            WHERE 
                c.aluno_id = '".$id."'
        ");

        if ($sql->num_rows === 0) {
            return null;
        }

        $aluno['movimentacoes'] = $result->fetch_all(MYSQLI_ASSOC);

        return $aluno;
    }
}
 
