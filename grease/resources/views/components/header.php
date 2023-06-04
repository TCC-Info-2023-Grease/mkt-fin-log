<?php
# ------ Configurações Básicas
// require dirname(dirname(dirname('auth.php')));
?>

<a href="<?php echo $_ENV['ROUTE'] ?>auth.cadastrar">
  Cadastrar
</a>
|
<a href="<?php echo $_ENV['ROUTE'] ?>auth.login">
  Login
</a> 
|
<a href="<?php echo $_ENV['URL_VIEWS'] ?>/auth/profile.php">
  Perfil
</a>
|
<a href="<?php echo $_ENV['ROUTE'] ?>admin.categoria_material.index">
  Categoria Material
</a>
|
<a href="<?php echo $_ENV['ROUTE'] ?>admin.material.index">
  Material
</a>
|
<a href="<?php echo $_ENV['ROUTE'] ?>admin.caixa.index">
  Caixa
</a>
|
<a href="<?php echo $_ENV['ROUTE'] ?>auth.sair">
  Sair
</a>