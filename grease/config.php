<?php

session_start();

$_VARIAVEIS = [
  # CAMINHOS DE PASTAS 
  "PASTA_RAIZ"  => __DIR__,
  "PASTA_VIEWS" => __DIR__ . '/resources/views',
  
  # URLs
  "URL_VIEWS" => 'http://localhost/resources/views',
  
  
  # BANCO DE DADOS
  "DB_SERVIDOR" => "192.168.0.105",
  "DB_USUARIO"  => "root",
  "DB_SENHA"    => "root",
  "DB_NOME"     => "db_tcc"
];