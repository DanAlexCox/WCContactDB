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
        <title>New User</title>
        <link rel="stylesheet" type="text/css" href="CSS/login.css">
        <link rel="stylesheet" type="text/css" href="CSS/newuser.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
    </head>
    <body>
        <div id="newuserbody">
            <a href="login.php"><button id="gobackbutton">Back to login page</button></a>
            <?php
            //Verifying valid email present form
            if(isset($_POST['emailsubmitted'])){
                $vEmail = htmlspecialchars($_POST['verifyemail']);
                //If emailsubmitted isset, check database for email without password
                $checkStmt = "SELECT COUNT(*) AS count FROM `staff_user` WHERE Staff_email= :eml AND Password IS NULL";
                $checkSQL = $pdo->prepare($checkStmt);
                $checkSQL->bindParam(":eml", $vEmail);
                $checkSQL->execute();
                $checkCount = $checkSQL->fetch(PDO::FETCH_ASSOC);

                if($checkCount['count'] == 1){
                    $uEmail = $vEmail;
                    $findIDStmt = "SELECT User_ID FROM `staff_user` WHERE Staff_email= :uem AND Password IS NULL";
                    $findSQL = $pdo->prepare($findIDStmt);
                    $findSQL->bindParam(":uem", $uEmail);
                    $findSQL->execute();
                    $idFound = $findSQL->fetch();
                    ?>
                    <form method="post" action="newuser.php" id="updateform">
                        <label for="newusername">Username</label>
                        <input type="text" name="newusername" placeholder="DoeJohn" required pattern="^\S+$"
                            title="Ensure your username does not include spaces">
                        <label for="newpassword">Password</label>
                        <input type="password" id="newpassword" name="newpassword" placeholder="Insert here" required
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$"
                            title="Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.">
                        <input type="hidden" name="userid" value="<?php echo $idFound['User_ID']; ?>">
                        <button type="submit" name="submitupdate">Submit</button> 
                        <h3>Password Strength</h3>
                        <div class="strength-bar">
                            <div class="strength-fill" id="strength-fill"></div>
                        </div>
                        <div id="strength-text"></div>
                    </form>
                    <script>
                        const password = document.getElementById('newpassword');
                        const strengthFill = document.getElementById('strength-fill');
                        const strengthText = document.getElementById('strength-text');

                        password.addEventListener('input', () => {
                        const val = password.value;
                        let strength = 0;

                        if (val.length >= 8) strength++;
                        if (/[a-z]/.test(val)) strength++;
                        if (/[A-Z]/.test(val)) strength++;
                        if (/\d/.test(val)) strength++;
                        if (/[\W_]/.test(val)) strength++;

                        let strengthPercent = (strength / 5) * 100;
                        strengthFill.style.width = strengthPercent + "%";

                        strengthFill.className = 'strength-fill';
                        if (strength <= 2) {
                            strengthFill.classList.add('weak');
                            strengthText.textContent = "Weak";
                            strengthText.style.color = "red";
                        } else if (strength === 3 || strength === 4) {
                            strengthFill.classList.add('medium');
                            strengthText.textContent = "Medium";
                            strengthText.style.color = "orange";
                        } else {
                            strengthFill.classList.add('strong');
                            strengthText.textContent = "Strong";
                            strengthText.style.color = "green";
                        }
                        });
                    </script>
                    <?php
                } elseif($checkCount['count'] == 0){
                    $error = "Email not found. Try again";
                    header("Location: newuser.php?error=".urlencode($error));
                    exit();
                }else{
                    $error = "Invalid response.";
                    header("Location: newuser.php?error=".urlencode($error));
                    exit();
                }
                
            } elseif(isset($_POST['submitupdate'])){
                //If new user update form is submitted, update staff_user and send to login page
                $username = htmlspecialchars($_POST['newusername']);
                $unhashPassword = htmlspecialchars($_POST['newpassword']);
                $uid = htmlspecialchars($_POST['userid']);

                $hashedPassword = password_hash($unhashPassword, PASSWORD_DEFAULT);

                $updateNewStmt = "UPDATE `staff_user` SET Username = :un, Password = :psw, Privilege='VC' WHERE User_ID = :ud";

                $updateNew = $pdo->prepare($updateNewStmt);
                $updateNew->bindParam(":un", $username);
                $updateNew->bindParam(":psw", $hashedPassword);
                $updateNew->bindParam(":ud", $uid, PDO::PARAM_INT);

                if($updateNew->execute()){
                    $msg = "Details successfully added. Proceed to login.";
                    header("Location: login.php?msg=".urlencode($msg));
                    exit();
                } else{
                    $error="Unable to add details. Please try again.";
                    header("Location: newuser.php?error=".urlencode($error));
                    exit();
                }
            }else{
                ?>
                <form method="post" action="newuser.php" id="checkemailform">
                    <label for="verifyemail">Insert email for verification</label>
                    <input type="email" name="verifyemail" placeholder="JohnDoe@womensconsortium.org.uk" required>
                    <button type="submit" name="emailsubmitted">Verify</button>
                </form>
                <?php
            }
            ?>
        </div>
    </body>
</html>