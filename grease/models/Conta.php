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
                data_validade = ?,
                status_conta = ?
            WHERE 
                conta_id = ?
        ";
        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            die('Erro na preparação da query: ' . $this->mysqli->error);
        }

        $stmt->bind_param(
            "iissdsii",
            $dados['fornecedor_id'],
            $dados['usuario_id'],
            $dados['titulo'],
            $dados['descricao'],
            $dados['valor'],
            $dados['data_validade'],
            $dados['status_conta'],
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
                u.email as usuario_email,
                f.email as fornecedor_email,
                u.*, f.*, c.*
            FROM 
                {$this->tabela} as c
            LEFT JOIN 
                fornecedores f ON c.fornecedor_id = f.fornecedor_id
            LEFT JOIN 
                usuarios u ON c.usuario_id = u.usuario_id
            WHERE 
                conta_id = '".$id."'
        ");


        if (!$sql) {
            die("Erro SQL: " . $this->mysqli->error);
        }
        
        if ($sql->num_rows === 0) {
            return null;
        }
        

        $conta = $sql->fetch_assoc();

        return $conta;
    }

    /**
     * Calcula o total de contas a pagar.
     *
     * @return float|null Total de contas a pagar ou null se não houver contas.
     */
    public function totalContasAPagar()
    {
        $query = "
            SELECT 
                COUNT(valor) as total_contas
            FROM 
                {$this->tabela}
            WHERE 
                status_conta = 0
        ";

        $result = $this->mysqli->query($query);

        if (!$result) {
            die("Erro SQL: " . $this->mysqli->error);
        }

        $row = $result->fetch_assoc();
        return $row['total_contas'] ?? null;
    }

    public function totalContasPagas()
    {
        $query = "
            SELECT 
                COUNT(valor) as total_contas_pagas
            FROM 
                {$this->tabela}
            WHERE 
                status_conta = 1
        ";

        $result = $this->mysqli->query($query);

        if (!$result) {
            die("Erro SQL: " . $this->mysqli->error);
        }

        $row = $result->fetch_assoc();
        return $row['total_contas_pagas'] ?? null;
    }

    /**
     * Calcula o total gasto.
     *
     * @return float|null Total gasto ou null se não houver contas.
     */
    public function totalGasto()
    {
        $query = "
            SELECT 
                SUM(valor) as total_gasto
            FROM 
                {$this->tabela}
        ";

        $result = $this->mysqli->query($query);

        if (!$result) {
            die("Erro SQL: " . $this->mysqli->error);
        }

        $row = $result->fetch_assoc();
        return $row['total_gasto'] ?? null;
    }

    /**
     * Calcula o total necessário para pagar contas não pagas.
     *
     * @return float|null Total necessário ou null se não houver contas a pagar.
     */
    public function totalNecessario()
    {
        $query = "
            SELECT 
                SUM(valor) as total_necessario
            FROM 
                {$this->tabela}
            WHERE 
                status_conta = 0
        ";

        $result = $this->mysqli->query($query);

        if (!$result) {
            die("Erro SQL: " . $this->mysqli->error);
        }

        $row = $result->fetch_assoc();
        return $row['total_necessario'] ?? 0;
    }

    public function obterDadosStatusConta()
    {
        $query = "SELECT status_conta, COUNT(*) as total FROM contas GROUP BY status_conta";
        $result = $this->mysqli->query($query);

        $dados = [];

        while ($row = $result->fetch_assoc()) {
            $dados[$row['status_conta']] = $row['total'];
        }

        return $dados;
    }

    public function  obterValorContasPorFornecedor()
    {
        $query = "
            SELECT 
                f.nome AS nome_fornecedor, c.status_conta, COUNT(*) as total 
            FROM 
                contas c
            LEFT JOIN 
                fornecedores f ON c.fornecedor_id = f.fornecedor_id
            GROUP BY
                 c.status_conta, c.fornecedor_id
    ";

        $result = $this->mysqli->query($query);

        $dados = [];

        while ($row = $result->fetch_assoc()) {
            $dados[$row['status_conta']] = $row['total'];
        }

        return $dados;
    }

    public function obterEvolucaoValorTotal()
    {
        $query = "SELECT DATE(data_insercao) as data, SUM(valor) as total_valor 
                  FROM contas 
                  GROUP BY DATE(data_insercao)";
        $result = $this->mysqli->query($query);

        $dados = [];

        while ($row = $result->fetch_assoc()) {
            $dados[$row['data']] = $row['total_valor'];
        }

        return $dados;
    }
}
 

