<?php
# ------ Dados Iniciais
global $mysqli;
import_utils([ 'navegate' ]);


# ----- Cadastro Sala
$alunos = new Sala($mysqli);

try {
    $alunos = $alunos->obterTodosAlunos();
} catch (Exception $e) {
    //throw $e;

    $_SESSION['fed_aluno'] = [ 
    'title' => 'Erro!', 'msg' => 'Erro inesperado' 
    ];

    navegate($_ENV['ROUTE'] . 'admin.alunos.create');
}

return $alunos;
