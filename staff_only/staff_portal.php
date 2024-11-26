<html>
    <?php
    //check session data
    session_start();
    if(!isset($_SESSION['User_ID'])){
        session_destroy();
        header("Location: ../loginsystem/login.php");
        exit();
    }

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
    
    ?>
    <head>
        <?php
        echo "<title> Welcome ".$_SESSION['username']."</title>";
        ?>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
    </head>
    <body>
        <?php
        include "navbar.php";
        ?>

<form method="post" action="registeruser.php">
            <h2>Create User</h2>
            <input type="email" placeholder="Email Address" name="new_email" required><br><br>
            <input type="text" placeholder="Username" name="new_username" required><br><br>
            <input type="password" placeholder="Password" name="new_password" required><br><br>
            <button type="submit" name="registerbtn">Create</button>
        </form>

    </body>
</html>