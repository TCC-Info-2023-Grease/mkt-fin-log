<?php
require dirname(dirname(__DIR__)). '/config.php';
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


<center>
   <body>

   	<i><b><h1>CAIXA DA SALA</h1></b></i>

	<header>

		<form action="<?php echo $_ENV["URL_CONTROLLERS"]?>CaixaController.php" method="post">

       <b> <label for="fnome"> Nome: </label></b> <br>
        <select name="fnome"   id="esc">
    <option value="n1">Adriel Bueno 
</option>
    <option value="n2">Alana Aparecida 
</option>
     <option value="n3">Andressa Emilia
</option>
    <option value="n4">Arthur Fumani
</option>
     <option value="n5">Bernardo Oliveira
</option>
    <option value="n6">Caio Lima
</option>
     <option value="n7">Caio Victor
</option>
    <option value="n8">Carla Fernanda
</option>
     <option value="n9">Cristhian da Silva
</option>
    <option value="n10">Eduardo da Silva
</option>
     <option value="n11">Franciely Santos
</option>
    <option value="n12">Geovane de Andrade
</option>
     <option value="n13">Guilherme de Oliveira
</option>
    <option value="n14">Guilherme Dias
</option>
     <option value="n15">Guilherme dos Santos
</option>
    <option value="n16">Guilherme Pacheco
</option>
     <option value="n17">Guilherme Palhares
</option>
    <option value="n18">Gustavo Henrique
</option>
     <option value="n19">Gustavo Martins
</option>
    <option value="n20">Hendryl Rodrigues
</option>
     <option value="n21">Henrique da Silva
</option>
    <option value="n22">Joao Victor
</option>
     <option value="n23">Jozue Wesley
</option>
    <option value="n24">Julia Vitoria
</option>
     <option value="n25">Kethelin Vitoria
</option>
    <option value="n26">Livia Toledo
</option>
     <option value="n27">Maria Vitoria
</option>
    <option value="n28">Matheus Martins
</option>
     <option value="n29">Matheus Cunha
</option>
    <option value="n30">Milena de Freitas
</option>
     <option value="n31">Nayla Assis
</option>
    <option value="n32">Paulo Vitor
</option>
     <option value="n33">Pedro Andrelino
</option>
    <option value="n34">Pedro Gonçalves
</option>
     <option value="n35">Pedro Henrique
</option>
    <option value="n36">Raquel Lima
</option>
     <option value="n37">Samuel Santana
</option>
    <option value="n38">Vinicius Passos
</option>

</select>
      
        <br>
        <br>


       <b> <label for="fform"> Forma de pagamento:</label> </b>
          <input type="checkbox" id="pix" name="pix" value="pix">
        <b>PIX</b><br><br>
        <input type="checkbox" id="fisi" name="fisi" value="fisi">
            <b>Fisico</b>


        <br>
        <br>

       <h1><b> <label for="fvalor" id="tp"> Valor:</label></b></h1> <br>
        <input type="text" id="fvalor" name="fvalor">

        <br>
        <br>

        <b><label for="ftp" id="tp"> Tipo de arrecadação: </label> </b>
          <input type="checkbox" id="rifa" name="rifa" value="rifa">
        <b>Rifa</b> <br><br>
        <input type="checkbox" id="proprio" name="proprio" value="proprio">
      <b>Proprio</b>


    <br>
    <br>

       <button onclick="sal" id="sal">Salvar</button>
	</header>
</form>
</center>

</body>
</html>



