<?php
# ------ Dados Iniciais
global $mysqli;

import_utils([ 'navegate' ]);

Auth::check('adm');

# ----- 
$sprints;
$sprintsAtivas;
$sprintsNaoAtivas;

try {
  $sprint = new Sprint($mysqli);
  $task = new Task($mysqli);

  $sprints           = $sprint->listarSprints();
  $sprintsAtivas     = $sprint->listarSprintsAtivas();
  $sprintsNaoAtivas  = $sprint->listarSprintsInativas();
} catch (Exception $e) {
    //ChamaSamu::debug($e);

    $_SESSION['fed_sprint'] = [ 
      'title' => 'Erro!', 
      'msg' => 'Erro inesperado',
      'icon' => 'error'
    ];

}

$data = [ 
  'sprints'          => $sprints,
  'sprintsAtivas'    => $sprintsAtivas,
  'sprintsNaoAtivas' => $sprintsNaoAtivas
];

return $data;