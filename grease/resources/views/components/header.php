<?php 

?>

<!-- USUARIO NÃO LOGADO -->
<?php if (!isset($_SESSION['usuario']) && empty($_SESSION['usuario'])) { ?>
  <a href="<?= $_ENV['ROUTE'] ?>auth.cadastrar">
    Cadastrar
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>auth.login">
    Login
  </a> 
  |
  <a href="<?= $_ENV['ROUTE'] ?>home.financas.index">
    Finanças
  </a> 
<?php } ?>


<!-- USUARIO ADM LOGADO -->
<?php if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuario'] == 'adm') { ?>
  <a href="<?= $_ENV['ROUTE'] ?>admin.home">
    Home
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>admin.categoria_material.index">
    Categoria Material
  </a>
  | 
  <a href="<?= $_ENV['ROUTE'] ?>admin.material.index">
    Material
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>admin.caixa.index">
    Caixa
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>admin.makeof.index">
    Make Of
  </a>
<?php } ?>


<!-- USUARIO VISITANTE LOGADO -->
<?php if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuario'] == 'vis') { ?>
  <a href="<?= $_ENV['ROUTE'] ?>visitante.financas">
    Finanças
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>home.projeto">
    Projeto
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>visitante.makeof.index">
    Make Of
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>home.contato">
    Contato
  </a>
<?php } ?>

<!-- ALGUM USUARIO LOGADO -->
<?php if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) { ?>
  |
  <a href="<?= $_ENV['VIEWS'] ?>/auth/profile.php">
    Perfil
  </a>
  |
  <a href="<?= $_ENV['ROUTE'] ?>auth.sair">
    Sair
  </a>
<?php } ?>

