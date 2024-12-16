<html>
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
    <head>
        <?php
        echo "<title> Welcome ".$_SESSION['username']."</title>";
        ?>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
    </head>
    <body>
        <?php
        include "navbar.php";

        $userID = htmlspecialchars($_SESSION['User_ID']);

        $permcontstmt = "SELECT Privilege FROM `staff_user` WHERE User_ID = :usid";

        $permcontsql = $pdo->prepare($permcontstmt);
        $permcontsql->bindParam(':usid', $userID);
        $permcontsql->execute();
        $result = $permcontsql->fetch(PDO::FETCH_ASSOC);
        if ($result){
            $privilege = $result['Privilege'];
            if ($privilege === 'VCM') {
                echo "<form method='post' action='registeruser.php'>
                        <h2>Create User</h2>
                        <label for='new_email'>Set Email Address</label>
                        <input type='email' placeholder='Email Address' name='new_email' required><br><br>
                        <label for='new_username'>Set Username</label>
                        <input type='text' placeholder='Username' name='new_username' required><br><br>
                        <label for='new_password'>Set Password</label>
                        <input type='password' placeholder='Password' name='new_password' required><br><br>
                        <label for='new_permissions'>Set Permissions</label>
                        <select name='new_permissions' class='new_perms'>
                            <option value=''>--SELECT--</option>
                            <option value='V'>Viewer</option>
                            <option value='VC'>Communicator</option>
                            <option value='VCM'>Administrator</option>
                        </select>
                        <button type='submit' name='registerbtn'>Create</button>
                        </form>";
            }
        }
        
?>
    </body>
</html>