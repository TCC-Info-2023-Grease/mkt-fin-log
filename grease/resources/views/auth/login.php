<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Grease - Login</title>
  <link href="stylelogin.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="imagens/icon.ico" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="scriptindex.js"></script>
</head>

<body>

  <div class="container">

    <!--────────────────Header───────────────-->
    <header>
      <a class="logo" href="index.html">

        <img src="imagens/logo.png" alt="logo" />
      </a>
      <nav>

        <ul class="nav-bar">
          <div class="bg"></div>
          <li><a class="nav-link" href="index.html">Home</a></li>
          <li><a class="nav-link" href="financas.html">Finanças</a></li>
          <li><a class="nav-link" href="projeto.html">Projeto</a></li>
          <li><a class="nav-link active" href="login.html">Login</a></li>
        </ul>


        <div class="hamburger">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
        
      </nav>
    </header>

    
    <!--────────────────Fim - Header───────────────-->



     <!--─────────────────Home────────────────-->
    <main>
 
      <div id="home">
        <div class="filter"></div>
        <section class="intro">

  

          <div class="wrapper">
            <div class="title-text">
              <div class="title login">Login</div>
              <div class="title signup">Cadastro</div>
            </div>
      
      
            <div class="form-container">
      
              <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Cadastro</label>
                <div class="slider-tab"></div>
              </div>
      
      
              <div class="form-inner">
      
                
                        <form action="#" class="login">
                          <pre>
                          </pre>
                          <div class="field">
                            <input type="email" placeholder="Email" required>
                          </div>
                          <div class="field">
                            <input type="password" placeholder="Senha" required>
                          </div>
                          <div class="pass-link"><a href="#">Esqueceu a senha?</a></div>
                          <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Login">
                          </div>
                          <div class="signup-link">Crie uma conta <a href="">Cadastre-se</a></div>
                        </form>
      
      
                        <form action="#" class="signup">
                          <div class="field">
                            <input type="text" placeholder="Nome" required>
                          </div>
                          <div class="field">
                            <input type="email" placeholder="Email" required>
                          </div>
                          <div class="field">
                            <input type="tel" placeholder="Telefone" required>
                          </div>
                          <div class="field">
                            <input type="number" placeholder="Idade" required>
                          </div>
                          <div class="field">
                            <input type="text" placeholder="Gênero" required>
                      
                          </div>
                          <div class="field">
                            <input type="password" placeholder="Senha" required>
                          </div>
                          <div class="field btn">
                            <div class="btn-layer"></div>
                            <input type="submit" value="Signup">
                          </div>
                          <div class="signup-link">Já tem uma conta <a href="usuario com conta/conta.html">Login</a></div>
                        </form>
              </div>
      
            </div>
          </div>
        <script  src="login.js"></script>
     

          <p></p>

        </section>
      </div>

    </main>
      <!--─────────────────fim Home────────────────-->
      
      
      
   


<br><br><br><br><br><br>

      <!--─────────────────Footer─────────────────-->
    <footer class="copyright">
      <a href="https://goo.gl/maps/6L43o6zw5VmfJ3b99" target="_blank">ETEC DE FRANCISCO MORATO - Planejamanto e Desenvolvimento do Trabalho de Conclusão de Curso(TCC) INFORMÁTICA PARA INTERNET. </a>
    </footer>
      <!--─────────────────Fim Footer────────────────-->
  </div>

  <!--COMEÇO VLIBRAS-->

  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

  <!--FIM VLIBRAS-->

</body>

</html>