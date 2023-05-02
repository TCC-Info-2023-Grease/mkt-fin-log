<?php
# ------ Configurações Básicas
require dirname(dirname(dirname(__DIR__))) . '/config.php';
global $_ENV;

import_utils([ 'use_js_scripts', 'extend_styles', 'render_component', 'navegate' ]);

// Verifica se a variável de sessão 'ultimo_acesso' já existe
if(isset($_SESSION['ultimo_acesso'])) {
  $ultimo_acesso = $_SESSION['ultimo_acesso'];
  
  // Verifica se já passaram 5 minutos desde o último acesso
  if(time() - $ultimo_acesso > 100) {
    unset($_SESSION['fed_cadastro_usuario']);
  }
} 

if (isset($_SESSION['usuario'])) {
    navegate($_ENV['URL_VIEWS']. '/visitante/home.php');
}
?>


<!------- HEAD --------->
<?php
render_component('head');
extend_styles([ 'styles' ]);
use_js_scripts([ 'inputmask', 'masksForInputs', 'vw_cadastrar_usuario' ], $_ENV['LIST_SCRIPTS']);
?>
<title>
    Cadastrar 🤗 Grease
</title>

<script 
    type="module"
    src="<?php echo assets('js/', 'forms/FormCadastroUsuario.js'); ?>">
</script>
<!-------/ HEAD --------->


<!------- BODY --------->
<body>
    <a href="<?php echo $_ENV['URL_BASE']; ?>" class="btn-voltar">
        Voltar
    </a>
    <div class="login">

        <?php if (isset($_SESSION['fed_cadastro_usuario']) && !empty($_SESSION['fed_cadastro_usuario'])): ?>
            <script>
                Swal.fire({
                    title: '<?php echo $_SESSION['fed_cadastro_usuario']['title']; ?>',
                    text: '<?php echo $_SESSION['fed_cadastro_usuario']['msg']; ?>',
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
            action="<?php echo $_ENV['URL_CONTROLLERS']; ?>/Auth/CadastroController.php">

            <label for="tipo-usuario">Usuario</label>
            <select name="tipo_usuario" id="tipo-usuario-select">
                <option value="vis">
                    Visitante
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
                <option value="adm">
                    Admin
                </option>
            </select> 

            <input 
                type="text" 
                required 
                class="text" 
                name="username" 
                placeholder="Stefano Jobs" />
            <label for="username">
                Nome
            </label>
            <label id="lblErroNome">
            </label>
            <br>
            <br>

            <input 
                type="password" 
                required class="text" 
                name="password" />
            <label for="password">
                Senha
            </label>
            <br>
            <br><br>
            <br>
            <label id="lblErroSenha">
            </label>
            <br>

            <input type="email" required class="text" name="email">
            <label for="email">Email</label>
            <label id="lblErroEmail"></label>
            <br>
            <br>

            <input 
                type="text" 
                required 
                class="text phone" 
                name="phone"
                placeholder="(11) 90235-9078" />
            <label for="phone">
                Celular
            </label>
            <label id="lblErroCelular">
            </label>
            <br>
            <br>

            <input type="number" required class="text" name="age">
            <label for="age">Idade</label>
            <label id="lblErroCpf"></label>
            <br>
            <br>
            <br>
            <br><br><br>

            <label for="genrer">Gênero</label>
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
            <br>
            <br>

            <label for="cpf" style="display: none;">CPF</label>
            <input type="text" class="text" name="cpf" style="display: none;" />
            <label id="lblErroCpf"></label>
            <br>
            <br>    
            <br>
            <br>    

            <label for="profile_picture" style="display: none;">Foto Perfil</label>
            <input type="file" class="text" name="profile_picture" style="display: none;" />
            <br>
            <br>

            <button class="signin" id="btn-register">
                Criar Conta
            </button>

            <span for="checkbox-1-1">Ao se cadastrar você concorda com os termos de uso.</span>
            <hr>
            <a class="teste" href="#">Termos de uso</a>
        </form>
    </div>
</body>
<!------- /BODY --------->