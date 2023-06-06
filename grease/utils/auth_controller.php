<?php

$sadm_nao_logado = (
  !isset($_SESSION['usuario']) && 
  empty($_SESSION['usuario'])  && 
  $_SESSION['usuario']['tipo_usuario'] == 'adm'
);
if ($adm_nao_logado) 
{
  navegate($_ENV['URL_VIEWS']. '/auth/login.php');
}

?>