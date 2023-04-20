<?php
# ------ Configurações Básicas
require dirname(dirname(__DIR__)) . '/config.php';
global $_ENV;

import_utils(['extend_styles', 'render_component']);
?>

<!------- HEAD --------->
<?php
render_component('head');
extend_styles(['styles']);
?>

<title>
    Login 🚪 Grease
</title>
<script>
    $(document).ready(function () {
        $('.phone').inputmask('(99) - 99999-9999');
    });  
</script>
<!-------/ HEAD --------->


<!------- BODY --------->

<body>
    <a href="<?php echo $_ENV['URL_BASE']; ?>" class="btn-voltar">
        Voltar
    </a>
    <div class="login">

        <?php if (isset($_GET['erro']) == 'campos_invalidos'): ?>
            <script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Campos invalidos!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            </script>
        <?php endif; ?>

        <a href="<?php echo $_ENV['URL_ROUTE'] . 'login'; ?>">
            <h2 class="nactive" id="my-button">Login</h2>
        </a>

        <h2 class="noactive">Criar conta</h2>

        <form 
            method="POST" 
            action="<?php echo $_ENV['URL_CONTROLADOR']; ?>/LoginControlador.php"
        >
            <input type="password" class="text" name="password">
            <label for="password">Senha</label>
            <br>

            <input type="email" class="text" name="email">
            <label for="email">Email</label>
            <br>

            <label for="rememberme" style="margin-top: 90px">
                <input 
                    style="color: #fff;"
                    type="checkbox" 
                    name="rememberme" 
                />
                Lembrar de mim
            </label>


            <button class="signin login">
                Entrar
            </button>
        </form>

    </div>
</body>
<!------- /BODY --------->
