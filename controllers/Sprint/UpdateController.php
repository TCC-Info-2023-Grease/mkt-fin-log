<?php
# ------ Dados Iniciais
require dirname(dirname(__DIR__)) . "/config.php";

global $mysqli;

import_utils(["Auth"]);
Auth::check("adm");

import_utils(["valida_campo", "navegate"]);

# ------ Verificar Sessão
if (isset($_SESSION["ultimo_acesso"])) {
  $ultimo_acesso = $_SESSION["ultimo_acesso"];
} else {
  $ultimo_acesso = null;
}

$_SESSION["ultimo_acesso"] = time();

# ------ Validar Envio de Dados
$campos_validos = (
  !empty($_POST['titulo']) && isset($_POST['titulo']) &&
  !empty($_POST['descricao']) && isset($_POST['descricao']) &&
  !empty($_POST['data_de_inicio']) && isset($_POST['data_de_inicio'])  &&
  !empty($_POST['data_de_fim']) && isset($_POST['data_de_fim']) &&
  !empty($_POST['status_sprint']) && isset($_POST['status_sprint']) 
);
if (!$campos_validos) {
  $_SESSION["fed_sprint"] = [
    "title" => "Erro!",
    "msg" => "Campos Inválidos",
    "icon" => "error",
  ];
  navegate($_ENV["ROUTE"] . "admin.sprint.index");
}

# ------ Atualizar
$sprint = new Sprint($mysqli);

try {
  $dados = [
    'titulo'          => $_POST['titulo'],
    'descricao'       => $_POST['descricao'],
    'data_de_inicio'  => $_POST['data_e_inicio'],
    'data_de_fim'     => $_POST['data_de_fim'],
    'status_sprint'   => $_POST['status_sprint']
  ];
  # ChamaSamu::debug($dados);
  
  $sprint->atualizar($dados);

  $_SESSION["fed_sprint"] = [
    "title" => "Sucesso!",
    "msg" => "Atualizado com sucesso",
    "icon" => "success",
  ];
} catch (Exception $e) {
  $_SESSION["fed_sprint"] = [
    "title" => "Erro!",
    "msg" => "Erro ao atualizar",
    "icon" => "error",
  ];
}

navegate($_ENV["ROUTE"] . "admin.sprint.index");

?>
