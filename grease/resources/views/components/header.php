<?php
# ------ Configurações Básicas
import_utils([ 'navegate' ]);
?>

<a href="<?php echo $_ENV['ROUTE'] ?>auth.cadastrar">
    Cadastrar
</a>
|   
<a href="<?php echo $_ENV['ROUTE'] ?>auth.login">
    Login
</a>
|   
<a href="<?php echo $_ENV['ROUTE'] ?>admin.categoria_material.index">
    Categoria Material
</a>
|   
<a href="<?php echo $_ENV['ROUTE'] ?>auth.login">
    Login
</a>
|   
<a href="<?php echo $_ENV['ROUTE'] ?>auth.sair">
    Sair
</a>