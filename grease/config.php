<?php

session_start();

$_VARIAVEIS = [
  # CAMINHOS DE PASTAS 
  "PASTA_RAIZ"  => __DIR__,
  "PASTA_VIEWS" => __DIR__ . '/resources/views',
  "PASTA_CONTROLADOR" => __DIR__ . '/controlador',
  
  
  # URLs
  "URL_BASE" => "localhost/mkt-fin-log/grease",
  "URL_VIEWS" => 'localhost/mkt-fin-log/grease/resources/views',
  "URL_VIEWS" => 'http://localhost/controlador',
  
  
  # BANCO DE DADOS
  "DB_SERVIDOR" => "192.168.0.105",
  "DB_USUARIO"  => "root",
  "DB_SENHA"    => "root",
  "DB_NOME"     => "db_tcc"
];


// definir uma função para carregar as classes
function autocarregamento($class_name) {
    $path = __DIR__ . '/database/entidades/' . $class_name . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
}

// registrar a função de carregamento automático
spl_autoload_register('autocarregamento');


