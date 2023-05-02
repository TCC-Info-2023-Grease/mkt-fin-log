<?php

/**
 * Função responsavel para buscar arquivos  
 *
 * @param  string  $asset Pasta do arquivo de procura 
 * @param  string  $file  Nome do arquivo de procura
 * @return string
 */
function assets( $asset, $file ) {
    $path = 'http://localhost:8080/mkt-fin-log/grease/resources/'. $asset . $file;
    
    return $path;
}