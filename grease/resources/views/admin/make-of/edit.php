<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(dirname(__DIR__)))) . '\config.php';

global $_ENV;   

# Receber os dados enviados via POST
$data = $_POST;

import_utils(['extend_styles', 'render_component']);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_makeof']);
  }
} 
?>


<?php
require $_ENV['PASTA_VIEWS'] . '/components/head.php';
?>
<title>
    Admin 🕺 Grease
</title>


<body>
    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/header.php';
    ?>

    <?php if (isset($_SESSION['fed_makeof']) && !empty($_SESSION['fed_makeof'])): ?>
        <script>
        Swal.fire({
            title: '<?= $_SESSION['fed_makeof']['title']; ?>',
            text: '<?= $_SESSION['fed_makeof']['msg']; ?>',
            icon: '<?= $_SESSION['fed_makeof']['icon']; ?>',
            confirmButtonText: 'OK'

        })
        </script>
    <?php endif; ?>
    
    <form 
        method="POST" 
        action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/MakeOf/UpdateController.php"
    >
        <type="hidden" 
            class="text" 
            name="id" 
            value="<?= $data['makeof_id']; ?>" />
 
        <label for="titulo">Titulo:</label><br>
        <input 
            type="text" 
            name="titulo" 
            value="<?= $data['titulo'] ?>" 
            required
        />

        <br>
        <label for="descricao">Descrição:</label><br>
        <textarea 
            name="descricao" 
            id="" 
            cols="30" 
            rows="10" 
            required
        >
            <?= $data['descricao'] ?>
        </textarea>
        <br>

        <label for="uri">Link Make Ofs:</label><br>
        <textarea 
            name="uri" 
            id="" 
            cols="30" 
            rows="10" 
            required
        >
            <?= $data['uri'] ?>
        </textarea>
        <br>
        
        <input type="submit" value="salvar">            
    </form>


    <?php
    require $_ENV['PASTA_VIEWS'] . '/components/footer.php';
    ?>
</body> 