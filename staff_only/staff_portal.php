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
                        </form><br><br>";

                //Get user list (*) dropdown -> confirm button
            $viewAllQuery = "SELECT * FROM `staff_user`";
            $viewAllStmt = $pdo->query($viewAllQuery);
            ?>
            <form method="post" action="staff_portal.php">
                <h2>Modify User</h2>
                <select name="userlist">
                    <option value="">--SELECT--</option>
                    <?php
                    foreach($viewAllStmt->fetchAll(PDO::FETCH_ASSOC) as $viewOne){
                        echo "<option value='".$viewOne['User_ID']."'>".$viewOne['User_ID'].
                                ": ".$viewOne['Username']." - ".$viewOne['Privilege']."</option>";
                    }
                    ?>
                </select>
                <button input='submit' name='searchbtn'>Go</button>
            </form>
            <?php
        //Form appears including confirmed from dropdown
            if(isset($_POST['searchbtn'])){
                $subUserID = htmlspecialchars($_POST['userlist']);
                $updateFormQuery = "SELECT * FROM `staff_user` WHERE User_ID = :uid";
                $updateFormStmt = $pdo->prepare($updateFormQuery);
                $updateFormStmt->bindParam(':uid', $subUserID);

                if($updateFormStmt->execute()){
                    foreach($updateFormStmt as $row){
                        echo "<form method='post' action='staff_portal.php'>" ;
                        echo "<input type='text' name='ModUser' value='".htmlspecialchars($row['Username'])."'required>";
                        echo "<input type='email' name='ModEmail' value='".htmlspecialchars($row['Staff_email'])."' required>";
                        echo "<select name='ModPriv' class='Priv'  id='privilegeDropdown' required>
                                <option value='".htmlspecialchars($row['Privilege'])."'>".$row['Privilege']."</option>
                                <option value='V'>Viewer</option>
                                <option value='VC'>Communicator</option>
                                <option value='VCM'>Admin</option>
                                </select>";
                        echo "<input type='hidden' name='UserID' value='".htmlspecialchars($row['User_ID'])."'>";
                        echo "<button type='submit' name='updatebtn'>Confirm</button>";
                        echo "</form>";
                    }
                } else{
                    $error = "Unable to find any results.";
                    header("Location: staff_portal.php?error=".$error);
                    exit();
                }
            }

        //Update user table using form data, sends message and goes back to staff_portal.php, else send error message
        if(isset($_POST['updatebtn'])){
            $updateUser = htmlspecialchars($_POST['ModUser']);
            $updateEm = htmlspecialchars($_POST['ModEmail']);
            $updatePriv = htmlspecialchars($_POST['ModPriv']);
            $updatingID = htmlspecialchars($_POST['UserID']);

            $updateQuery = "UPDATE `staff_user` SET Username = :upus, Staff_email = :upema,
                                Privilege = :uppri WHERE User_ID = :upuid";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':upus', $updateUser);
            $updateStmt->bindParam(':upema', $updateEm);
            $updateStmt->bindParam(':uppri', $updatePriv);
            $updateStmt->bindParam(':upuid', $updatingID);

            if($updateStmt->execute()){
                $msg = "Modified successfully.";
                header("Location: staff_portal.php?msg=".$msg);
                exit();
            } else{
                $error = "Unable to modify data.";
                    header("Location: staff_portal.php?error=".$error);
                    exit();
            }
        }
            }
        }
        
?>
    </body>
</html>