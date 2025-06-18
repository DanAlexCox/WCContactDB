<?php
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

//Check privilege for User_ID in staff_user is "VCM"
$uid = $_SESSION['User_ID'];
$checkUser = "SELECT Privilege FROM `staff_user` WHERE User_ID = :uid";
$checkUserSQL = $pdo->prepare($checkUser);
$checkUserSQL->bindParam(":uid", $uid, PDO::PARAM_INT);
$checkUserSQL->execute();
$access = $checkUserSQL->fetch();
if(!$access['Privilege'] == "VCM"){
    $error = htmlspecialchars("Not got correct permission to view current page.");
    header("Location: staff_portal.php?error=".$error);
    exit();
} 

?>
<html>
    <head>
        <title>Email Queue</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/emails.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
        <script src="JS/email.js" defer></script>
    </head>
    
    <body>
        <?php
        include "navbar.php";
        ?>
        <div id="queuebody">
            <h1>Email Queue</h1>
            <form method="post" action="emails.php">
                <table>
                    <thead><tr><th>Queue ID</th><th>Subject</th><th>Client</th><th>Added Date</th><th>Status</th></tr></thead>
                <?php
                //Table to view pending emails with option to delete
                $queueStmt = "SELECT `emailqueue`.*, `clts`.Email AS 'Client', `emst`.StatusName AS 'Status' FROM `emailqueue`
                                INNER JOIN (SELECT Client_ID, Email FROM `clients`) AS `clts`
                                    ON `clts`.Client_ID = `emailqueue`.Client_ID
                                INNER JOIN (SELECT EmailStatus_ID, StatusName FROM `emailstatus`) AS `emst`
                                    ON `emst`.EmailStatus_ID = `emailqueue`.EmailStatus_ID";
                $queueSQL = $pdo->query($queueStmt);
                $queueSQL->execute();
                foreach($queueSQL as $queueEntry){
                    ?>
                    <tr>
                        <td><?php echo $queueEntry['Queue_ID']; ?></td>
                        <td><?php echo $queueEntry['Subject']; ?></td>
                        <td><?php echo $queueEntry['Client']; ?></td>
                        <td><?php echo $queueEntry['Created_at']; ?></td>
                        <td><?php echo $queueEntry['Status']; ?></td>
                    </tr>
                    <?php
                }
            ?>
                </table>
            </form>
        </div>