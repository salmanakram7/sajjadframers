<?php

require_once('phpmailer/class.phpmailer.php');

$mail = new PHPMailer();


    if( $_POST['sq-contactform-name'] != '' AND $_POST['sq-contactform-email'] != '' AND $_POST['sq-contactform-message'] != '' ) {

        $name = $_POST['sq-contactform-name'];
        $email = $_POST['sq-contactform-email'];
        $message = $_POST['sq-contactform-message'];
        $subject = isset($subject) ? $subject : 'New email'; // Customize your subject
      
        $toemail = 'salmanakram7@gmail.com'; // Your Email Address
        $toname  = 'Squar Solutions'; // Your Name
       
        $botcheck = $_POST['sq-contactform-botcheck'];

        if( $botcheck == '' ) {

            $mail->SetFrom( $email , $name );
            $mail->AddReplyTo( $email , $name );
            $mail->AddAddress( $toemail , $toname );
            $mail->Subject = $subject;
            
            
            
            $name = isset($name) ? "Name: $name<br><br>" : '';
            $email = isset($email) ? "Email: $email<br><br>" : '';
            $message = isset($message) ? "Message: $message<br><br>" : '';
            $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';

            $body = "$name $email $message";

            $mail->MsgHTML( $body );
            $sendEmail = $mail->Send();

            if( $sendEmail == true ){
             
                
                  $output = json_encode(array('status'=>'true', 'message' => 'Email Sent'));
                  die($output);
                
                
            }else{
                
                  $output = json_encode(array('status'=>'false', 'message' => 'Error Email Not Sent'));
                  die($output);
                
          
            }
            
            
            
            
            
        } else {
            echo 'Bot <strong>Detected</strong>.! Clean yourself Botster.!';
        }
    } else {
        echo 'Please <strong>Fill up</strong> all the Fields and Try Again.';
    }


?>