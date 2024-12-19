<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ('../vendor/autoload.php');
ob_start(); // Start output buffering

session_start();
include('connectdb.php');
//Create a new PHPMailer instance
if(isset($_POST['sndemlbtn'])) {
            try{

                $emailfrom = $_SESSION['useremail'];
                $emailfromname = $_SESSION['username'];
                $emailfrompass = $_SESSION['passgood'];

                $title = $_POST['title'];
                $description = $_POST['description'];

                $emailArray = explode(", ", $_POST['emails'][0]);
                $contactArray = explode(", ", $_POST['contacts'][0]);

                if (count($emailArray) !== count($contactArray)) {
                    die("Error: Emails and contacts count do not match.");
                }

                $emailone = [];
                $emailtonameone = [];

                for ($i = 0; $i < count($emailArray); $i++) {
                    $emailone[] = $emailArray[$i];
                    $emailtonameone[] = $contactArray[$i];
                }

                foreach ($emailone as $index => $email) {
                    $emailto = $email;
                    $emailtoname = $emailtonameone[$index];

                    $mail=new PHPMailer(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->IsSMTP();
                    $mail->Host = 'ams203.greengeeks.net';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->SMTPDebug = 0;
        
                    $mail->Username = $emailfrom;
                    $mail->Password   = $emailfrompass;
        
                //Do not use user-submitted addresses in here
                    $mail->setFrom($emailfrom, $emailfromname);
        
                //$mail->AddReplyTo('no-reply@mycomp.com','no-reply');
                    $mail->Subject = $title;
        
                // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        
                    $mail->AddAddress($emailto, $emailtoname);
                    $mail->Body = "<html>
                                        <body style='background-color: #add8e6; padding: 20px'>
                                            <img src='cid:wc-logo', alt='my-logo'>
                                            <div style='background-color: #ffffff; border: 1px solid rgb(0, 0, 0);'>"
                                                .$description.
                                            "</div>
                                        </body>
                                    </html>";
                    $mail->addEmbeddedImage('CSS/images/w-logo-blue.png', 'wc-logo');
        
                    $mail->isHTML(true);
        
                //Replace the plain text body with one created manually
                    $mail->AltBody = 'Description';
        
                //Attach an image file
        
                    if(!$mail->send()) {
                        error_log('Mailer Error: ' . $mail->ErrorInfo);
                    }
                }
                unset($_SESSION['passgood']);
                $msg = 'Email sent!';
                header("Location: partners.php?msg=".urlencode($msg));
                ob_end_clean(); // Clear output buffer
                exit();
            } catch(Exception $e) {
                error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            }
}   else{
    $error = "Invalid response.";
    header("Location: partners.php?error=".urlencode($error));
    ob_end_clean(); // Clear output buffer
    exit();
}

?>