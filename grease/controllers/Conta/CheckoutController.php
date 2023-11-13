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
$campos_validos = $_POST["conta_id"] ? true : false;
if (!$campos_validos) {
  $_SESSION["fed_conta"] = [
    "title" => "Erro!",
    "msg" => "Campos Inválidos",
    "icon" => "error",
  ];
  navegate($_ENV["ROUTE"] . "admin.conta.index");
}

# ------ Atualizar
$conta = new Conta($mysqli);
$caixa = new Caixa($mysqli);


$dados_conta = [
  "conta_id" => $_POST["conta_id"],
  "fornecedor_id" => $_POST["fornecedor_id"],
  "usuario_id" => $_POST["usuario_id"],
  "titulo" => $_POST["titulo"],
  "descricao" => $_POST["descricao"],
  "valor" => $_POST["valor"],
  "data_validade" => $_POST["data_validade"],
  "status_conta" => $_POST["status_conta"],
  "forma_pagamento" => $_POST["forma_pagamento"],
  "obs" => $_POST["obs"]
];

try {

  if ($dados["status_conta"] == 1 && $caixa->unico('descricao', $dados['descricao'])) 
  {

    $dados_cadastrar_saida = [
      "usuario_id" => Auth::getUserData()['usuario_id'],
      "categoria" => "Conta",
      "descricao" => $dados_conta["descricao"],
      "data_movimentacao" => date("Y-m-d H:i:s"),
      "valor" => $dados_conta["valor"],
      "tipo_movimentacao" => "despesa",
      "forma_pagamento" => $dados_conta["forma_pagamento"],
      "obs" => $dados_conta["obs"]
    ];

    if (!$caixa->cadastrarSaida($dados)) {
      MercuryLog::error(
        "erro na saida adicionada",
        Auth::getUserData()["nome"],
        $folder = "usuario"
      );
    } else {
        $dados_conta['status_conta'] = 1;
        $conta->atualizar($dados);
    }
  }

# ChamaSamu::debug($dados);

  $_SESSION["fed_conta"] = [
    "title" => "Sucesso!",
    "msg" => "Atualizado com sucesso",
    "icon" => "success",
  ];
} catch (Exception $e) {
  $_SESSION["fed_conta"] = [
    "title" => "Erro!",
    "msg" => "Erro ao atualizar",
    "icon" => "error",
  ];
}

navegate($_ENV["ROUTE"] . "admin.conta.index");

?>
