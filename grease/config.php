<?php
#------- Funçoes de config iniciais 
/**
 * Função para carregar classes
 *
 * @param  string  $class_name Nome da classe
 * @return void
 */
function autocarregamento($class_name) {
  $path = __DIR__ . '//models//' . $class_name . '.php';
  if (file_exists($path)) {
    require_once $path;
  }
}
/**
 * Função para importar os utilitarios
 *
 * @param  array $utils Lista de utilitarios a ser carregado
 * @return void
 */
function import_utils($utils) {
  foreach ($utils as $key => $util) {
    require $_ENV['PASTA_UTILS'] . '/' . $util . '.php';
  }
}

#------- Configuraçoes Iniciais
session_start();
require __DIR__ . '/.env.php'; 
require __DIR__ . '/database/db.php'; 
require __DIR__ . '/routes/web.php';

// Carregue o Composer autoloader
require 'vendor/autoload.php';

import_utils([ 'assets', 'ChamaSamu', 'MercuryLog' ]);
spl_autoload_register('autocarregamento');
