<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '/config.php';
global $_ENV;

import_utils(['Auth']);

Auth::check('adm');

import_utils([
    'extend_styles',
    'use_js_scripts',
    'render_component',
    'Money',
    'Mascara'
]);

include $_ENV['PASTA_CONTROLLER'] . '/Sala/ConsultaController.php';

//var_dump($data);

if (isset($_SESSION['ultimo_acesso'])) {
    $ultimo_acesso = $_SESSION['ultimo_acesso'];

    if (time() - $ultimo_acesso > 5) {
        unset($_SESSION['fed_sala']);
    }
}
?>


<!------- HEAD --------->
<?php
render_component('head');
//extend_styles(['css.admin.financas']);
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


<title>
    Relatorio Finanças 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<style type="text/css">
	body {
		font-family: monospace;
		font-weight: 600;
	}
</style>
<body style="padding: 2rem;margin: 1rem 0;">
  <?php if (isset($_SESSION['fed_sala']) && !empty($_SESSION['fed_sala'])): ?>
  <script>
  Swal.fire({
      title: '<?= $_SESSION['fed_sala']['title']; ?>',
      text: '<?= $_SESSION['fed_sala']['msg']; ?>',
      icon: '<?= $_SESSION['fed_sala']['icon']; ?>',
      confirmButtonText: 'OK'
  })
  </script>
  <?php endif; ?>


  <div>
  	<button 
  		style="padding: 0.68rem;border-radius: 0.25rem;width: 70px;color: #000;border-color: 2px solid #555;background: #ff0000a6;cursor: pointer;" 
  		onclick="exportToPDF()"
  	>
  		PDF
  	</button>
  	<button 
  		style="padding: 0.68rem;border-radius: 0.25rem;width: 70px;color: #000;border-color: 2px solid #555;background: #28f898;cursor: pointer;" 
  		onclick="exportToExcel()"
  	>
  		Excel
  	</button>
  </div>
  <br><br>


	<?php if (isset($data['sala']) && !empty($data['sala'])) { ?>
    <table id="myTable" class="display" style="width: 100%!important; border-collapse: collapse; border: 1px solid whitesmoke; border-radius: 3rem;" cellpadding="12" cellspacing="15" border="2">
        <thead>
            <tr>
                <th colspan="20" style="background: #333; color: whitesmoke; border: 1px solid whitesmoke;">
                    <h1 style="margin-bottom: 1.2rem;">RELATÓRIO DO CAIXA DA SALA</h1>
                </th>
            </tr>
            <tr>
                <th colspan="2" style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Admin | CPF</th>
                <th style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Aluno</th>
                <th style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Valor</th>
                <th style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Categoria</th>
                <th style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Data</th>
                <th style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Tipo Movimentacao</th>
                <th style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Forma Pagamento</th>
                <th style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Descrição</th>
                <th style="font-size: 1.12rem; font-weight: 700; background: #333; color: whitesmoke; border: 1px solid whitesmoke;">Obs</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($data['sala'] as $sala): ?>
            <tr>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= $sala['nome_usuario']; ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= Mascara::mascararCPF($sala['cpf']); ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= $sala['nome_aluno']; ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= Money::format($sala['valor']); ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= $sala['categoria']; ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= date('d/m/Y H:m:s', strtotime($sala['data_movimentacao'])); ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= $sala['tipo_movimentacao']; ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= $sala['forma_pagamento']; ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= $sala['descricao']; ?>
                </td>
                <td style="background: #f9f9f9; border: 1px solid #fff; text-align: center;">
                    <?= $sala['obs']; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="30" style="background: #333; color: whitesmoke; border: 1px solid whitesmoke; text-align: right;">
                    <strong>
                        Etec de Francisco Morato - 3º Informática Tarde | 2023
                    </strong>
                </td>
            </tr>
        </tfoot>
    </table>
  <?php } else { ?>
      <br>
      <h3>Sem dados</h3>
  <?php } ?>


  <?php
    use_js_scripts([ 
      'js.lib.xlsx',
      'js.lib.jspdf',
      'js.services.jspdf_plugin_autotable',
      'js.services.ExportTabelaCaixa'
    ]);
  ?>
</body>