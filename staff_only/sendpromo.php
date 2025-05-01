<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ('../vendor/autoload.php');
ob_start(); // Start output buffering

session_start();
include "connectdb.php";
if(isset($_GET['error'])){
    // Sanitize the message to prevent XSS
    $error = htmlspecialchars($_GET['error']);
    // Display a JavaScript alert with the message
    echo "<script>alert('$error');</script>";
}

if(isset($_GET['msg'])){
    // Sanitize the message to prevent XSS
    $msg = htmlspecialchars($_GET['msg']);
    // Display a JavaScript alert with the message
    echo "<script>alert('$msg');</script>";
}

if(!isset($_SESSION['User_ID'])){
    $msg = 'Must sign in again.';
    session_unset();
    session_destroy();
    header("Location: ../loginsystem/login.php?msg=".urlencode($msg));
    exit();
}

if(isset($_POST['presetfinish'])){
    //edit layout to accommodate preset form
    $layoutID = htmlspecialchars($_POST['layoutid']);

    $bodyStmt = "SELECT * FROM `layout` WHERE Layout_ID = :lid";
    $bodySQL = $pdo->prepare($bodyStmt);
    $bodySQL->bindParam(":lid", $layoutID, PDO::PARAM_INT);
    $bodySQL->execute();
    $bodyData = $bodySQL->fetch();

    //get form data
    $heading = htmlspecialchars($_POST['heading']);
    $title1 = htmlspecialchars($_POST['title1']);
    $title2 = htmlspecialchars($_POST['title2']);
    $title3 = htmlspecialchars($_POST['title3']);
    $title4 = htmlspecialchars($_POST['title4']);
    $title5 = htmlspecialchars($_POST['title5']);
    $title6 = htmlspecialchars($_POST['title6']);
    $subtitle1 = htmlspecialchars($_POST['subtitle1']);
    $subtitle2 = htmlspecialchars($_POST['subtitle2']);
    $subtitle3 = htmlspecialchars($_POST['subtitle3']);
    $subtitle4 = htmlspecialchars($_POST['subtitle4']);
    $subtitle5 = htmlspecialchars($_POST['subtitle5']);
    $subtitle6 = htmlspecialchars($_POST['subtitle6']);

    $body = $bodyData['Body'];

    //replace body template text i.e. !!TEMPLATE_TEXT!!
    $body = str_replace("!!HEADER!!", $heading, $body);
    $body = str_replace("!!EVENT TITLE 1!!", $title1, $body);
    $body = str_replace("!!EVENT TITLE 2!!", $title2, $body);
    $body = str_replace("!!EVENT TITLE 3!!", $title3, $body);
    $body = str_replace("!!EVENT TITLE 4!!", $title4, $body);
    $body = str_replace("!!EVENT TITLE 5!!", $title5, $body);
    $body = str_replace("!!EVENT TITLE 6!!", $title6, $body);
    $body = str_replace("!!EVENT SUBTITLE 1!!", $subtitle1, $body);
    $body = str_replace("!!EVENT SUBTITLE 2!!", $subtitle2, $body);
    $body = str_replace("!!EVENT SUBTITLE 3!!", $subtitle3, $body);
    $body = str_replace("!!EVENT SUBTITLE 4!!", $subtitle4, $body);
    $body = str_replace("!!EVENT SUBTITLE 5!!", $subtitle5, $body);
    $body = str_replace("!!EVENT SUBTITLE 6!!", $subtitle6, $body);

    //get images for embed implementation
    preg_match_all("/<img[^>]*src=['\"]([^'\"]+)['\"][^>]*alt=['\"]([^'\"]+)['\"][^>]*>/i", $body, $matches, PREG_SET_ORDER);

    try{
        $emailfrom = "marketing@womensconsortium.org.uk";
        $emailfromname = "WC Marketing";
        $emailfrompass = "jkYd[uPLmxg|";

        $title = "Promotion email test";
        $description = "Promo test";

        // $emailone = [];
        // $emailtonameone = [];

        // for ($i = 0; $i < count($emailArray); $i++) {
        //     $emailone[] = $emailArray[$i];
        //     $emailtonameone[] = $contactArray[$i];
        // }

        // foreach ($emailone as $index => $email) {
            // $emailto = $email;
            // $emailtoname = $emailtonameone[$index];
            $emailto = "adala738@gmail.com";
            $emailtoname = "Daniel Cox";

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
            foreach ($matches as $imgTag) {
                $srcPath = $imgTag[1];
                $altWithExt = $imgTag[2];
        
                $cidBase = preg_replace('/\.[a-zA-Z0-9]+$/', '', $altWithExt);
        
                $cid = preg_replace('/[^a-zA-Z0-9_-]/', '', $cidBase);

                $mail->addEmbeddedImage($srcPath, $cid);

                $body = str_replace($srcPath, "cid:$cid", $body);
                $body = str_replace($altWithExt, "$cid", $body);
            }

            echo $body;
            $mail->Body = $body;

            $mail->isHTML(true);

        //Replace the plain text body with one created manually
            $mail->AltBody = $description;

        //Attach an image file

            if(!$mail->send()) {
                error_log('Mailer Error: ' . $mail->ErrorInfo);
            }
        // }
        // unset($_SESSION['passgood']);
        // $msg = 'Email sent!';
        // header("Location: partners.php?msg=".urlencode($msg));
        // ob_end_clean(); // Clear output buffer
        // exit();
    } catch(Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}

?>