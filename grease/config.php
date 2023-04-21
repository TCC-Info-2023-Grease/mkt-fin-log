<?php

session_start();

$_ENV = [
  # CAMINHOS DE PASTAS 
  "PASTA_RAIZ"  => __DIR__,
  "PASTA_VIEWS" => __DIR__ . '/resources/views',
  "PASTA_CONTROLLER" => __DIR__ . '/controllers',
  "PASTA_UTILS" => __DIR__ . '/utils',
  

  # URLs
  "URL_BASE" => "http://localhost:8080/mkt-fin-log/grease",
  "URL_ROUTE" => "http://localhost:8080/mkt-fin-log/grease/index.php?pagina=",
  "URL_VIEWS" => 'http://localhost:8080/mkt-fin-log/grease/resources/views',
  "URL_CONTROLLER" => 'http://localhost:8080/mkt-fin-log/grease/controller',
  
  
  # BANCO DE DADOS
  "DB_SERVIDOR" => "localhost",
  "DB_USUARIO"  => "root",
  "DB_SENHA"    => "",
  "DB_NOME"     => "db_tcc"
];


// definir uma função para carregar as classes
function autocarregamento($class_name) {
    $path = __DIR__ . '/database/entidades/' . $class_name . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
}
spl_autoload_register('autocarregamento');


// importar os utilitarios
function import_utils($utils) {
  foreach ($utils as $key => $util) {
    require $_ENV['PASTA_UTILS'] . '/' . $util . '.php';
  }
}

// importar o arquivo de configurações do banco de dados
require __DIR__ . '/database/db.php'; 

import_utils([ 'assets' ]);