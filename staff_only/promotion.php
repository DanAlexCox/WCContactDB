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
?>
<html>
    <head>
        <title>Promotion</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/promotion.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
        <script src="JS/email.js" defer></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>
      <?php
      //Select between preset and customisable layout
      ?>
      <form method="post" action="promotion.php">
        <h2>Select an layout option</h2>
        <select>
            <option value="preset">Preset Layout</option>
            <option value="custom">Custom Layout</option>
        </select>
        <button type="submit">Proceed</button>
      </form>

      <?php
      //If promoselect="preset" Select from preset layouts
      include "promoemail.php";
      
      //If promoselect="custom"  open form list for all available valid customisations (logo, title, promonavbar etc.)
      // change css accordingly

      //Show preview for email
      //Confirm button, after confirmation, sends email to all
      ?>
        <!-- Send email to all clients (Until upload, send only to personal email) -->
        
    </body>
</html>