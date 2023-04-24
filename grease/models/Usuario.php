<?php

/**
 * Usuario
 */
class Usuario
{
    private $mysqli;
    private $tabela = "usuarios";

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
     * Método para buscar um usuario por um ID 
     *
     * @param int $ID ID do usuario
     * @return mixed 
     */
    public function buscarPorID($ID)
    {
        $stmt = $this->mysqli->prepare("
            SELECT 
                * 
            FROM 
                " . $this->tabela . " 
            WHERE usuario_id = ?
        ");
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        }

        $usuario = $result->fetch_assoc();
        $stmt->close();

        return $usuario;
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
     * Método para realizar o login do usuario
     *
     * @param  string $email É o email a ser usada no login
     * @param  string $senha É a senha a ser usada no login
     * @return bool|array
     */
    public function login($email, $senha)
    {
        $query = "
            SELECT 
                * 
            FROM 
                " . $this->tabela . " 
            WHERE email = ? LIMIT 0,1
        ";

        $stmt = $this->mysqli->prepare($query);

        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($senha, $row['senha'])) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    /**
     * Método para realizar o cadastro de um Úsuario
     *
     * @param  array $dados Dados a serem cadastrados
     * @return void
     */
    public function cadastrar(array $dados = [])
    {
        $stmt = $this->mysqli->prepare("
            INSERT INTO 
                " . $this->tabela . " 
                (tipo_usuario_id, nome, email, senha, idade, genero, telefone, cpf, foto_perfil) 
            VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "isssiss",
            $dados['tipo_usuario'],
            $dados['username'],
            $dados['email'],
            $dados['password'],
            $dados['age'],
            $dados['genrer'],
            $dados['cell'],
            $dados['cpf'],
            $dados['foto_perfil']
        );

        $stmt->execute();
        $stmt->close();
    }
}
