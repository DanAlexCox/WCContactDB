<?php 
include('connectdb.php');
session_start();

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
<html>
    <head>
        <title>WC Login Page</title>
        <link rel="stylesheet" type="text/css" href="CSS/login.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
    </head>
    <body>
        <div id="login_body">
            <img src="CSS/images/logo.png" alt="logo">
            <h2>Login</h2>
            <?php 
            if(isset($error)) {
                echo "<p style='color:red;'>$error</p>";
            } 
            if(isset($success_message)){
                echo "<p style='color:green;'>$success_message</p>";
            }?> 
            <form class="login_form" action="login.php" method="post">
                <label for id="login_email">Email</label>
                <input type="email" id="login_email" name="Email" placeholder="Insert here" required></input><br>
                <label for id="login_pass">Password</label>
                <input type="password" id="login_pass" name="Password" placeholder="Insert here" required></input><br>
                <button type="submit" name="loginbtn">Login</input>
            </form>
            <?php
            //If correct email and password (OPTIONAL: opens up security question form and if thats correct...):
                
                if(isset($_POST['loginbtn'])) {
                    $emailSubmit = $_POST['Email'];
                    $passwordSubmit = $_POST['Password'];
                
                    $login_query = "SELECT * FROM `staff_user` WHERE Staff_email = :email";
                    $stmt = $pdo->prepare($login_query);
                    $stmt->bindParam(':email', $emailSubmit);
                    $stmt->execute();
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                    if($user) {
                        if(password_verify($passwordSubmit, $user['Password'])) {
                            //1. Add session data for username and userID
                            $_SESSION['username'] = $user['Username'];
                            $_SESSION['User_ID'] = $user['User_ID'];
                            $_SESSION['useremail'] = $user['Staff_email'];
                                header("Location: ../staff_only/staff_portal.php");
                                //If not correct password, add relevant error message
                            } else {
                                $error = 'Incorrect password. Please try again.';
                                echo "<script>alert($error);</script>";
                                header("Location: login.php?error=".$error);
                                exit();
                            }
                    } else {
                        //If not valid email, add relevant error message
                        $error = 'User not found. Please check your username.';
                        header("Location: login.php?error=".$error);
                        exit();
                    }
                }
            //Locks login screen attempts after 5 times for x period
            ?>
        </div>
    </body>

</html>