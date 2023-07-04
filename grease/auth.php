<?php 
if (!isset($_SESSION['usuario']) && empty($_SESSION['usuario'])) 
{
  navegate($_ENV['VIEWS']. '/auth/login.php');
} else if ($_SESSION['usuario']['tipo_usuario'] == 'adm') 
{
  navegate($_ENV['VIEWS']. '/admin/home.php');
} else if ($_SESSION['usuario']['tipo_usuario'] == 'vis') 
{
  navegate($_ENV['VIEWS']. '/visitante/home.php');
} else 
{
  navegate($_ENV['VIEWS']. '/servicos/home.php');
}

?>