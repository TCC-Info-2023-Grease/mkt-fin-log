<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Função para enviar um e-mail de redefinição de senha
class EnviarEmail {

    public static function redefinicaoSenha($email, $token) {

        $mail = new PHPMailer(true);

        try {
            $mail = new PHPMailer();

            // Server Settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSegure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->CharSet = 'UTF-8';

            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->Port = 2525;
            $mail->Username = '5b8fc83059e548';
            $mail->Password = 'c8c91e82e2d89e';


            // Recipients
            $mail->setFrom('call.grease@gmail.com', 'Atendimento');
            $mail->addAddress($email, 'Lá Ele');    


            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Redefinição de Senha';
            $mail->Body    = '
                Olá,
                <br><br>

                Você solicitou a redefinição de senha. Clique no link abaixo ou cole no navegador para criar uma nova senha:
                <br><br>

                Link de Redefinição de Senha: 
                    <a href="'. $_ENV['VIEWS'] .'/auth/redefinir_senha.php?token=' . $token.'">'
                        . $_ENV['VIEWS'] .'/auth/redefinir_senha.php?token=' . $token.'
                    </a>
                <br><br>

                Senão solicitou não responda, a senha continuara a mesma
                <br><br>

                Gestão Grease
            ';
            $mail->AltBody = 'Prezado(a) solitação de redefinição de senha';

            $mail->send();
        } catch (Exception $error) {
            echo "Mailer Error: $mail->ErrorInfo";  
        }
        return;
    }
}
