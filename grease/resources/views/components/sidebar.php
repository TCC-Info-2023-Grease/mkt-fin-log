<nav>
	<div class="logo-name">
		<div class="logo-image">
			<!--<img src="images/logo.png" alt="">--></div> <span class="logo_name">Finanças</span> </div>
	<div class="menu-items">
		<ul class="nav-links">
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.home">
            <i class="uil uil-estate"></i>
            <span class="link-name">Home</span>
          </a></li>
          <li><a href="<?= $_ENV['VIEWS'] ?>/admin/meta/index.php">
            <i class="uil uil-chart"></i>
            <span class="link-name">Meta</span>
          </a></li>
           <li><a href="<?= $_ENV['ROUTE'] ?>admin.usuario.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Usuários</span>
          </a></li>
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.caixa.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Caixa</span>
          </a></li>
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.makeof.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Make Of</span>
          </a></li>
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.material.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Materiais</span>
          </a></li>
			<li><a href="<?= $_ENV['ROUTE'] ?>admin.categoria_material.index">
            <i class="uil uil-chart"></i>
            <span class="link-name">Categoria Material</span>
          </a></li>
      <br>

			<ul class="logout-mode">
        <li><a  href="<?= $_ENV['VIEWS'] ?>/auth/profile.php">
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
