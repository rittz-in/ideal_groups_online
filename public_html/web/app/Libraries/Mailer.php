<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public static function send($subject, $message, $email)
    {
        $email = $this->request->getPost('email');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.newfaithfgfc.org';
            /*smtp . google . com*/
            $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;
            $mail->SMTPAuth = true;
            $mail->Username = 'info@newfaithfgfc.org';
            $mail->Password = 'PX^^tV-Q[P%a';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->setFrom('info@newfaithfgfc.org', 'NEW FAITH FULL GOSPEL FELLOWSHIP CENTER');
            $mail->addAddress($email);
            $mail->isHTML(true);
            echo 'SENDING';
            if (!$mail->send()) {
                echo "Something went wrong. Please try again.";
            } else {
                echo "Email sent successfully.";
            }        } catch (Exception $e) {
            echo "Something went wrong. Please try again." . $e;
        }
    }
}