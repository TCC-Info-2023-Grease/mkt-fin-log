<?php

class Sala {

    private $mysqli;
    private $id;
    private $tabela = 'caixa';
    private $tabela_secundaria = 'alunos';
  
    public function getID() {
      return $this->id;
    }

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


    public function obterTodosAlunos() {
        $query = "SELECT * FROM ". $this->tabela_secundaria;

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $listaDosAlunos = [];
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $listaDosAlunos[] = $linha;
        }

        return $listaDosAlunos;
    }

     /**
     * Obtém as receitas que possuem o campo aluno_id preenchido.
     *
     * @return array|null Array contendo as informações das receitas com aluno_id preenchido ou null se não houver.
     */
    public function obterReceitasComAluno()
    {
        $query = "
            SELECT 
                c.*, u.*, u.nome as nome_usuario, a.nome as nome_aluno
            FROM 
                " . $this->tabela . " as c
            JOIN 
                usuarios AS u ON u.usuario_id = c.usuario_id
            LEFT JOIN 
                alunos AS a ON a.aluno_id = c.aluno_id
            WHERE 
                LOWER(c.tipo_movimentacao) = 'receita' AND
                c.aluno_id IS NOT NULL
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $receitasComAluno = array();
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $receitasComAluno[] = $linha;
        }

        return $receitasComAluno;
    }

    public function buscar($id)
    {
        $sql = $this->mysqli->query("
            SELECT 
                c.*, u.*, u.nome as nome_usuario, a.nome as nome_aluno
            FROM 
                " . $this->tabela . " as c
            JOIN 
                usuarios AS u ON u.usuario_id = c.usuario_id
            LEFT JOIN 
                alunos AS a ON a.aluno_id = c.aluno_id
            WHERE 
                caixa_id = '" . $id ."'
        ");

        if ($sql->num_rows === 0) {
            return null;
        }

        $row = $sql->fetch_assoc();
        return $row;
    }

    public function deletar($id)
    {
        $sql = "
            DELETE FROM 
                " . $this->tabela . "  
            WHERE caixa_id = ?
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
            UPDATE 
                " . $this->tabela . "
            SET 
                usuario_id = ?, 
                aluno_id = ?, 
                categoria = ?, 
                descricao = ?, 
                data_movimentacao = ?, 
                valor = ?, 
                tipo_movimentacao = ?, 
                forma_pagamento = ?, 
                obs = ?
            WHERE 
                caixa_id = ?
        ";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            die('Erro na preparação da query: ' . $this->mysqli->error);
        }

        $stmt->bind_param(
            'iisssdsssi',
            $dados['usuario_id'],
            $dados['aluno_id'],
            $dados['categoria'],
            $dados['descricao'],
            $dados['data_movimentacao'],
            $dados['valor'],
            $dados['tipo_movimentacao'],
            $dados['forma_pagamento'],
            $dados['obs'],
            $dados['id']
        );

        if ($stmt->execute()) {
            return true;
        } else {
            die('Erro na execução da query: ' . $stmt->error);
        }
    }

    


}
