<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro Caixa</title>
  <link href="admin.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--────────────────Header───────────────-->
    <header>
      <a class="logo" href="index.html">

        <img src="logo.png" alt="logo" />
      </a>
      <nav>

        <ul class="nav-bar">
          <div class="bg"></div>
          <li><a class="nav-link" href="financas.html">Finanças</a></li>
          <li><a class="nav-link active" href="cadastro-caixa.php">Cadastro Caixa</a></li>
          <li><a class="nav-link" href="fornecedor.php">Fornecedores</a></li>
          <li><a class="nav-link" href="materiais.php">Materias</a></li>
          <li><a class="nav-link" href="categoria-materiais.php">Categoria materias</a></li>
          <li><a class="nav-link" href="saida-materiais.php">Saida materias</a></li>
        </ul>


        <div class="hamburger">
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
        
      </nav>
    </header>

    
    <!--────────────────Fim - Header───────────────-->


<meta charset="UTF-8">
    <h1>Cadastro Caixa</h1>

<form method="POST" action="">

  <label for="lname">Categoria:</label><br>
  <input type="number" id="Ctgr" name="Ctgr"><br>

  <label for="lname">Descrição:</label><br>
  <input type="text" id="Dcc" name="Dcc"><br>

  <label for="lname">Valor:</label><br>
  <input type="number" id="Vl" name="Vl"><br>

   <label for="lname">Tipo movimentação:</label><br>
  <input type="text" id="TM" name="TM"><br>

   <label for="lname">Forma pagamento:</label><br>
  <input type="text" id="CS" name="CS"><br>

   <label for="lname">Saldo anterior:</label><br>
  <input type="number" id="SAnterior" name="SAnterior"><br>

   <label for="lname">Saldo atual:</label><br>
  <input type="number" id="SAtual" name="SAtual"><br>

   <label for="lname">Status caixa:</label><br>
  <input type="radio" id="SC" name="SC" value="Ativo">Ativo<br>
  <input type="radio" id="SC" name="SC" value="Inativo">Inativo<br>

    <label for="lname">Observação:</label><br>
  <input type="text" id="Obs" name="Obs"><br>

  

  <input type="submit" value="salvar">
</form>