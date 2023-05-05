<?php
# ------ Configurações Básicas
import_utils([ 'navegate' ]);
?>

<a href="<?php echo $_ENV['URL_ROUTE'] ?>auth.cadastrar">
    Cadastrar
</a>
|
<a href="<?php echo $_ENV['URL_ROUTE'] ?>auth.login">
    Login
</a>

<?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipo_usuario'] == 'adm'): ?>
|    
<a href="<?php echo $_ENV['URL_ROUTE'] ?>admin.categoria_material">
    Categoria Material
</a>
<?php endif ?>

<?php if (isset($_SESSION['usuario'])): ?>
<a href="<?php echo $_ENV['URL_ROUTE'] ?>usuario.perfil">
    Perfil
</a>
|   
<a href="<?php echo $_ENV['URL_ROUTE'] ?>auth.sair">
    Sair
</a>
<?php endif ?>