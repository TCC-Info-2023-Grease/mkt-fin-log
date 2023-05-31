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
  $_POST['nome']           &&
  $_POST['categoria_id']   &&
  $_POST['descricao']      &&
  $_POST['qtde_estimada']  &&
  $_POST['valor_estimado'] &&
  $_POST['valor_gasto']    &&
  $_POST['unidade_medida'] &&
  $_POST['estoque_minimo'] &&
  $_POST['estoque_atual']  &&
  $_POST['status_material']
);
if (!$campos_validos) 
{
  $_SESSION['fed_material'] = [ 
    'title' => 'Erro!', 'msg' => 'Campos Invalidos' 
  ];
  navegate($_ENV['ROUTE'] . 'admin.material.edit');
} 


# ----- Atualizar Material
$material = new Material($mysqli);

if (isset($_FILES['foto_material']) && !empty($_FILES['foto_material'])) {
  if (count($_FILES['foto_material']['tmp_name']) > 0) {
    for ($q = 0; $q < count($_FILES['foto_material']['tmp_name']); $q++) {
      $nomeDoArquivo = $_FILES['foto_material']['name'][$q];
      move_uploaded_file($_FILES['foto_material']['tmp_name'][$q], '../../storage/image/material/'.$nomeDoArquivo);
    }
  }
}

$dados = [
	'id'                => $_POST['material_id'],
  'nome'              => $_POST['nome'],
  'categoria_id'      => $_POST['categoria_id'],
  'descricao'         => $_POST['descricao'],
  'qtde_estimada'     => $_POST['qtde_estimada'],
  'valor_estimado'    => $_POST['valor_estimado'],
  'valor_gasto'       => $_POST['valor_gasto'],
  'unidade_medida'    => $_POST['unidade_medida'],
  'estoque_minimo'    => $_POST['estoque_minimo'],
  'estoque_atual'     => $_POST['estoque_atual'],
  'valor_unitario'    => $_POST['valor_unitario'],
  'datahora_cadastro' => date("Y-m-d H:i:s"),
  'data_validade'     => $_POST['data_validade'],
  'foto_material'     => $nomeDoArquivo,
  'status_material'   => $_POST['status_material']
];

// print_r($dados);
$material->atualizar($dados['id'], $dados);
navegate($_ENV['ROUTE'] . 'admin.material.index');

?>