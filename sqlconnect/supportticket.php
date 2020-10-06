<?php
    use PHPMailer\PHPMailer\PHPMailer;
    $error = NULL;

    if(isset($_POST['submit']))
    {
        $con = mysqli_connect('bxh4dwfceuoiprsc0heb-mysql.services.clever-cloud.com', 'u1exqv0w4ilg7eep', 'hxQbTSldOIX8Kq9VPsJw', 'bxh4dwfceuoiprsc0heb');
        $u = $con->real_escape_string($_POST['u']);
        $e = $con->real_escape_string($_POST['e']);
        $m = $con->real_escape_string($_POST['m']);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail = new PHPMailer();
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';//'smtp.yandex.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'xrinclass@gmail.com';//'support@xrclass.ml';                     // SMTP username
            $mail->Password   = 'Houseman1';                               // SMTP password
            $mail->SMTPSecure = "ssl";//PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;  
            $mail->SMTPOptions = array (
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' =>true
                )
            );                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom($e, $u);
            //$mail->addAddress('xrinclass@gmail.com');     // Add a recipient
            $mail->addAddress("xrinclass@gmail.com");               // Name is optional
            $mail->addReplyTo($e, $u);
            //$mail->addCC('cc@example.com');
            $mail->addBCC('hb22holla@gmail.com');
        
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "XR Support Ticket Request";
            $mail->Body    = $m;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();

            //confirm mail

            $mail = new PHPMailer();
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';//'smtp.yandex.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'xrinclass@gmail.com';//'support@xrclass.ml';                     // SMTP username
            $mail->Password   = 'Houseman1';                               // SMTP password
            $mail->SMTPSecure = "ssl";//PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;  
            $mail->SMTPOptions = array (
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' =>true
                )
            );                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom($e, $u);
            //$mail->addAddress('xrinclass@gmail.com');     // Add a recipient
            $mail->addAddress("xrinclass@gmail.com");               // Name is optional
            $mail->addReplyTo($e, $u);
            //$mail->addCC('cc@example.com');
            $mail->addBCC('hb22holla@gmail.com');
        
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = "XR Support Ticket Request";
            $mail->Body    = $m;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "INVALID EMAIL";//"A: Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            exit();
        }
        echo "Email has been sent";
    }
    
?>