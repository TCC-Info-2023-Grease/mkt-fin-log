<<<<<<< HEAD
<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
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
        <?php if (isset($_GET['erro']) == 'usuario'): ?>
            <script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Email e/ou senha incorretos!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            </script>
        <?php endif; ?>

        <a href="<?php echo $_ENV['URL_ROUTE'] . 'auth.login'; ?>">
            <h2 class="active" id="my-button" style="color:gray">
                Login
            </h2>
        </a>

        <a href="<?php echo $_ENV['URL_ROUTE'] . 'auth.cadastrar'; ?>">
            <h2 class="noactive" style="color:aliceblue">
                Criar conta
            </h2>
        </a>
        

        <form 
            method="POST" 
            action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Auth/LoginController.php"
        >
            <input type="email" class="text" name="email">
            <label for="email">Email</label>
            <br>

            <input type="password" class="text" name="password">
            <label for="password">Senha</label>
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
=======
<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
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
        <?php if (isset($_GET['erro']) == 'usuario'): ?>
            <script>
                Swal.fire({
                    title: 'Erro!',
                    text: 'Email e/ou senha incorretos!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            </script>
        <?php endif; ?>

        <a href="<?php echo $_ENV['URL_ROUTE'] . 'auth.login'; ?>">
            <h2 class="active" id="my-button" style="color:gray">
                Login
            </h2>
        </a>

        <a href="<?php echo $_ENV['URL_ROUTE'] . 'auth.cadastrar'; ?>">
            <h2 class="noactive" style="color:aliceblue">
                Criar conta
            </h2>
        </a>
        

        <form 
            method="POST" 
            action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Auth/LoginController.php"
        >
            <input type="email" class="text" name="email">
            <label for="email">Email</label>
            <br>

            <input type="password" class="text" name="password">
            <label for="password">Senha</label>
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
>>>>>>> 286a4901e05e7d84006a15f932d5b2227f5e0c7a
