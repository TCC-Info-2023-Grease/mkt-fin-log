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
  "obs" => $_POST["obs"],
];

try {
  // Verifica se a conta existe
  if (!$conta->buscar($dados_conta["conta_id"])) {
    $_SESSION["fed_conta"] = [
      "title" => "Erro!",
      "msg" => "Conta não encontrada",
      "icon" => "error",
    ];
  }

  // Registra a saída no caixa
  $dados_cadastrar_saida = [
    "usuario_id" => Auth::getUserData()["usuario_id"],
    "categoria" => "Conta",
    "descricao" => "ID-CONTA: ". $dados_conta['conta_id'] ."\n".$dados_conta["descricao"],
    "data_movimentacao" => date("Y-m-d H:i:s"),
    "valor" => $dados_conta["valor"],
    "tipo_movimentacao" => "despesa",
    "forma_pagamento" => $dados_conta["forma_pagamento"],
    "obs" => $dados_conta["obs"],
  ];

  if ($dados_conta["status_conta"] == 1 && !$caixa->unico('descricao', $dados_cadastrar_saida['descricao'])) 
  {
    $_SESSION["fed_conta"] = [
      "title" => "Erro!",
      "msg" => "Conta já paga!",
      "icon" => "error",
    ];
  }

  if (!$caixa->cadastrarSaida($dados_cadastrar_saida)) {
    $_SESSION["fed_conta"] = [
      "title" => "Erro!",
      "msg" => "Erro ao registrar saída no caixa",
      "icon" => "error",
    ];
  }

  // Atualiza o status da conta
  $dados_conta["status_conta"] = intval(1);
  $conta->atualizar($dados_conta);
  
  #ChamaSamu::debugPanel($dados_cadastrar_saida);

  // Redireciona para a página de listagem de contas
  $_SESSION["fed_conta"] = [
    "title" => "Sucesso!",
    "msg" => "Conta Paga!",
    "icon" => "success",
  ];
} catch (Exception $e) {
  // Exibe a mensagem de erro
  $_SESSION["fed_conta"] = [
    "title" => "Erro!",
    "msg" => $e->getMessage(),
    "icon" => "error",
  ];
}

navegate($_ENV["ROUTE"] . "admin.conta.index");
