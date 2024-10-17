<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    require 'private/ini.php';

    $config = new Config();

    $set_msg = $config->select_config(1);

    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'csu.pairs@gmail.com';                     //SMTP username
        $mail->Password   = 'pyrt namx djxy qaqa';                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;        

        //Recipients
        $mail->setFrom('csu.pairs@gmail.com', 'PAIRS');
        $mail->addAddress('jefrey.mis@csu.edu.ph', 'John');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = $set_msg->message;
        
        $mail->send();
        echo "Email sent successfullly.";

    } catch (\Throwable $th) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }