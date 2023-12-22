<?php

class Task
{
    private $mysqli;
    private $tabela = 'tarefas';

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function cadastrar($dados)
    {
        $query = "
            INSERT INTO 
                {$this->tabela} 
                    (titulo, descricao, data_de_vencimento, aluno_id, sprint_id, status_tarefa)
            VALUES 
                    (?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param(
            "ssssss",
            $dados['titulo'],
            $dados['descricao'],
            $dados['data_de_vencimento'],
            $dados['aluno_id'],
            $dados['sprint_id'],
            $dados['status_tarefa']
        );

        if (!$stmt->execute()) {
            die("Erro ao criar tarefa: " . $stmt->error);
        }

        $stmt->close();
    }

    public function deletar($id)
    {
        $sql = "
            UPDATE 
                {$this->tabela}
            SET 
                status_tarefa = 'desativada'
            WHERE 
                id = ?
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
    }

    public function atualizar($dados)
    {
        $query = "
            UPDATE {$this->tabela}
            SET 
                titulo = ?,
                descricao = ?,
                data_de_vencimento = ?,
                aluno_id = ?,
                sprint_id = ?,
                status_tarefa = ?
            WHERE 
                id = ?
        ";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            die('Erro na preparação da query: ' . $this->mysqli->error);
        }

        $stmt->bind_param(
            'ssssssi',
            $dados['titulo'],
            $dados['descricao'],
            $dados['data_de_vencimento'],
            $dados['aluno_id'],
            $dados['sprint_id'],
            $dados['status_tarefa'],
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
        $query = "
            SELECT 
                *
            FROM 
                {$this->tabela}
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $tarefas = [];
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $tarefas[] = $linha;
        }

        return $tarefas;
    }

    public function buscar($id)
    {
        $tarefa = [];

        $sql = $this->mysqli->query("
            SELECT 
                *
            FROM 
                {$this->tabela}
            WHERE 
                id = '{$id}'
                    AND
                status_tarefa = 'ativa'
        ");

        if ($sql->num_rows === 0) {
            return null;
        }

        $tarefa = $sql->fetch_assoc();

        return $tarefa;
    }

    public function listarTarefasPorAluno($alunoId)
    {
        $query = "
            SELECT 
                *
            FROM 
                {$this->tabela}
            WHERE 
                aluno_id = '{$alunoId}'
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $tarefas = [];
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $tarefas[] = $linha;
        }

        return $tarefas;
    }

    public function contarTarefasPorSprint($sprintId)
    {
        $query = "
            SELECT 
                COUNT(*) as total
            FROM 
                {$this->tabela}
            WHERE 
                sprint_id = '{$sprintId}'
                    AND
                status_tarefa = 'ativa'
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return 0;
        }

        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function obterTarefasAtrasadas()
    {
        $dataAtual = date('Y-m-d');
        $query = "
            SELECT 
                *
            FROM 
                {$this->tabela}
            WHERE 
                data_de_vencimento < '{$dataAtual}'
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $tarefasAtrasadas = [];
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $tarefasAtrasadas[] = $linha;
        }

        return $tarefasAtrasadas;
    }

    public function concluirTarefa($tarefaId)
    {
        $query = "
            UPDATE {$this->tabela}
            SET 
                status_tarefa = 'concluida'
            WHERE 
                id = ?
        ";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            die('Erro na preparação da query: ' . $this->mysqli->error);
        }

        $stmt->bind_param('i', $tarefaId);

        if ($stmt->execute()) {
            return true;
        } else {
            die('Erro na execução da query: ' . $stmt->error);
        }
    }

}
