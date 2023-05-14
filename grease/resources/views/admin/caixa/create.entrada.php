<?php
require dirname(dirname(dirname(dirname(__DIR__)))). '/config.php';
global $_ENV;
?>


<title>Caixa da sala</title>
    <style type="text/css">
  body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            font-size: 16px;
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 24px;
        }
        form {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 500px;
            padding: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
        select,
        input[type="text"] {
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            font-size: 16px;
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
        }
        input[type="radio"] {
            display: inline-block;
            margin-right: 10px;
        }
        button {
            background-color: #008CBA;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
        }
        button:hover {
            background-color: #005e79;
        }

        #tp{
 font-size: 20px;
        }
  
  #mn{
font-size: 10px;

  }
    </style>


		<form action="<?php echo $_ENV["URL_CONTROLLERS"]?>CaixaController.php" method="post">

  <label for="lname">Categoria:</label><br>
  <input type="number" id="Ctgr" name="Ctgr"><br>
<br>
  <label for="lname">Descrição:</label><br>
  <input type="text" id="Dcc" name="Dcc"><br>
<br>
  <label for="lname">Valor:</label><br>
  <input type="number" id="Vl" name="Vl"><br>
<br>
   <label for="lname">Tipo movimentação:</label><br>
  <input type="text" id="TM" name="TM"><br>
<br>
   <label for="lname">Forma pagamento:</label><br>
  <input type="text" id="CS" name="CS"><br>
<br>
   <label for="lname">Saldo anterior:</label><br>
  <input type="number" id="SAnterior" name="SAnterior"><br>
<br>
   <label for="lname">Saldo atual:</label><br>
  <input type="number" id="SAtual" name="SAtual"><br>
<br>
   <label for="lname">Status caixa:</label><br>
  <input type="radio" id="SC" name="SC" value="Ativo">Ativo<br>
  <input type="radio" id="SC" name="SC" value="Inativo">Inativo<br>
<br>
    <label for="lname">Observação:</label><br>
  <input type="text" id="Obs" name="Obs"><br>
<br>
  

  <input type="submit" value="salvar">
       
        </form>
</body>
</html>



