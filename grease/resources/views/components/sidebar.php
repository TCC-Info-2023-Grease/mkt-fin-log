<nav>
	<div class="logo-name">
		<div class="logo-image">
			<!--<img src="images/logo.png" alt="">--></div> <span class="logo_name">Gestão</span> </div>
	<div class="menu-items">
		<ul class="nav-links">
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.home">
            <i class="uil uil-estate"></i>
            <span class="link-name">Home</span>
          </a></li>
          <br><hr><br>
          
           <li><a href="<?= $_ENV['ROUTE'] ?>admin.usuario.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Usuários</span>
          </a></li>
          <li><a href="<?= $_ENV['ROUTE'] ?>admin.alunos.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Alunos</span>
          </a></li>
          <br><hr><br>
        
      
          <li><a href="<?= $_ENV['VIEWS'] ?>/admin/meta/index.php">
            <i class="uil uil-chart"></i>
            <span class="link-name">Meta</span>
          </a></li>
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.caixa.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Caixa Geral</span>
          </a></li>
          <li><a href="<?= $_ENV['ROUTE'] ?>admin.sala.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Caixa Sala</span>
          </a></li>
          <li><a href="<?= $_ENV['ROUTE'] ?>admin.conta.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Contas</span>
          </a></li>
          <br><hr><br>
          
          <li><a href="<?= $_ENV['ROUTE'] ?>admin.sprint.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Sprints</span>
          </a></li>
          
          <li><a href="<?= $_ENV['ROUTE'] ?>admin.task.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Tarefas</span>
          </a></li>
          <br><hr><br>
          
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.makeof.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Make Of</span>
          </a></li>
          <br><hr><br>
          
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.material.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Materiais</span>
          </a></li>
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.categoria_material.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Categoria Material</span>
          </a></li>
          <li><a href="<?= $_ENV['ROUTE'] ?>admin.fornecedor.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Fornecedores</span>
          </a></li>
      <br>

			<ul class="logout-mode">
        <li><a  href="<?= $_ENV['URL_CONTROLLERS'] ?>/Auth/ProfileController.php?id=<?php echo $_SESSION['usuario']['usuario_id']?>">
              <i class="uil uil-user"></i>
              <span class="link-name">Perfil</span>
            </a></li>
				<li><a href="<?= $_ENV['ROUTE'] ?>auth.sair">
              <i class="uil uil-signout"></i>
              <span class="link-name">Sair</span>
            </a></li>
				<li class="mode"> <a href="#">
              <i class=""></i>
            </a> </li>
			</ul>
		</ul>
	</div>
</nav>


<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<!--COMEÇO VLIBRAS-->

  <div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>

<script>
  new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

<!--FIM VLIBRAS-->