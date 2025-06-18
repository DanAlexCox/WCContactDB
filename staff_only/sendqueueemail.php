<?php
include "connectdb.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/../vendor/autoload.php';

//Select the latest 200 emails queued to be sent
$queueStmt = "SELECT `emailqueue`.*, `clients`.Email FROM `emailqueue`
                INNER JOIN `clients` ON `clients`.Client_ID = `emailqueue`.Client_ID
                WHERE EmailStatus_ID = 1 LIMIT 200";
$queueSQL = $pdo->query($queueStmt);
$queueSQL->execute();
//foreach loop sending to queued email addresses
foreach($queueSQL as $entry){
    $queueID = $entry['Queue_ID'];
    $emailto = $entry['Email'];
    $emailtoname = $entry['Email'];
    $emailfrom = "marketing@womensconsortium.org.uk";
    $emailfromname = "WC Marketing";
    $emailfrompass = "jkYd[uPLmxg|";
    $title = $entry['Subject'];

    $mail=new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();
    $mail->Host = 'ams203.greengeeks.net';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;

    $mail->Username = $emailfrom;
    $mail->Password = $emailfrompass;

    $mail->setFrom($emailfrom, $emailfromname);

    $mail->Subject = $title;
    if(is_file("uploads/".$entry['Body']) && getimagesize("uploads/".$entry['Body'])){
        $uploadNam = $entry['Body'];
        $uploadFile = 'uploads/'.$entry['Body'];
        $description = $uploadNam;
        $body = "<div id='emailbody'>
                    <img src='cid:$uploadNam' alt='Poster Image' style='max-width: 70%;'>
                </div>";
        $mail->addEmbeddedImage($uploadFile, $uploadNam);
    } else{
        $description = $entry['Body'];
        $body = $description;
    }
    $mail->AddAddress($emailto, $emailtoname);
    
    $mail->Body = $body;
    $mail->isHTML(true);
    $mail->AltBody = $description;

    if(!$mail->send()) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
    } else{
        $updateQueueStmt = "UPDATE `emailqueue` SET EmailStatus_ID = 2 WHERE Queue_ID = $queueID";
        $updateQueueSQL = $pdo->query($updateQueueStmt);
        $updateQueueSQL->execute();
    }
    usleep(100000);
}
?>