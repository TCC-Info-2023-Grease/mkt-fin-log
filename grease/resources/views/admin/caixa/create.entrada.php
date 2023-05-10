<?php
require dirname(dirname(dirname(__DIR__))). '/config.php';
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

       
        </form>
</body>
</html>



