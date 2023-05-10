<?php 		
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . '\config.php';

global $mysqli;
import_utils([ 'valida_campo', 'navegate' ]);

echo "NOME: " . $_POST['nome'];


# ------ Validar Envio de Dados
$campos_validos = valida_campo($_POST['nome']);
if (!$campos_validos) 
{
  $_SESSION['fed_categoria_material'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
  ];
  navegate($_ENV['ROUTE'] . 'admin.categoria_material.create');
} 


# ----- Cadastro 
$categoria_material = new CategoriaMaterial($mysqli);
 
$dados = [ 'nome' => $_POST['nome'] ];

$categoria_material->cadastrar($dados);

navegate($_ENV['ROUTE'] . 'admin.categoria_material.index');