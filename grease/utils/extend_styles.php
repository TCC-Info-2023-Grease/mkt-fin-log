<?php 

/**
 * Extende os estilos CSS de uma View 
 *
 * @param  array  $styles Nome dos arquivos CSS
 * @return void
 */
function extend_styles($styles = []) { 
    foreach ($styles as $key => $value) {
        $file_css = $value . ".css";
        echo "\n<link rel='stylesheet' href='" . assets('css/', $file_css) . "' />";
    }
} 