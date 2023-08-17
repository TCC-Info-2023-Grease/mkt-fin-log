<?php
/**
 * Categoria Material
 */
class CategoriaMaterial
{
    private $mysqli;
    private $tabela = "categoriasmaterial";


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
     * Método para verificar se determinado valor de um campo é único
     *
     * @param int $campo Nome do campo
     * @param int $valor É o valor do campo
     * @return bool|null
     */
    public function unico($campo, $valor)
    {
        $query = "
            SELECT 
                id 
            FROM 
                " . $this->tabela . " 
            WHERE {$campo} = ?
        ";
        $params = [$valor];

        $stmt = $this->mysqli->prepare($query);

        if (!$stmt) {
            error_log("Erro ao preparar a consulta: " . $this->mysqli->error);
            return false;
        }

        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();

        return !$stmt->fetch();
    }


    /**
     * Método para buscar um usuario por um ID 
     *
     * @param int $ID ID do usuario
     * @return mixed 
     */
    public function buscar($id)
    {
        $stmt = $this->mysqli->prepare("
            SELECT 
                * 
            FROM 
                " . $this->tabela . " 
            WHERE categoria_id = ?
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        }

        $usuario = $result->fetch_assoc();
        $stmt->close();

        return $usuario;
    }

    public function buscarTodos()
    {
        $stmt = $this->mysqli->query("
            SELECT 
                * 
            FROM 
                " . $this->tabela ."
            ORDER BY nome ASC"    
        );

        if ($stmt->num_rows === 0) {
            return null;
        }

        while ($linha = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
            $categoria[] = $linha;
        }

        return $categoria;
    }

    /**
     * Método para realizar o cadastro de um Úsuario
     *
     * @param  array $dados Dados a serem cadastrados
     * @return void
     */
    public function cadastrar($dados = [])
    {
        $stmt = $this->mysqli->prepare("
            INSERT INTO 
                " . $this->tabela . " 
                (nome) 
            VALUES 
                (?)
        ");

        $stmt->bind_param("s", $dados['nome']);

        // Verificar se o nome já existe na tabela
        $verificarStmt = $this->mysqli->prepare("
            SELECT 
                nome 
            FROM 
                " . $this->tabela . " 
            WHERE 
                nome = ?
        ");

        $verificarStmt->bind_param("s", $dados['nome']);
        $verificarStmt->execute();
        $verificarStmt->store_result();

        if ($verificarStmt->num_rows > 0) {
            // Se o nome já existe na tabela, exibir uma mensagem de erro ou redirecionar o usuário para uma página de erro
            echo "O nome já existe na tabela.";
        } else {
            // Se o nome não existe na tabela, inserir o novo registro
            $stmt->execute();
            $stmt->close();
        }
        
        $verificarStmt->close();
    }

    public function atualizar($dados = [])
    {
        $stmt = $this->mysqli->prepare("
            UPDATE 
                " . $this->tabela . " 
            SET 
                nome = ?
            WHERE 
                categoria_id = ?
        ");

        $stmt->bind_param("si", $dados['nome'], $dados['categoria_id']);

        // Verificar se o nome já existe na tabela (excluding the current record being updated)
        $verificarStmt = $this->mysqli->prepare("
            SELECT 
                nome 
            FROM 
                " . $this->tabela . " 
            WHERE 
                nome = ? AND categoria_id != ?
        ");

        $verificarStmt->bind_param("si", $dados['nome'], $dados['categoria_id']);
        $verificarStmt->execute();
        $verificarStmt->store_result();

        if ($verificarStmt->num_rows > 0) {
            // If the name already exists in the table (excluding the current record), display an error message or redirect the user to an error page
            echo "O nome já existe na tabela.";
        } else {
            // If the name is not already in the table, update the record
            $stmt->execute();
            $stmt->close();
        }
        
        $verificarStmt->close();
    }

    public function deletar($id)
    {
        $stmt = $this->mysqli->prepare("
            DELETE FROM 
                " . $this->tabela . " 
            WHERE 
                categoria_id = ?
        ");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

}
