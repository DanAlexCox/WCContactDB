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
//Test with first queue id
// $queueStmt = "SELECT `emailqueue`.*, `clients`.Email FROM `emailqueue`
//                 INNER JOIN `clients` ON `clients`.Client_ID = `emailqueue`.Client_ID
//                 WHERE EmailStatus_ID = 1 LIMIT 6";
$queueSQL = $pdo->prepare($queueStmt);
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

    if(empty($emailto) || !filter_var($emailto, FILTER_VALIDATE_EMAIL)){
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        $updateQueueStmt = "UPDATE `emailqueue` SET EmailStatus_ID = 4 WHERE Queue_ID = $queueID";
        $updateQueueSQL = $pdo->query($updateQueueStmt);
        $updateQueueSQL->execute();
        continue;
    }

    try{
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

        $uploadDir = __DIR__ . '/uploads/';
        $uploadNam = $entry['Body'];
        $uploadFile = $uploadDir . $uploadNam;
        if(is_file($uploadFile) && getimagesize($uploadFile)){
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
        $mail->send();

        $updateQueueStmt = "UPDATE `emailqueue` SET EmailStatus_ID = 2 WHERE Queue_ID = $queueID";
        $updateQueueSQL = $pdo->query($updateQueueStmt);
        $updateQueueSQL->execute();
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $e->getMessage());
        $updateQueueStmt = "UPDATE `emailqueue` SET EmailStatus_ID = 3 WHERE Queue_ID = $queueID";
        $updateQueueSQL = $pdo->query($updateQueueStmt);
        $updateQueueSQL->execute();
    }
    usleep(100000);
}
?>