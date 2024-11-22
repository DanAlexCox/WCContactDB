<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ('../../vendor/autoload.php');

try {
    //Create a new PHPMailer instance
$mail=new PHPMailer(true);
$mail->CharSet = 'UTF-8';

//Tell PHPMailer to use SMTP
$mail->IsSMTP();

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->Host = 'ams203.greengeeks.net';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPDebug = 2; // Set to 2 for detailed debug output, 0 for no output
$mail->Debugoutput = 'html'; // Output errors in a readable format

$mail->Username = 'daniel@womensconsortium.org.uk';
$mail->Password   = 'Dorothy2023:)';

//Do not use user-submitted addresses in here
$mail->setFrom('daniel@womensconsortium.org.uk', 'First Last');

//$mail->AddReplyTo('no-reply@mycomp.com','no-reply');
$mail->Subject    = 'PHPMailer gmail smtp test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

$mail->AddAddress('daniel@womensconsortium.org.uk', 'title1');
//$mail->AddAddress('abc2@gmail.com', 'title2'); /* ... */

$mail->Body = "Hello World";

$mail->isHTML(true);

//Replace the plain text body with one created manually
$mail->AltBody = 'Hello World part 2';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

if(!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
} catch(Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<html>
    <?php
    //check session data
    ?>
    <head>
        <title>Partners</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
    </head>
    <body>
        <?php
        //include "navbar.php";
        //Tasks:
        //- Locate Partnership table
        //- View partnership table (later make specific permissions for specially authorized users)
        //- Contact partners
        //(all partner modifications can only be done with proper authorization)
        //- Add partner details
        //- Modify partner details
        //- Remove partner
        ?>


    </body>
</html>