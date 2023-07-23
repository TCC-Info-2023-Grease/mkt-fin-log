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
  $_POST['material_id']     &&
  $_POST['usuario_id']      &&
  $_POST['qtde_compra']     &&
  $_POST['valor_gasto']     &&
  $_POST['forma_pagamento']
);
if (!$campos_validos) 
{
  $_SESSION['fed_material'] = [ 
      'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
  ];
  navegate($_ENV['ROUTE'] . 'admin.material.entrada.create');
} 

# ----- Cadastro Entrada Caixa
$caixa = new Caixa($mysqli);

$dados = [
  'usuario_id'        => $_POST['usuario_id'],
  'material_id'       => $_POST['material_id'],
  'categoria'         => $_POST['categoria'],
  'descricao'         => "Entrada Material",
  'data_movimentacao' => date("Y-m-d H:i:s"),
  'qtde_compra'       => $_POST['qtde_compra'],
  'valor_gasto'       => $_POST['valor_gasto'],
  'valor'             => floatval($_POST['valor_gasto']),
  'tipo_movimentacao' => $_POST['tipo_movimentacao'],
  'forma_pagamento'   => $_POST['forma_pagamento'],
  'obs'               => $_POST['obs']
];
print_r($dados);

$dados['caixa_id'] = $caixa->cadastrarEntrada($dados);

# ----- Cadastro Entrada Material
$entradaMaterial = new EntradaMaterial($mysqli);
$entradaMaterial->cadastrar($dados);

$material = new Material($mysqli);
$material->setarEntradaEstoque($dados);


navegate($_ENV['ROUTE'] . 'admin.material.index');
