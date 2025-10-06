<?php
    $email = "ionaskapralos@gmail.com";
    $recipient_name = "Ion01";
     $message = " we have been trying to reach you about you cars extended warranty";

    require("PHPMailer/PHPMailerAutoload.php");

    $mail = new PHPMailer();

    $mail->CharSet = "utf-8";
    $mail->IsSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "mail.example.com";  // Specify main and backup server
    $mail->SMTPAuth = true;     // Turn on SMTP authentication
    $mail->Username = "myusername";  // SMTP username
    $mail->Password = "p@ssw0rd"; // SMTP password

    $mail->From = "me@walalang.com";
    $mail->FromName = "System-Ad";
    $mail->AddAddress($email, $recipient_name);

    $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    $mail->IsHTML(true);                                  // Set email format to HTML (true) or plain text (false)

    $mail->Subject = "This is a Sampleenter code here Email";
    $mail->Body    = $message;
    $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    $mail->AddEmbeddedImage('images/logo.png', 'logo', 'logo.png');
    $mail->addAttachment('files/file.xlsx');

    if(!$mail->Send())
    {
       echo "Message could not be sent. <p>";
       echo "Mailer Error: " . $mail->ErrorInfo;
       exit;
    }

    echo "Message has been sent";
?>