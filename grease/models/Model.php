<?php

class Model {
    private $mysqli;
    private $tabela;

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
}