<?php
#------- Variaveis de Ambiente
$_ENV = [
  # CAMINHOS DE PASTAS 
  "PASTA_RAIZ"        => __DIR__,
  "PASTA_VIEWS"       => __DIR__ . '/resources/views',
  "PASTA_CONTROLLER"  => __DIR__ . '/controllers',
  "PASTA_UTILS"       => __DIR__ . '/utils',
  
  # URLs
  "URL_BASE"       => "http://localhost:8080/mkt-fin-log/grease",
  "URL_ROUTE"      => "http://localhost:8080/mkt-fin-log/grease/index.php?pagina=",
  "URL_VIEWS"      => 'http://localhost:8080/mkt-fin-log/grease/resources/views',
  "URL_CONTROLLERS" => 'http://localhost:8080/mkt-fin-log/grease/controllers',

  # BANCO DE DADOS
  "DB_SERVIDOR" => "localhost",
  "DB_USUARIO"  => "root",
  "DB_SENHA"    => "",
  "DB_NOME"     => "db_tcc",

  # LISTA DE JS SCRIPTS
  "LIST_SCRIPTS" => [
    "jquery"  => "http://localhost:8080/mkt-fin-log/grease/resources/js/lib/jquery.js",
    "inputmask"       => "https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js",
    "masksForInputs"  => "http://localhost:8080/mkt-fin-log/grease/resources/js/masksForInputs.js",
    "vw_cadastrar_usuario"  => "http://localhost:8080/mkt-fin-log/grease/resources/js/views/vw_cadastrar_usuario.js"
  ]
];
?>