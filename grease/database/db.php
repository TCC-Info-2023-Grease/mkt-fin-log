<?php
require '../../config.php';

global $_VARIAVEIS;

$conn = mysqli_connect (
  $_VARIAVEIS["DB_SERVIDOR"],
  $_VARIAVEIS["DB_USUARIO"],
  $_VARIAVEIS["DB_SENHA"],
  $_VARIAVEIS["DB_NOME"]
);

if (!$conn) {
  throw new Exception('Erro na conexão com o BD', 1);
}
