<?php

class ChamaSamu {

    // Método privado para adicionar estilos CSS à saída de depuração
    private static function addDebugStyles() {
        echo "<style>";
        echo "pre { background-color: #f5f5f5; padding: 10px; border: 1px solid #ccc; }";
        echo "table { border-collapse: collapse; }";
        echo "table, th, td { border: 1px solid #aaa; padding: 5px; }";
        echo "ul { list-style-type: disc; padding-left: 20px; }";
        echo "</style>";
    }


     // Exibe saída de depuração em uma janela flutuante
    public static function debugPanel($data) {
        self::addDebugStyles();
        echo '<div class="chamasamu-debug-panel">';
        echo '<h3>Debug Panel</h3>';
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        echo '</div>';
    }

    // Exibe saída de depuração com formatação
    public static function debug($data) {
        self::addDebugStyles();
        echo "<pre><code>";
        var_dump($data);
        echo "</code></pre>";
    }

    // Exibe saída de depuração JSON com formatação
    public static function debugJSON($data) {
        self::addDebugStyles();
        echo "<pre>";
        echo json_encode($data, JSON_PRETTY_PRINT);
        echo "</pre>";
    }

    // Exibe saída de depuração da sessão
    public static function session() {
        self::debug($_SESSION);
    }

    // Exibe saída de depuração do array GET
    public static function get() {
        self::debug($_GET);
    }

    // Exibe saída de depuração do array POST
    public static function post() {
        self::debug($_POST);
    }

    // Exibe saída de depuração de código com formatação
    public static function code($code) {
        self::addDebugStyles();
        echo "<pre>";
        highlight_string($code);
        echo "</pre>";
    }

        // Exibe saída de depuração de um objeto em formato legível
    public static function debugObject($object) {
        self::addDebugStyles();
        echo "<pre><code>";
        print_r($object);
        echo "</code></pre>";
    }

    // Exibe saída de depuração de uma consulta SQL
    public static function debugSQL($sql) {
        self::addDebugStyles();
        echo "<pre>";
        echo "SQL Query: " . $sql;
        echo "</pre>";
    }

    // Exibe saída de depuração de mensagens personalizadas
    public static function debugMessage($message) {
        self::addDebugStyles();
        echo "<pre>";
        echo "Message: " . $message;
        echo "</pre>";
    }

    // Exibe saída de depuração de um array associativo com chave e valor
    public static function debugAssociativeArray($array) {
        self::addDebugStyles();
        echo "<pre>";
        foreach ($array as $key => $value) {
            echo "$key: $value<br>";
        }
        echo "</pre>";
    }

    // Exibe saída de depuração de uma variável booleana
    public static function debugBoolean($bool) {
        self::addDebugStyles();
        echo "<pre>";
        echo "Boolean: " . ($bool ? 'true' : 'false');
        echo "</pre>";
    }

    // Exibe saída de depuração de uma variável em formato XML
    public static function debugXML($data) {
        self::addDebugStyles();
        echo "<pre>";
        $doc = new DOMDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($data);
        echo htmlentities($doc->saveXML());
        echo "</pre>";
    }

    // Exibe saída de depuração de uma variável em formato de tabela HTML
    public static function debugTable($data) {
        self::addDebugStyles();
        echo "<table border='1' cellspacing='0'>";
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlentities($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    // Exibe saída de depuração de uma variável em formato de lista HTML
    public static function debugList($data) {
        self::addDebugStyles();
        echo "<ul>";
        foreach ($data as $item) {
            echo "<li>" . htmlentities($item) . "</li>";
        }
        echo "</ul>";
    }
}
