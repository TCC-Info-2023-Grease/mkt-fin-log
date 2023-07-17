<?php
#------- Variaveis de Ambiente
$url_base = "http://localhost/grease";

$_ENV = [
  # CAMINHOS DE PASTAS 
  "PASTA_RAIZ"        => __DIR__,
  "PASTA_VIEWS"       => __DIR__ . '/resources/views',
  "PASTA_CONTROLLER"  => __DIR__ . '/controllers',
  "PASTA_UTILS"       => __DIR__ . '/utils',
  
  # URLs
  "URL_BASE"        => $url_base,
  "ROUTE"           => $url_base . "/index.php?pagina=",
  "VIEWS"           => $url_base . '/resources/views',
  "URL_CONTROLLERS" => $url_base . '/controllers',
  "STORAGE"         => $url_base . '/storage',
  "RESOURCES"       => $url_base . '/resources',

  # BANCO DE DADOS
  "DB_SERVIDOR" => "localhost",
  "DB_USUARIO"  => "root",
  "DB_SENHA"    => "",
  "DB_NOME"     => "db_tcc",

  # LISTA DE JS SCRIPTS
  "LIST_SCRIPTS" => [
    "jquery"                => $url_base . "/resources/js/lib/jquery.js",
    "inputmask"             => "https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"
  ]
];
?>