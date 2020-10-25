<?php
    use PHPMailer\PHPMailer\PHPMailer;
    $error = NULL;

    if(isset($_POST['submit']))
    {
        $con = mysqli_connect('bxh4dwfceuoiprsc0heb-mysql.services.clever-cloud.com', 'u1exqv0w4ilg7eep', 'hxQbTSldOIX8Kq9VPsJw', 'bxh4dwfceuoiprsc0heb');
        $u = $con->real_escape_string($_POST['u']);
        $em = $con->real_escape_string($_POST['e']);
        $m = $con->real_escape_string($_POST['m']);

        require_once "../../sqlconnect/PHPMailer/PHPMailer.php";
        require_once "../../sqlconnect/PHPMailer/SMTP.php";
        require_once "../../sqlconnect/PHPMailer/Exception.php";
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
            $mail->setFrom($em, $u);
            $signature = "<p>--</p><p>Thank you,</p><p><span style='font-family:'impact','chicago';font-size:24px;line-height:normal;''>XRClass Support</span></p><p><a href='mailto:support@xrclass.ml' rel='noopener noreferrer' target='_blank'><span style='font-size:12px;'><u>support@xrclass.ml</u></span></a></p><p><span style='font-size:12px;'>Please visit <u>&nbsp;<a href='http://xrclass.ml/FAQ' rel='noopener noreferrer' target='_blank'>xrclass.ml/FAQ</a></u> for more information about solutions to common problems.</span></p>";
            //$mail->addAddress('xrinclass@gmail.com');             // Name is optional
            $mail->addReplyTo("xrinclass@gmail.com", "XR Class Support");
            //$mail->addCC('cc@example.com');
            $mail->addBCC('hb22holla@gmail.com');
        
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
                                          // Set email format to HTML
            $mail->Subject = "XR Class Support Ticket Request";
            $mail->Body    = "<p>Hello $u, \nXR Class Support will be getting back to you shortly.\n $m $signature<p>";
            $mail->isHTML(true);    
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();

            //confirm mail

            $nmail = new PHPMailer();
            $nmail->isSMTP();                                            // Send using SMTP
            $nmail->Host       = 'smtp.yandex.com';//'smtp.gmail.com';                    // Set the SMTP server to send through
            $nmail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $nmail->Username   = 'support@xrclass.ml';//'support@xrclass.ml';                     // SMTP username
            $nmail->Password   = 'Houseman9';                               // SMTP password
            $nmail->SMTPSecure = "ssl";//PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $nmail->Port       = 465;  
            $nmail->SMTPOptions = array (
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' =>true
                )
            );                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $nmail->setFrom('support@xrclass.ml', "XR Class Support");
            //$mail->addAddress('xrinclass@gmail.com');     // Add a recipient
            //$nmail->addAddress("xrinclass@gmail.com");
            $nmail->addAddress($em);                // Name is optional
            //$nmail->addReplyTo('support@xrclass.ml', "XR Class Support");
            //$mail->addCC('cc@example.com');
            $nmail->addBCC('hb22holla@gmail.com');
        
            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            $nmail->isHTML(true);                                  // Set email format to HTML
            $nmail->Subject = "XR Support Ticket Request";
            $nmail->Body    = "<p>Hello $u,\nXR Class Support will be getting back to you shortly about:\n $m $signature<p>";
            $nmail->send();
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "INVALID EMAIL";//"A: Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            exit();
        }
        echo "Your Contact Request has been sent to XR Class Support!\n<a href='https://xrclass.ml'>Return to Main Page</a>";
    }
    else{
        echo "Email never sent";
    }
    exit();
    
?>