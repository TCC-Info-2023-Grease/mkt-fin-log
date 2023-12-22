<?php
# ------ Dados Iniciais
global $mysqli;

import_utils([ 'navegate' ]);

Auth::check('adm');

# ----- 
$tasks;
$tarefasPorAluno;
$tarefasAtrasadas;
$tarefasPorSprint;

try {
  $task   = new Task($mysqli);
  $sprint = new Sprint($mysqli);

  $tasks            = $task->buscarTodos();
  $tarefasPorAluno  = $task->listarTarefasPorAluno();
  $tarefasPorSprint = $task->contarTarefasPorSprint();
  $tarefasAtrasadas = $task->obterTarefasAtrasadas();
} catch (Exception $e) {
    //ChamaSamu::debug($e);

    $_SESSION['fed_task'] = [ 
      'title' => 'Erro!', 
      'msg' => 'Erro inesperado',
      'icon' => 'error'
    ];

}

$data = [ 
  'tasks'            => $tasks,
  'tarefasPorAluno'  => $tarefasPorAluno,
  'tarefasAtrasadas' => $tarefasAtrasadas,
  'tarefasPorSprint' => $tarefasPorSprint,
];

return $data;
