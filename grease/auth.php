<?php 
if (!isset($_SESSION['usuario']) && empty($_SESSION['usuario'])) 
{
  navegate($_ENV['URL_VIEWS']. '/auth/login.php');
} else if ($_SESSION['usuario']['tipo_usuario'] == 'adm') 
{
  navegate($_ENV['URL_VIEWS']. '/admin/home.php');
} else if ($_SESSION['usuario']['tipo_usuario'] == 'vis') 
{
  navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
} else 
{
  navegate($_ENV['URL_VIEWS']. '/servicos/home.php');
}

?>