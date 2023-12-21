<?php
# ------ Dados Iniciais
global $mysqli;

import_utils([ 'navegate' ]);

Auth::check('adm');

# ----- Cadastro Sala
$fornecedor = new Fornecedor($mysqli);

try {
    $fornecedores = $fornecedor->buscarTodos();
} catch (Exception $e) {
    ChamaSamu::debug($e);

    $_SESSION['fed_aluno'] = [ 
    'title' => 'Erro!', 'msg' => 'Erro inesperado' 
    ];

}

return $fornecedores;
