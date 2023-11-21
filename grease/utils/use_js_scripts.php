<?php

/**
 * Responsável por adicionar os arquivos JavaScript
 *
 * @param array $scripts
 * @param array $list_scripts
 * @param string $type
 * @return void
 */          
function use_js_scripts($scripts = [], $extension = 'js') {
  global $_ENV;

  foreach ($scripts as $script) {
    $src = str_replace('.', '/', $script);
    
    // Verifica se a chave 'type' existe no array $script
    $type = isset($script['type']) ? $script['type'] : 'text/javascript';

    $filename = $_ENV['RESOURCES'] . '/' . $src;
    $src_with_extension = $filename . '.' . $extension;

    echo 
    <<<HTML
      <!-- {$script} -->
      <script type="$type" src="$src_with_extension"></script>
      <!-- /{$script} -->
    HTML;
  }
}