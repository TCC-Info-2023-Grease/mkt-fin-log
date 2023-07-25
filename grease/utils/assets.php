<?php

/**
 * Função responsavel para buscar arquivos  
 *
 * @param  string  $asset Pasta do arquivo de procura 
 * @param  string  $file  Nome do arquivo de procura
 * @return string
 */
function assets( $asset, $file ) {
    $path = $_ENV['URL_BASE']. '/resources/'. $asset . $file;
   
    return $path;
}