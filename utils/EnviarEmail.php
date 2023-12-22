<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/**
 * Class EnviarEmail
 *
 * This class sends an email to reset the password.
 *
 * @since 2023-11-08
 * @author MrNullus <gustavojs417@gmail.com>
 */
class EnviarEmail
{
    /**
     * Sends an email to reset the password.
     *
     * @param string $email The email address to send the email to.
     * @param string $token The token to use to reset the password.
     *
     * @return void
     */
    public static function redefinicaoSenha($email, $token): void
    {
        $mail = new PHPMailer(true);

        try {
            // Server Settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->CharSet = 'UTF-8'; // Set character encoding

            $mail->Host = 'sandbox.smtp.mailtrap.io'; // Specify main and backup SMTP servers
            $mail->Port = 2525; // Set the SMTP port
            $mail->Username = '5b8fc83059e548'; // SMTP username
            $mail->Password = 'c8c91e82e2d89e'; // SMTP password

            // Recipients
            $mail->setFrom('call.grease@gmail.com', 'Atendimento'); // Set who the email is from
            $mail->addAddress($email, 'Lá Ele'); // Set who the email is to

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Redefinição de Senha'; // Set email subject
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
            '; // Set email body
            $mail->AltBody = 'Prezado(a) solitação de redefinição de senha'; // Set alternative email body for non-HTML mail clients

            $mail->send(); // Send the email
        } catch (Exception $error) {
            echo "Mailer Error: $mail->ErrorInfo"; // Print the error message
        }
        return;
    }
}
