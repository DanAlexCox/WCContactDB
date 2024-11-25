<html>
    <?php
    //check session data
    session_start();
    if(!isset($_SESSION['User_ID'])){
        session_destroy();
        header("Location: ../loginsystem/login.php");
        exit();
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
    </body>
</html>