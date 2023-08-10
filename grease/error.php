<?php
if (!isset($_GET['erro']) || empty($_GET['erro'])) {
  header("Location: index.php");
  exit;
}

$_ERRO_LIST = [
  '501' => [  
    'title'   => 'Erro 501',
    'message' => 'Copie e cole o arquivo .env.example.php para .env.php'
  ],
  '404' => [  
    'title'   => 'Erro 404 - Página Não Encontrada',
    'message' => 'A página que você está procurando não foi encontrada.'
  ],
  '403' => [  
    'title'   => 'Erro 403 - Acesso Negado',
    'message' => 'Você não tem permissão para acessar esta página.'
  ]
];

$data_erro = $_GET['erro'];
?>


<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não Encontrada - Erro 404</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container text-center my-5">
      <?php for ($i = 0; $i < count($_ERRO_LIST); $i++) { ?>  
        <h1 class="display-1">
          <?= $_ERRO_LIST[$data_erro]['title']; ?>
        </h1>
        <p class="lead">
          <?= $_ERRO_LIST[$data_erro]['message']; ?>
        </p>
        <a href="./index.php" class="btn btn-primary">Voltar para a Página Inicial</a>
      <?php } ?>
    </div>
  </body>
</html>
