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
                    $mail->Body = "
                                    <html>
                                        <body style='font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 30px; margin: 0;'>
                                        <table align='center' width='600px' cellpadding='0' cellspacing='0' style='background-color: #ffffff;
                                                    border: 1px solid #dddddd; border-radius: 8px; overflow: hidden;'>
                                        <tr>
                                            <td style='text-align: center; padding: 20px; background-color: #004080; color: #ffffff;'>
                                            <div style='display: inline-block; padding: 20px; border-radius: 50%; 
                                                        background: radial-gradient(circle, #ffffff 70%, rgba(244, 244, 249, 0.6) 100%);'>
                                                <img src='cid:wc-logo' alt='Company Logo' style='max-width: 150px; background-color: #ffffff;'>
                                            </div>
                                                <h1 style='margin: 0; font-size: 20px;'>Women's Consortium</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style='padding: 20px; color: #333333; font-size: 14px; line-height: 1.6;'>
                                                <p style='margin: 0;'>Dear $emailtoname,</p>
                                                <br>
                                                <p>$description</p>
                                                <br>
                                                <p style='margin: 0;'>Best regards,</p>
                                                <p style='margin: 0;'><strong>$emailfromname</strong></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style='text-align: left; padding: 20px; font-size: 12px; color: #666666; line-height: 1.5;'>
                                                <hr style='border: none; border-top: 1px solid #dddddd; margin: 20px 0;'>
                                                <p style='font-weight: bold;'>Women's Consortium | London & Birmingham Office</p>
                                                <p>
                                                    <strong>Tel:</strong> 0300 102 1543 / 0843 88 66 771 | 
                                                    <strong>Mob:</strong> 07477 859 626 | 
                                                    <strong>Fax:</strong> 0844 357 2177
                                                </p>
                                                <p><strong>Email:</strong> $emailfrom</p>
                                                <p>
                                                    <a href='https://womensconsortium.org.uk/' style='text-decoration: none; color: #007bff;'>Website</a> |
                                                    <a href='https://www.facebook.com/womensconsortium.org.uk/' style='text-decoration: none; color: #007bff;'>Facebook</a> |
                                                    <a href='https://x.com/womenconsortium' style='text-decoration: none; color: #007bff;'>Twitter</a> |
                                                    <a href='https://www.instagram.com/womensconsortium/' style='text-decoration: none; color: #007bff;'>Instagram</a> |
                                                    <a href='https://www.linkedin.com/groups/3920244/' style='text-decoration: none; color: #007bff;'>LinkedIn</a>
                                                </p>
                                                <br>
                                                <p>Please Donate to Women's Consortium | 
                                                    <a href='https://www.totalgiving.co.uk/charity/womens-consortium' style='text-decoration: none; color: #007bff;'>
                                                        www.totalgiving.co.uk/charity/womens-consortium
                                                    </a>
                                                </p>
                                                <p>
                                                    Registered Charity Number 1159014 | Company Registration number: 06954256 (Cardiff)
                                                </p>
                                                <p>Member of BACP (British Association for Counselling & Psychotherapy)</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style='text-align: center; padding: 15px; background-color: #f4f4f9; font-size: 12px; color: #888888;'>
                                                <p style='margin: 0;'>This is an automated email. Please do not reply directly.</p>
                                            </td>
                                        </tr>
                                        </table>
                                        </body>
                                    </html>";
                    $mail->addEmbeddedImage('CSS/images/logo.png', 'wc-logo');
        
                    $mail->isHTML(true);
        
                //Replace the plain text body with one created manually
                    $mail->AltBody = $description;
        
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