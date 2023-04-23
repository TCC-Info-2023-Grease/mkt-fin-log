<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils([ 'use_js_scripts', 'extend_styles', 'render_component' ]);
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'styles' ]);
use_js_scripts([ 'inputmask', 'masksForInputs', 'vw_cadastrar' ], $_ENV['LIST_SCRIPTS']);
?>

<title>
    Cadastrar 🤗 Grease
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

        <a href="<?php echo $_ENV['URL_ROUTE'] . 'auth.cadastrar'; ?>">
            <h2 class="active" style="color:aliceblue">
                Criar conta
            </h2>
        </a>
        <a href="<?php echo $_ENV['URL_ROUTE'] . 'auth.login'; ?>">
            <h2 class="nonactive" id="my-button" style="color:gray">
                Login
            </h2>
        </a>

        <form 
            method="POST" 
            action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Auth/CadastroController.php"
        >
            <input type="text" class="text" name="username">
            <label for="username">Nome</label>
            <br>
            <br>

            <input type="password" class="text" name="password">
            <label for="password">Senha</label>
            <br>

            <input type="email" class="text" name="email">
            <label for="email">Email</label>
            <br>
            <br>

            <input 
                type="text" 
                class="text phone" 
                name="phone"
                placeholder="(11) - 90235-9078"
            />
            <label for="phone">Celular</label>
            <br>
            <br>

            <input type="number" class="text" name="age">
            <label for="age">Idade</label>
            <br>
            <br>

            <label for="genrer-select">Gênero</label>
            <select name="genrer" name="genrer-select" id="genrer-select">
                <option value="m">
                    Masculino
                </option>
                <option value="f">
                    Feminino
                </option>
                <option value="o">
                    Outro
                </option>
                <option value="n">
                    Prefiro não informar
                </option>
            </select>
                
            <br>
            <br>

            <label for="tipo-usuario-select">Usuario</label>
            <select name="genrer" id="tipo-usuario-select">
                <option value="vis">
                    Visitante
                </option>
                <option value="adm">
                    Admin
                </option>
                <option value="fig">
                    Figurino   
                </option>
                <option value="cen">
                    Cénario
                </option>
                <option value="enc">
                    Encenação
                </option>
            </select> 

            <br>
            <br>

            <label for="checkbox-1-1">Ao se cadastrar você concorda com os termos de uso.</label>

            <input type="text" class="text" name="cpf" style="display: none;" />
            <label for="cpf" style="display: none;">CPF</label>
            <br>
            <br>    

            <input type="file" class="text" name="profile_picture" style="display: none;" />
            <label for="profile_picture" style="display: none;">Foto Perfil</label>
            <br>
            <br>


            <button class="signin">
                Criar Conta
            </button>

            <hr>
            <a class="teste" href="#">Termos de uso</a>
        </form>
    </div>
</body>
<!------- /BODY --------->