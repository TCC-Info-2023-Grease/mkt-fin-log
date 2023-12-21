<?php
# ------ Dados Iniciais
global $mysqli;
import_utils([ 'navegate' ]);


# ----- Cadastro Sala
$sala = new Sala($mysqli);

try {
    $alunos = $sala->obterTodosAlunos();
} catch (Exception $e) {
    //throw $e;

    $_SESSION['fed_material'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
    ];

    navegate($_ENV['ROUTE'] . 'admin.material.create');
}

return $data = [
    'alunos' => $alunos
];
