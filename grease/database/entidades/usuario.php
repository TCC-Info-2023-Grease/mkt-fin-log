<?php

class UsuarioRepository {
    private $mysqli;
    private $tabela = "usuarios";

    public function __construct(mysqli $mysqli) {
        $this->mysqli = $mysqli;
    }

    public function buscarPorId($id) {
        $stmt = $this->mysqli->prepare("
            SELECT 
                * 
            FROM 
                " . $this->tabela . " 
            WHERE id = ?"
        );
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
    
    public function unico($campo, $valor) {
        $query = "
            SELECT 
                id 
            FROM 
                " . $this->tabela . " 
            WHERE {$campo} = ?
        ";
        $params = [$valor];
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
        $stmt->execute();
        
        return !$stmt->fetch();
    }
    
    public function login($email, $senha) {
        $query = "
            SELECT 
                * 
            FROM 
                " . $this->tabela . " 
            WHERE email = ? LIMIT 0,1
        ";

        $stmt = $this->conexao->prepare($query);

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

    public function cadastrar(array $dados) {
        $stmt = $this->mysqli->prepare("
            INSERT INTO 
                " . $this->tabela . " 
                (nome, email, senha) 
            VALUES 
                (?, ?, ?)");
                
        $stmt->bind_param(
            "sss", 
            $dados['nome'], 
            $dados['email'], 
            $dados['senha']
        );
        
        $stmt->execute();
        $stmt->close();
    }
}