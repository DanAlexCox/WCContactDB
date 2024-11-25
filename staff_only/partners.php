<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require ('../../vendor/autoload.php');
include "connectdb.php";

?>

<html>
    <?php
    //check session data
    ?>
    <head>
        <title>Partners</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/partner.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>
        <?php
        
        //Tasks:
        //- Locate Partnership table
        //- View partnership table (later make specific permissions for specially authorized users)
            $stmt = "SELECT `partner_ID`, `partner_name` AS `Partner`, `representative` AS `Contact` FROM `partners` AS `Associates`";
            $query = $pdo->prepare($stmt);
            $query->execute();

            $rowset = array();

            echo "<form method='post' action='partners.php' class='emlptnr'><table class='ptnr'>";
            echo "<tr><th>Partner</th><th>Representative</th><th>Select</th></tr>";
            foreach($query as $row){
            //verify no dupes
            
            if(!in_array($row, $rowset)){
                echo "<tr>";
                echo "<td>".$row['Partner']."</td>";
                echo "<td>".$row['Contact']."</td>";
                echo "<td><input type='checkbox' class='checkbox' name='button[]' value='".$row['partner_ID']."'></td>";
                echo "</tr>";
                array_push($rowset, $row);
            }
            }
            echo "</table>";
            echo "<input type='submit' class='mkemlbtn' value='Contact'>";
            echo "</form>";

        //- Contact partners
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button'])) {
            echo "<div class='pcontact'>";
        
            // Display the email form
            echo "<form method='post' action='partners.php' class='sndeml'>";
            // Loop through selected checkboxes
            $buttons = array();
            foreach ($_POST['button'] as $partnerID) {
                echo "<input type='hidden' name='selected_partners[]' value='" . htmlspecialchars($partnerID) . "'>";
                array_push($buttons, $partnerID);
            }
            $buttonsString = implode(", ", $buttons);
            echo "<input type ='text' class = 'email' value = '".htmlspecialchars($buttonsString)."'>";

            echo "</form>";
            
            //Create a new PHPMailer instance
            try{
                $mail=new PHPMailer(true);
                $mail->CharSet = 'UTF-8';
            //Tell PHPMailer to use SMTP
                $mail->IsSMTP();

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
        
                // if(!$mail->send()) {
                //     echo 'Mailer Error: ' . $mail->ErrorInfo;
                // } else {
                //     echo 'Message sent!';
                //     //Section 2: IMAP
                //     //Uncomment these to save your message in the 'Sent Mail' folder.
                //     #if (save_mail($mail)) {
                //     #    echo "Message saved!";
                //     #}
                // }
            } catch(Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            echo "</div>";
        }
        //(all partner modifications can only be done with proper authorization)
        //- Add partner details
        //- Modify partner details
        //- Remove partner
        ?>


    </body>
</html>