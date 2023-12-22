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

    
    public function agruparPagamentosPorMes()
    {
        $query = "
            SELECT 
                YEAR(data_movimentacao) as ano,
                MONTH(data_movimentacao) as mes,
                SUM(valor) as total
            FROM 
                " . $this->tabela . "
            WHERE 
                LOWER(tipo_movimentacao) = 'receita' AND
                aluno_id IS NOT NULL
            GROUP BY 
                YEAR(data_movimentacao), MONTH(data_movimentacao)
            ORDER BY 
                YEAR(data_movimentacao) DESC, MONTH(data_movimentacao) DESC
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $pagamentosPorMes = array();
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $pagamentosPorMes[] = $linha;
        }

        return $pagamentosPorMes;
    }


    public function calcularTotalAlunosPagantes()
    {
        $query = "
            SELECT 
                COUNT(DISTINCT aluno_id) as total
            FROM 
                " . $this->tabela . "
            WHERE 
                LOWER(tipo_movimentacao) = 'receita' AND
                aluno_id IS NOT NULL
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return 0;
        }

        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function calcularTotalPagamentos()
    {
        $query = "
            SELECT 
                SUM(valor) as total
            FROM 
                " . $this->tabela . "
            WHERE 
                LOWER(tipo_movimentacao) = 'receita' AND
                aluno_id IS NOT NULL
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return 0;
        }

        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function calcularRankingTopPagantes($limit = 5)
    {
        $query = "
            SELECT 
                a.nome as nome_aluno,
                SUM(c.valor) as total_pago
            FROM 
                " . $this->tabela . " as c
            JOIN 
                alunos AS a ON a.aluno_id = c.aluno_id
            WHERE 
                LOWER(c.tipo_movimentacao) = 'receita' AND
                c.aluno_id IS NOT NULL
            GROUP BY 
                c.aluno_id
            ORDER BY 
                total_pago DESC
            LIMIT " . $limit;
            
        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $ranking = array();
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $ranking[] = $linha;
        }

        return $ranking;
    }

    public function calcularDevedores()
    {
        $query = "
            SELECT 
                a.nome as nome_aluno,
                c.valor as valor_devido
            FROM 
                " . $this->tabela . " as c
            JOIN 
                alunos AS a ON a.aluno_id = c.aluno_id
            WHERE 
                LOWER(c.tipo_movimentacao) = 'receita' AND
                c.aluno_id IS NOT NULL AND
                c.valor > 0
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return null;
        }

        $devedores = array();
        while ($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $devedores[] = $linha;
        }

        return $devedores;
    }

    public function obterAlunosDevedores()
    {
        // -- Total Alunos Pagantes
        $query = "
        SELECT
            COUNT(*) as totalPagantes
        FROM
            alunos as a,
            caixa  as c
        WHERE
            LOWER(c.tipo_movimentacao) = 'receita' AND
            Year(c.data_movimentacao) =  YEAR(NOW()) AND
            MONTH(c.data_movimentacao) =  month(NOW()) AND
            c.aluno_id = a.aluno_id;
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return [ 'totalPagantes' => 0 ];
        }
        $alunosPagantes = $result->fetch_assoc();



        // -- Total Alunos 
        $query = "
            SELECT
                COUNT(*) as totalAlunos
            FROM
                alunos 
        ";

        $result = $this->mysqli->query($query);

        if ($result->num_rows === 0) {
            return [];
        }
        $alunos = $result->fetch_assoc();

        // -- Alunos Pagantes
        $alunosDevedores = $alunos['totalAlunos'] - $alunosPagantes['totalPagantes'];


        return $alunosDevedores;
    }

    public function porcentagemDevedoresPagantes()
    {
        $alunosDevedores = $this->obterAlunosDevedores();
        $totalAlunos = $this->obterTodosAlunos();

        if (!$totalAlunos) {
            return ['porcentagem_devedores' => 0, 'porcentagem_pagantes' => 0];
        }

        $totalDevedores = $alunosDevedores;
        $totalPagantes = count($totalAlunos) - $totalDevedores;

        $porcentagemDevedores = ($totalDevedores / count($totalAlunos)) * 100;
        $porcentagemPagantes = ($totalPagantes / count($totalAlunos)) * 100;

        return [
            'porcentagem_devedores' => $porcentagemDevedores,
            'porcentagem_pagantes' => $porcentagemPagantes
        ];
    }

}