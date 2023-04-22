<?php

function use_js_scripts($scripts = [], $list_scripts = []) {


  for ($s = 0; $s < count($scripts); $s++) {
    echo '
      <!-- '. $scripts[$s] .'-->
      <script
        src="'. $list_scripts[$scripts[$s]]  .'">
      </script>
      <!-- /'.  $scripts[$s] .' -->
    ';
  }
}