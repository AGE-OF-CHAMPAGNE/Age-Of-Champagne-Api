<?php

namespace App\PHPMailer;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    private $host;
    private $port;
    private $username;
    private $password;

    public function __construct($host = "smtp.gmail.com", $port = 587, $username = "gleb.bushukin@gmail.com", $password = "mrgleb221001")
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function sendEmail($recipient, $subject, $message)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $this->host;
        $mail->Port = $this->port;
        $mail->SMTPAuth = true;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->SMTPSecure = 'tls';

        $mail->setFrom($this->username);
        $mail->addAddress("bushukin.gleb@mail.ru");

        $mail->Subject = $subject;
        $mail->Body = $message;

        if (!$mail->send()) {
            throw new \Exception('Failed to send email: ' . $mail->ErrorInfo);
        }
    }

    
}