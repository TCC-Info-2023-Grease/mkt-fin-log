<<<<<<< HEAD
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
=======
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
>>>>>>> 286a4901e05e7d84006a15f932d5b2227f5e0c7a
