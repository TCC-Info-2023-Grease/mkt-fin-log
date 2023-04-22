<?php 

/**
 * Função responsavel por navegar entre as páginas do app
 *
 * @param  string  $url URL da página
 * @return void
 */
function navegate($url) {
    header('Location: ' . $url);
    exit();
}