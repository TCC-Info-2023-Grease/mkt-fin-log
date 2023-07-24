<?php

/**
 * Classe Material
 * 
 * Essa classe representa o registro de Material no sistema e gerencia suas operações.
 */
class Material
{
    private $mysqli;
    private $tabela = "materiais";

    /**
     * Método construtor da classe
     *
     * @param  mysqli $mysqli É a conexão com o banco de dados
     * @return void
     */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * Busca todos os registros de Materiais cadastrados no sistema
     * 
     * @return array|null Array contendo todos os registros de Materiais ou null em caso de erro
     */
    public function buscarTodos()
    {
        $stmt = $this->mysqli->query("
            SELECT 
                m.*, m.nome AS nome_material,
                c.nome AS nome_categoria, 
                u.nome AS nome_usuario, u.*
            FROM 
                {$this->tabela} AS m
            JOIN 
                categoriasmaterial AS c ON m.categoria_id = c.categoria_id
            JOIN 
                usuarios AS u ON m.usuario_id = u.usuario_id
            ORDER BY 
                m.nome ASC
        ");

        if ($stmt->num_rows === 0) {
            return null;
        }

        $materiais = array();
        while ($linha = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
            $materiais[] = $linha;
        }

        return $materiais;
    }

    /**
     * Busca um registro de Material pelo ID
     * 
     * @param int $id ID do registro a ser buscado
     * @return array|null Array contendo os dados do registro ou null se não encontrado
     */
    public function buscar($id)
    {
        $sql = $this->mysqli->query("
            SELECT 
                m.*, 
                c.nome AS nome_categoria, 
                u.nome AS nome_usuario, u.*
            FROM 
                {$this->tabela} AS m
            JOIN 
                categoriasmaterial AS c ON m.categoria_id = c.categoria_id
            JOIN 
                usuarios AS u ON m.usuario_id = u.usuario_id
            WHERE 
                material_id = '{$id}'
        ");

        if ($sql->num_rows === 0) {
            return null;
        }

        $row = $sql->fetch_assoc();

        return $row;
    }

    /**
     * Cadastra um novo registro de Material no sistema
     * 
     * @param array $dados Dados do registro a ser cadastrado
     * @return void
     */
    public function cadastrar($dados = [])
    {
        $query = "
            INSERT INTO {$this->tabela} (
                usuario_id,
                nome, 
                categoria_id,
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
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param(
            "isissdddssdsss",
            $dados['usuario_id'],
            $dados['nome'],
            $dados['categoria_id'],
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

    /**
     * Atualiza os dados de um registro de Material
     * 
     * @param array $dados Dados a serem atualizados
     * @return void
     */
    public function atualizar($dados = [])
    {
        $query = "
            UPDATE {$this->tabela}
            SET 
                nome = '{$dados['nome']}', 
                categoria_id      = '{$dados['categoria_id']}',
                descricao         = '{$dados['descricao']}', 
                qtde_estimada     = '{$dados['qtde_estimada']}', 
                valor_estimado    = '{$dados['valor_estimado']}',
                valor_gasto       = '{$dados['valor_gasto']}',
                unidade_medida    = '{$dados['unidade_medida']}',
                estoque_minimo    = '{$dados['estoque_minimo']}',
                estoque_atual     = '{$dados['estoque_atual']}',
                valor_unitario    = '{$dados['valor_unitario']}',
                datahora_cadastro = '{$dados['datahora_cadastro']}', 
                data_validade     = '{$dados['data_validade']}',
                foto_material     = '{$dados['foto_material']}',
                status_material   = '{$dados['status_material']}'
            WHERE 
                material_id = '{$dados['id']}'    
        ";

        $result = $this->mysqli->query($query);

        if ($result === false) {
            die("Erro ao executar a consulta: " . $this->mysqli->error);
        }
    }

    /**
     * Deleta um registro de Material pelo ID
     * 
     * @param int $id ID do registro a ser deletado
     * @return bool True se a exclusão foi bem sucedida, False caso contrário
     */
    public function deletar($id)
    {
        $sql = "
            DELETE FROM {$this->tabela}  
            WHERE material_id = ?
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

        $stmt->close();
    }

    /**
     * Atualiza o estoque do Material ao registrar uma entrada
     * 
     * @param array $dados Dados da entrada para atualização do estoque
     * @return void
     */
    public function setarEntradaEstoque($dados = [])
    {
        $query = "
            UPDATE {$this->tabela}
            SET 
                estoque_atual = estoque_atual + {$dados['qtde_compra']}
            WHERE material_id = {$dados['material_id']}
        ";

        $result = $this->mysqli->query($query);

        if ($result === false) {
            die("Erro ao executar a consulta: " . $this->mysqli->error);
        }
    }

    /**
     * Atualiza o estoque do Material ao registrar uma saída
     * 
     * @param array $dados Dados da saída para atualização do estoque
     * @return void
     */
    public function setarSaidaEstoque($dados = [])
    {
        $query = "
            UPDATE {$this->tabela}
            SET 
                estoque_atual = estoque_atual - {$dados['qtde_compra']}
            WHERE material_id = {$dados['material_id']}
        ";

        $result = $this->mysqli->query($query);

        if ($result === false) {
            die("Erro ao executar a consulta: " . $this->mysqli->error);
        }
    }
}
