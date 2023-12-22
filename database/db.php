<?php
global $_ENV;

$mysqli = mysqli_connect (
  $_ENV["DB_SERVIDOR"],
  $_ENV["DB_USUARIO"],
  $_ENV["DB_SENHA"],
  $_ENV["DB_NOME"]
);

if (!$mysqli) {
  echo 'Erro na conexão com o BD';
}
