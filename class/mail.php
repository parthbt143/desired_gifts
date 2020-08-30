<?php

require 'mail/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function send_mail($receiver_email, $name, $subject, $msg) {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com'; 

        $mail->SMTPAuth = true;
        $mail->Username = get_setting('send_mail_from');                 // SMTP username
        $mail->Password = get_setting('send_mail_from_password');
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        // $mail->SMTPOptions = array(
        //     'ssl' => array(
        //         'verify_peer' => false,
        //         'verify_peer_name' => false,
        //         'allow_self_signed' => true
        //     )
        // );
        $mail->setFrom(get_setting('send_mail_from'), get_setting('project_name'));
        $mail->addAddress($receiver_email, $name);     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = " $subject ";
        $mail->Body = " $msg ";
        // $mail->AltBody = " $msg ";
        $mail->send();
        return 1;
    } catch (Exception $e) {
        
    }
}
