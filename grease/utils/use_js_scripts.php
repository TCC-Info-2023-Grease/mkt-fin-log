<?php

/**
 * Responsável por adicionar os arquivos JavaScript
 *
 * @param array $scripts
 * @param array $list_scripts
 * @param string $type
 * @return void
 */          
function use_js_scripts($scripts = [], $list_scripts = [], $type = 'text/javascript') {
  for ($s = 0; $s < count($scripts); $s++) {
    echo '
      <!-- '. $scripts[$s] .'-->
      <script
        type="'. $type .'"
        src="'. $list_scripts[$scripts[$s]]  .'">
      </script>
      <!-- /'.  $scripts[$s] .' -->
    ';
  }
}