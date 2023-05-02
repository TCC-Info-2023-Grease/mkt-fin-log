<?php

class Model {
    private $mysqli;
    private $tabela;

    public function bind_params($params) {
        $types = '';
        $values = [];

        foreach ($params as $value) {
            switch (gettype($value)) {
                case 'integer':
                    $types .= 'i';
                    break;
                case 'double':
                    $types .= 'd';
                    break;
                case 'string':
                    $types .= 's';
                    break;
                default:
                    $types .= 'b';
                    break;
            }

            $values[] = $value;
        }

        return [$types, $values];
    }

}
