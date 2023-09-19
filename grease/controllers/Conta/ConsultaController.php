<?php
# ------ Dados Iniciais
global $mysqli;

import_utils([ 'navegate' ]);

Auth::check('adm');

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();


# ----- Cadastro Sala
$conta = new Conta($mysqli);

try {
    $contas = $conta->buscarTodos();
} catch (Exception $e) {
    //ChamaSamu::debug($e);

    $_SESSION['fed_conta'] = [ 
        'title' => 'Erro!', 'msg' => 'Erro inesperado' 
    ];

}

return $contas;
