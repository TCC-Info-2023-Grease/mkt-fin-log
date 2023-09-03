<?php
// Função para enviar um e-mail de redefinição de senha
class EnviarEmail {

    public static function redefinicaoSenha($email, $token) {
        // Destinatário
        $para = $email;

        // Assunto do e-mail
        $assunto = 'Redefinição de Senha';

        // Mensagem do e-mail
        $mensagem = '
            Olá,

            Você solicitou a redefinição de senha. Clique no link abaixo para criar uma nova senha:

            Link de Redefinição de Senha: http://localhost:8080/grease/usuario/redefinir_senha.php?token=' . $token;

        $cabecalhos = 'From: grease.musical@gmail.com' . "\r\n" .
            'Reply-To: grease.musical@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Envie o e-mail
        $enviado = mail($para, $assunto, $mensagem, $cabecalhos);

        // Verifique se o e-mail foi enviado com sucesso
        if ($enviado) {
            echo 'E-mail de redefinição de senha enviado com sucesso.';
        } else {
            echo 'Ocorreu um erro ao enviar o e-mail de redefinição de senha.';
        }
    }
}
