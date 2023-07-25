<?php 
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);

if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
} else {
  $ultimo_acesso = null;
}

$_SESSION['ultimo_acesso'] = time();


# ------ Validar Envio de Dados
$campos_validos = (
    $_POST['id'] ? true : false
);
if (!$campos_validos) 
{
  $_SESSION['fed_categoria_material'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos',
    'icon' => 'error'
  ];
  navegate($_ENV['ROUTE'] . 'admin.categoria_material.index');
} 


# ----- Atualizar 
$categoria = new CategoriaMaterial($mysqli);

$dados = [
  'categoria_id' => $_POST['id'],
	'nome' => $_POST['nome']
];

// print_r($dados);
try {
  $categoria->atualizar($dados);
} catch (Exception $e) {
  $_SESSION['fed_categoria_material'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos',
    'icon' => 'error'
  ];
}

$_SESSION['fed_categoria_material'] = [ 
    'title' => 'OK!', 'msg' => 'Atualizado com sucesso',
    'icon' => 'success'
  ];

navegate($_ENV['ROUTE'] . 'admin.categoria_material.index');

?>