<?php

class ChamaSamu {

    public static function debug($data) {
        echo "<pre><code>";
        var_dump($data);
        echo "</code></pre>";
    }

    public static function debugJSON($data) {
        echo "<pre>";
        echo json_encode($data, JSON_PRETTY_PRINT);
        echo "</pre>";
    }

    public static function session() {
        self::debug($_SESSION);
    }

    public static function get() {
        self::debug($_GET);
    }

    public static function post() {
        self::debug($_POST);
    }

    public static function code($code) {
        echo "<pre>";
        highlight_string($code);
        echo "</pre>";
    }
}
