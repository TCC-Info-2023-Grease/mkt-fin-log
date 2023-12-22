<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . "/config.php";
global $_ENV;

import_utils(["Auth"]);

Auth::check("adm");

import_utils([
  "extend_styles",
  "use_js_scripts",
  "render_component",
  "Chronus",
]);

include $_ENV["PASTA_CONTROLLER"] . "/Sprint/ConsultaController.php";

//print_r(isset($_SESSION['fed_sprint']) && !empty($_SESSION['fed_sprint']));

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if (isset($_SESSION["ultimo_acesso"])) {
  $ultimo_acesso = $_SESSION["ultimo_acesso"];

  // Verifica se já passaram 5 minutos desde o último acesso
  if (time() - $ultimo_acesso > 4) {
    unset($_SESSION["fed_sprint"]);
  }
}

# ChamaSamu::debugPanel($data);
?>

<!------- HEAD --------->
<?php
render_component("head");
extend_styles(["css.admin.financas"]);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sortablejs/1.10.1/Sortable.min.js"></script>



<title>
  Sprints Admin 🕺 Grease
</title>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
  <?php render_component("sidebar"); ?>

  <?php if (
    isset($_SESSION["fed_sprint"]) &&
    !empty($_SESSION["fed_sprint"])
  ): ?>
  <script>
    Swal.fire({
      title: '<?php echo $_SESSION["fed_sprint"]["title"]; ?>',
      text: '<?php echo $_SESSION["fed_sprint"]["msg"]; ?>',
      icon: '<?php echo $_SESSION["fed_sprint"]["icon"]; ?>',
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
             <a href="<?= $_ENV[
               "ROUTE"
             ] ?>admin.sprint.create" class="button-link" style="background-color: #28a745;">
              Nova Sprint
            </a>
          </div>
        </div>
        <br><br>
        
        <?php if (
          !empty($data['sprints']) ||
          !empty($data['sprintsAtivas']) ||
          !empty($data['sprintsNaoAtivas'])
       ): ?>
        <div class="dash-content">
          <div class="boxes">
              <?php if (
                !empty($data['sprintsAtivas'])
              ): ?>
             <div 
                class="box 
                  <?php if (!empty($data['sprintsAtivas']) && ($data['sprintsAtivas']) <= 10): ?>
                    box3
                  <?php elseif (!empty($data['sprintsAtivas']) && ($data['sprintsAtivas']) > 0): ?>
                    box2
                  <?php else: ?>
                    box1
                  <?php endif; ?>
              ">
                <span class="text">Ativas</span> 
                <span class="number">
                   <?= (count($data['sprintsAtivas']) > 0)? count($data['sprintsAtivas']) : '0'; ?>
                </span> 
              </div>
              <?php endif; ?>

                <?php if (
                !empty($data['sprintsNaoAtivas'])
              ): ?>
              <div 
                class="box 
                  <?php if (count($data['sprintsNaoAtivas']) < count($data['sprintsAtivas'])): ?>
                    box1
                  <?php elseif (count($data['sprintsNaoAtivas']) > count($data['sprintsAtivas'])): ?>
                    box2
                  <?php else: ?>
                    box3
                  <?php endif; ?>
              ">              
                <span class="text">Não Ativas</span> 
                <span class="number">
                  <?=  (count($data['sprintsNaoAtivas']) > 0)? count($data['sprintsNaoAtivas']) : '0'; ?>
                </span> 
              </div>
              <?php endif; ?>

              <div class="box box4"> 
                <span class="text">Total</span> 
                <span class="number">
                <?= (count($data['sprints']) > 0)? count($data['sprints']) : '0'; ?>
                </span> 
              </div>          
            </div>
        </div>
        <br><br>
        <?php endif ?>
        <br>
        <hr>

      </div>
      


      <div class="dash-content">
        <div style="display: flex;justify-content: space-between;align-items: center;">
          <div></div>
        
          <div class="dropdown">
            <a target="_blank" href="<?= $_ENV[
              "ROUTE"
            ] ?>admin.sprint.relatorio" class="dropbtn" style="text-decoration: none;">
              Relatório
            </a>
          </div>
        </div>
        <br><br>

        <?php if (isset($data["sprints"]) || !empty($data["sprints"])) { ?>
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
                <?php foreach ($data["sprints"] as $sprint): ?>
                <tr>
                    <td style="width: 96px;">
                        <?= $sprint["id"] ?>
                    </td>
                    <td>
                        <?= $sprint["titulo"] ?>
                    </td>
                    <td>
                        <?= Chronus::formater($sprint["data_de_inicio"]) ?>
                    </td>
                    <td>
                        <?= Chronus::formater($sprint["data_de_fim"]) ?>
                    </td>
                    <th>
                        <?= $sprint["descricao"] ?>
                    </th>
                    <td style="color: <?= $sprint["status_sprint"] == "ativa"
                      ? "green"
                      : "red" ?>;">
                        <strong>
                          <?= $sprint["status_sprint"] ?>
                        </strong>
                    </td>
                    <th style="padding: 32px;width: 90px;">
                      <a
                        href="<?= $_ENV[
                          "URL_CONTROLLERS"
                        ] ?>/Sprint/ShowController.php?id=<?= $sprint["id"] ?>"
                        class="icon-link"
                      >
                        <i class="fa-regular fa-eye"></i> 
                      </a>

                      <br>
                      <br>
                      <hr>
                      <br>

                      <a
                        href="<?= $_ENV[
                          "URL_CONTROLLERS"
                        ] ?>/Sprint/EditController.php?id=<?= $sprint["id"] ?>"
                        class="icon-link edit"
                      >
                        <i class="fa-regular fa-pen-to-square"></i>
                      </a>
                      <br><br>

                      <a
                        href="#"
                        onclick="if (confirm('Deseja excluir mesmo?')) {
                          this.href = '<?= $_ENV[
                            "URL_CONTROLLERS"
                          ] ?>/Sprint/DeletarController.php?id=<?= $sprint["id"] ?>';
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

  <?php use_js_scripts(["js.admin.financas"]); ?>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
      
      /* ===========
      const myList = document.querySelector("#mylist");
    
     // Cria um novo objeto Sortable
      const sortable = new Sortable(myList);
      
      // Define o comportamento do arrastar e soltar
      sortable.on("sort", (event) => {
        // Atualiza a lista de tarefas
        const tasks = sortable.toArray();
        alert(tasks);
      });
      */
    });
  </script>
</body>
<!-------/ BODY --------->
