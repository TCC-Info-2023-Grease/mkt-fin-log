<!--────────────────Header───────────────-->
<header>
  <a class="logo" href="#">
    <img src="<?= assets('images/web/','logo.png') ?>" alt="Grease" />
  </a>
  <nav>
    <ul class="nav-bar">
      <div class="bg"></div>      
      <?php if (!isset($_SESSION['usuario']) && empty($_SESSION['usuario'])) { ?>
        <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>welcome">Home</a></li>
        <li><a class="nav-link active" href="<?= $_ENV['ROUTE'] ?>auth.login">Login</a></li>
      <?php } else { ?>
        <?php if ($_SESSION['usuario']['tipo_usuario'] == 'adm') { ?>
          <li><a class="nav-link active" href="<?= $_ENV['ROUTE'] ?>admin.home">Home</a></li>
          <li><a class="nav-link" href="<?= $_ENV['VIEWS'] ?>/admin/meta/index.php">Meta</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.usuario.index">Usuários</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.alunos.index">Alunos</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.fornecedor.index">Fornecedores</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.categoria_material.index">Categoria Material</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.material.index">Material</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.caixa.index">Caixa Geral</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.sala.index">Caixa Sala</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.conta.index">Contas</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>admin.makeof.index">Make Of</a></li>
        <?php } elseif ($_SESSION['usuario']['tipo_usuario'] == 'vis') { ?>
          <li><a class="nav-link active" href="<?= $_ENV['ROUTE'] ?>visitante.home">Home</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>visitante.financas">Finanças</a></li>
          <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>visitante.makeof">Projeto</a></li>
        <?php } ?>

        <li><a class="nav-link" href="<?= $_ENV['URL_CONTROLLERS'] ?>/Auth/ProfileController.php?id=<?php echo $_SESSION['usuario']['usuario_id']?>">Perfil</a></li>
        <li><a class="nav-link" href="<?= $_ENV['ROUTE'] ?>auth.sair">Sair</a></li>
      <?php } ?>
    </ul>
    <div class="hamburger">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
    </div>
  </nav>
</header>



<!--COMEÇO VLIBRAS-->

  <div vw class="enabled">
  <div vw-access-button class="active" style="background: transparent;"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>



<!--────────────────Fim - Header───────────────-->

<!-- # Sweet Alert # -->
<script 
  src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
</script> 
<!-- # /Sweet Alert # -->

