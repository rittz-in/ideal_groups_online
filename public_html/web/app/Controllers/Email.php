<?php
namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email extends BaseController {

    public function __construct() {

    }

    public function send_email() {

        $email          = $this->request->getPost('email');
        $subject        = $this->request->getPost('subject');
        $message        = $this->request->getPost('message');

        $mail = new PHPMailer(true);
        try {

            $mail->isSMTP();
            $mail->Host         = 'smtp.google.com'; // host
            $mail->SMTPAuth     = true;
            $mail->Username     = 'dev.decentinfoways@gmail.com';
            $mail->Password     = 'etkixjxnqhmecduf';
            $mail->SMTPSecure   = 'tls';
            $mail->Port         = 587;
            $mail->Subject      = $subject;
            $mail->Body         = $message;
            $mail->setFrom('username', 'display_name');

            $mail->addAddress('dev.decentinfoways@gmail.com');
            $mail->isHTML(true);

            if(!$mail->send()) {
                echo "Something went wrong. Please try again.";
            }
            else {
                echo "Email sent successfully.";
            }

        } catch (Exception $e) {
            echo "Something went wrong. Please try again.";
        }

    }

}