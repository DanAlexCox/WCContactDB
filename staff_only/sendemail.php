<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ('../../vendor/autoload.php');

session_start();
include('connectdb.php');
//Create a new PHPMailer instance
if(isset($_POST['sndemlbtn'])) {
            try{

                $emailfrom = $_SESSION['useremail'];
                $emailfromname = $_SESSION['username'];
                $emailfrompass = "Dorothy2023:)";   //change later to verify password

                $title = $_POST['title'];
                $description = $_POST['description'];

                if (count($_POST['emails']) !== count($_POST['contacts'])) {
                    die("Error: Emails and contacts count do not match.");
                }

                $emailone = [];
                $emailtonameone = [];

                for ($i = 0; $i < count($_POST['emails']); $i++) {
                    $emailone[] = $_POST['emails'][$i];
                    $emailtonameone[] = $_POST['contacts'][$i];
                }

                foreach ($emailone as $index => $email) {
                    $emailto = $email;
                    $emailtoname = str_replace(",", "", $emailtonameone[$index]);

                    echo "Email: " . $emailto . " is linked to Contact: " . $emailtoname . "<br>";

                    $mail=new PHPMailer(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->IsSMTP();
                    $mail->Host = 'ams203.greengeeks.net';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->SMTPDebug = 2;
                    $mail->Debugoutput = 'html';
        
                    $mail->Username = $emailfrom;
                    $mail->Password   = $emailfrompass;
        
                //Do not use user-submitted addresses in here
                    $mail->setFrom($emailfrom, $emailfromname);
        
                //$mail->AddReplyTo('no-reply@mycomp.com','no-reply');
                    $mail->Subject = $title;
        
                // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        
                    $mail->AddAddress($emailto, $emailtoname);
                    $mail->Body = $description;
        
                    $mail->isHTML(true);
        
                //Replace the plain text body with one created manually
                    $mail->AltBody = 'Description';
        
                //Attach an image file
                    //$mail->addAttachment('images/phpmailer_mini.png');
        
                    if(!$mail->send()) {
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        $msg = 'Email sent!';
                        header("Location: partners.php?msg=".$msg);
                        exit();
                        //Section 2: IMAP
                        //Uncomment these to save your message in the 'Sent Mail' folder.
                        #if (save_mail($mail)) {
                        #    echo "Message saved!";
                        #}
                    }
                }
            } catch(Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";
}   else{
    $error = "Invalid response.";
    header("Location: partners.php?error=".$error);
    exit();
}

?>