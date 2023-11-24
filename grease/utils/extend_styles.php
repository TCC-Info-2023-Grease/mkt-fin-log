<?php 

/**
 * Extende os estilos CSS de uma View 
 *
 * @param  array  $styles Nome dos arquivos CSS
 * @return void
 */
function extend_styles($styles = []) {
    global $_ENV;

    foreach ($styles as $style) {
        $file_css = $_ENV['URL_BASE'] . '/resources/' . str_replace('.', '/', $style);
        echo 
        
            '<link rel="stylesheet" href="'.$file_css.'.css" />';
    }
}

