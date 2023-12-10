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
  'Chronus'
]);

include $_ENV['PASTA_CONTROLLER'] . '/Sprint/ConsultaController.php';

//print_r(isset($_SESSION['fed_sprint']) && !empty($_SESSION['fed_sprint']));

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];

  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 4) {
    unset($_SESSION['fed_sprint']);
  }
}

# ChamaSamu::debugPanel($data);
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'css.admin.financas' ]);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<title>
  Sprints Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php
  render_component('sidebar');
  ?>

  <?php if (isset($_SESSION['fed_sprint']) && !empty($_SESSION['fed_sprint'])): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION['fed_sprint']['title']; ?>',
      text: '<?php echo $_SESSION['fed_sprint']['msg']; ?>',
      icon: '<?php echo $_SESSION['fed_sprint']['icon']; ?>',
      confirmButtonText: 'OK'
    })
  </script>
  <?php endif; ?>

  <section class="dashboard">
      <div class="top"> <i class="uil uil-bars sidebar-toggle"></i> </div>

      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"> <span class="text"><h1>Sprints</h1></span> </div> 

          <div>
             <a href="<?= $_ENV['ROUTE'] ?>admin.sprint.create" class="button-link" style="background-color: #28a745;">
              Nova Sprint
            </a>
          </div>
        </div>
      </div>

    <style>
      .title #sprint {
        width: 400px;
      }
    </style>
      <div class="dash-content">
        <div style="display: flex;justify-content: ;align-items: streth;flex-direction: column; padding: 2rem;">
            <div class="title">
              <select name="sprint" id="sprint" class="text">
                <option value="">
                  Sprint 1
                </option>
              </select>
            </div>
      
            <div class="kanban-board">
              <div class="column">
                <header>
                  <h2>A fazer</h2>
                  <i class="fa fa-solid fa-plus"></i>
                </header>
                
                <ul class="cards">
                  <li class="card">
                    <h3>Tarefa 1</h3>
                    <p>Descrição da tarefa 1</p>
                  </li>
                  <li class="card">
                    <h3>Tarefa 2</h3>
                    <p>Descrição da tarefa 2</p>
                  </li>
                </ul>
              </div>
              <div class="column">
                <h2>Em andamento</h2>
                <ul class="cards">
                  <li class="card">
                    <h3>Tarefa 3</h3>
                    <p>Descrição da tarefa 3</p>
                  </li>
                  <li class="card">
                    <h3>Tarefa 4</h3>
                    <p>Descrição da tarefa 4</p>
                  </li>
                </ul>
              </div>
              <div class="column">
                <h2>Concluído</h2>
                <ul class="cards">
                  <li class="card">
                    <h3>Tarefa 5</h3>
                    <p>Descrição da tarefa 5</p>
                  </li>
                  <li class="card">
                    <h3>Tarefa 6</h3>
                    <p>Descrição da tarefa 6</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="dash-content">
        <hr color="black" />
      </div>


      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div class="title"><span class="text">Itens</span></div>

          <div class="dropdown">
            <a target="_blank" href="<?= $_ENV['ROUTE'] ?>admin.sprint.relatorio" class="dropbtn" style="text-decoration: none;">
              Relatório
            </a>
          </div>
        </div>

        <?php if (isset($data['sprints']) || !empty($data['sprints'])) { ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th># ID</th>
                    <th>Título</th>
                    <th>Data de Inicio</th>
                    <th>Data de Fim</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['sprints'] as $sprint): ?>
                <tr>
                    <td style="width: 96px;">
                        <?= $sprint['id']; ?>
                    </td>
                    <td>
                        <?= $sprint['titulo']; ?>
                    </td>
                    <td>
                        <?=  Chronus::formater($sprint['data_de_inicio']); ?>
                    </td>
                    <td>
                        <?=  Chronus::formater($sprint['data_de_fim']); ?>
                    </td>
                    <th>
                        <?= $sprint['descricao']; ?>
                    </th>
                    <td style="color: <?= ($sprint['status_sprint'] == 'ativa')? 'green' : 'red'; ?>;">
                        <strong>
                          <?= $sprint['status_sprint']; ?>
                        </strong>
                    </td>
                    <th style="padding: 32px;width: 90px;">
                      <a
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Sprint/ShowController.php?id=<?= $sprint['id']; ?>"
                        class="icon-link"
                      >
                        <i class="fa-regular fa-eye"></i> 
                      </a>

                      <br>
                      <br>
                      <hr>
                      <br>

                      <a
                        href="<?= $_ENV['URL_CONTROLLERS']; ?>/Sprint/EditController.php?id=<?= $sprint['id']; ?>"
                        class="icon-link edit"
                      >
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <br><br>

                      <a
                        href="#"
                        onclick="if (confirm('Deseja excluir mesmo?')) {
                          this.href = '<?= $_ENV['URL_CONTROLLERS']; ?>/Sprint/DeletarController.php?id=<?= $sprint['id']; ?>';
                        }"
                        class="icon-link delete"
                      >
                        <i class="fa-solid fa-trash"></i>
                      </a>
                    </th>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <?php } else { ?>
            <h3>Sem inserções</h3>
            <?php } ?>
        </table>
      </div>
    </div>
  </section>

  <?php
  use_js_scripts([ 'js.admin.financas' ]);
  ?>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
</body>
<!-------/ BODY --------->
