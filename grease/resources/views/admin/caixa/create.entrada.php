<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';
global $_ENV;


import_utils(['extend_styles', 'render_component']);

?>


<!------- HEAD --------->
<?php
render_component('head');
//extend_styles(['styles']);
?>
<title>Caixa da sala</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"
  type="text/javascript"></script>
<!------- /HEAD --------->

<body>
  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/header.php';
  ?>

  <?php if (isset($_SESSION['fed_material']) && !empty($_SESSION['fed_material'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_material']['title']; ?>',
      text: '<?php echo $_SESSION['fed_material']['msg']; ?>',
      icon: 'error',
      confirmButtonText: 'OK'
    })
  </script>
  <?php endif; ?>

  <form action="<?php echo $_ENV["URL_CONTROLLERS"] ?>CaixaController.php" method="post">

    <label for="categoria_escolhida">
      Categoria:
    </label>
    <br>

    <select name="categoria_escolhida" id="">
      <option value="">
        - Selecione uma opção -
      </option>
      <option value="Aberta">Aberta</option>
      <option value="Despesas">Despesas</option>
      <option value="Pagamentos">Pagamentos</option>
      <option value="Transferências">Transferências</option>
      <option value="Reservas">Reservas</option>
    </select>
    <br>

    <label for="descricao">Descrição:</label><br>
    <textarea name="descricao" id="" cols="30" rows="10">
    </textarea>
    <br>

    <label for="price">Valor:</label><br>
    <input type="text" id="money" name="price"><br>
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

    <label for="status_caixa">Status caixa:</label><br>
    <select name="status_caixa" id="">
      <option value="">
        - Selecione uma opção -
      </option>
      <option value="Receitas">Aberta</option>
      <option value="Fechada">Fechada</option>
      <option value="Em andamento">Em andamento</option>
      <option value="Concluída">Concluída</option>
      <option value="Cancelada">Cancelada</option>
    </select>
    <br>

    <label for="lname">Observação:</label><br>
    <textarea name="obs" id="" cols="30" rows="10">
    </textarea>
    <br>


    <input type="submit" value="salvar">

  </form>

  <?php
  require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
  ?>
  <script>
    $(document).ready(() => {
      $('#money').maskMoney({
        prefix: 'R$ ',
        allowNegative: false,
        thousands: '.', decimal: ',',
        affixesStay: true
      });
    });
  </script>
</body>