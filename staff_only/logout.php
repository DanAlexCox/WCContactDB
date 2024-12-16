<?php
session_start();

if(isset($_GET['error'])){
    // Sanitize the message to prevent XSS
    $error = htmlspecialchars($_GET['error']);
    // Display a JavaScript alert with the message
    echo "<script>alert('$error');</script>";
}

if (isset($_GET['msg'])) {
    // Sanitize the message
    if ($_GET['msg'] === 'SuccessfullyLoggedOut') {
        $msg = "Successfully Logged Out.";
    } else {
        $msg = htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8'); // Sanitize for HTML
    }

    // Use json_encode to safely escape the message for JavaScript
    $safe_msg = json_encode($msg);

    // Display a JavaScript alert with the sanitized message
    echo "<script>alert($safe_msg);</script>";
}

session_unset();
session_destroy();
header("Location: ../loginsystem/login.php?msg=".$msg);
?>