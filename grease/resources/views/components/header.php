<?php 
# ------ Configurações Básicas
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
<?php } ?>


<!-- ALGUM USUARIO LOGADO -->
<?php if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) { ?>
|
<a href="<?= $_ENV['URL_CONTROLLERS'] ?>/Auth/ProfileController.php?id=<?= $_SESSION['usuario']['usuario_id'] ?>">
  Perfil
</a>
|
<a href="<?= $_ENV['ROUTE'] ?>auth.sair">
  Sair
</a>
<?php } ?>

