<?php
// Função para enviar um e-mail de redefinição de senha
class EnviarEmail {

    public static function redefinicaoSenha($email, $token) {
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );

        // Destinatário
        $para = $email;

        // Assunto do e-mail
        $assunto = 'Redefinição de Senha';

        // Mensagem do e-mail
        $mensagem = '
            Olá,

            Você solicitou a redefinição de senha. Clique no link abaixo para criar uma nova senha:

            Link de Redefinição de Senha: http://localhost:8080/grease/usuario/redefinir_senha.php?token=' . $token;

        $enviador = 'gustavojs417@gmail.com';

        $cabecalhos =  
            "From: ". $enviador ."\r\n".
            "Reply-To: ".$para."\r\n".
            "X-Mailer: PHP/".phpversion();

        // Envie o e-mail
        $enviado = mail($para, $assunto, $mensagem, $cabecalhos);
        var_dump($enviado);

        // Verifique se o e-mail foi enviado com sucesso
        if ($enviado) {
            echo 'E-mail de redefinição de senha enviado com sucesso.';
        } else {
            echo 'Ocorreu um erro ao enviar o e-mail de redefinição de senha.';
        }
    }
}
