<?php
/**
 * Aluno
*/
class Aluno
{
    private $mysqli;
    private $tabela = 'alunos';
    private $tabela_secundaria = 'caixa';

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
        $sql = $this->mysqli->query("
            SELECT 
                c.*,
                a.*,
                u.nome as nome_usuario,
                SUM(c.valor) AS total_pago
            FROM 
                {$this->tabela} as a
            JOIN 
                {$this->tabela_secundaria} as c 
            ON 
                c.aluno_id = a.aluno_id
            JOIN
                usuarios as u
            ON
                u.usuario_id = c.usuario_id
            WHERE 
                c.usuario_id = '".$id."'
        ");


        if ($sql->num_rows === 0) {
            return null;
        }

        $aluno = $sql->fetch_assoc();
        return $aluno;
    }
}
 
