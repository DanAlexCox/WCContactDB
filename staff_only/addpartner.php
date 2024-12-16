<?php
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
        <title>Add Partner</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/addpartner.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>

    <?php
        //Make the form (Partner_name(organisation), address (postcode for now only), representative (prefix, first name, last name), representative email (done))
            ?>
            <form method="post" action="addpartnerconfirmed.php" id="partnerForm" onsubmit="return confirmPartner();" class="adptnr">
                <label for class="org">Organisation Name</label>
                <input type="text" name="Organisation" class="org" placeholder="Enter here" required><br>
                <!--post code only, later add more detail address -->
                <label for class="pcode">Post Code</label>
                <input type="text" name="Postcode" class="pcode" placeholder="Enter here" required><br>
                <h2>Contact</h2>
                <label for class="prefx">Prefix</label>
                <select name="Prefix" class="prefx" id="prefixDropdown" required>
                    <option value="">--Select--</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                    <option value="Dr">Dr</option>
                    <option value="Prof">Prof</option>
                    <option value="Other">Other</option>
                </select>
                <label for class="Forenm">Forename</label>
                <input type="text" name="Forename" class="Fornm" placeholder="Enter here" required>
                <label for class="Surnm">Surname</label>
                <input type="text" name="Surname" class="Surnm" placeholder="Enter here" required><br>
                <label for class="contacteml">Email Address</label>
                <input type="text" name="EmailAddress" class="contacteml" placeholder="Enter here" required><br>
                <button type="submit" name="regpartner">Add</button>
            </form>
            <?php
        //cancel button back to partner.php, submit popup are you sure "Yes" submit, "No" undo submit (done)
            ?>
            <a href="partners.php"><button name="cancelAdd">Cancel</button></a>
            <?php
            //see form onsubmit

        //make pdo query with sql injection prevention (done see addpartnerconfirmed.php)
        //popup successfully added partner, send back to partner.php (done see addpartnerconfirmed.php)
    ?>
    </body>
</html>