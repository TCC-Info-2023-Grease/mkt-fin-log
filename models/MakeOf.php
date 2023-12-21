<?php

/**
 * Classe MakeOf
 * 
 * Essa classe representa o registro de MakeOf no sistema e gerencia suas operações.
 */
class MakeOf
{
    private $mysqli;
    private $tabela = "makeof";

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
     * Busca todos os registros de MakeOf cadastrados no sistema
     * 
     * @return array|null Array contendo todos os registros de MakeOf ou null em caso de erro
     */
    public function buscarTodos()
    {
        $stmt = $this->mysqli->query("
            SELECT * 
            FROM {$this->tabela}
            ORDER BY titulo ASC
        ");

        if ($stmt->num_rows === 0) {
            return null;
        }

        $resultado = array();
        while ($linha = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
            $resultado[] = $linha;
        }

        return $resultado;
    }

    /**
     * Cadastra um novo registro de MakeOf no sistema
     * 
     * @param array $dados Dados do registro a ser cadastrado
     * @return void
     */
    public function cadastrar($dados = [])
    {
        $stmt = $this->mysqli->prepare("
            INSERT INTO {$this->tabela} (
                user_id,
                titulo,
                descricao,
                uri
            ) 
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "isss", 
            $dados['user_id'],
            $dados['titulo'],
            $dados['descricao'],
            $dados['uri']        
        );  
        
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Busca um registro de MakeOf pelo ID
     * 
     * @param int $id ID do registro a ser buscado
     * @return array|null Array contendo os dados do registro ou null se não encontrado
     */
    public function buscar($id)
    {
        $sql = $this->mysqli->query("
            SELECT 
                m.*
            FROM 
                {$this->tabela} AS m
            WHERE 
                makeof_id = '{$id}'
        ");

        if ($sql->num_rows === 0) {
            return null;
        }

        $row = $sql->fetch_assoc();

        return $row;
    }

    /**
     * Atualiza os dados de um registro de MakeOf
     * 
     * @param array $dados Dados a serem atualizados
     * @return void
     */
    public function atualizar($dados = [])
    {
        $query = "
            UPDATE {$this->tabela}
            SET  
                titulo    = '{$dados['titulo']}', 
                descricao = '{$dados['descricao']}',
                uri       = '{$dados['uri']}'
            WHERE 
                makeof_id = '{$dados['id']}'      
        ";

        $result = $this->mysqli->query($query);

        if ($result === false) {
            die("Erro ao executar a consulta: " . $this->mysqli->error);
        }
    }

    /**
     * Deleta um registro de MakeOf pelo ID
     * 
     * @param int $id ID do registro a ser deletado
     * @return bool True se a exclusão foi bem sucedida, False caso contrário
     */
    public function deletar($id)
    {
        $sql = "
            DELETE FROM {$this->tabela}
            WHERE makeof_id = ? 
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
}
