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
?>

<html>
    <?php
    //check session data
    ?>
    <head>
        <title>Add Partner</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/addpartner.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>

    <?php
        //Make the form (Partner_name(organisation), address (postcode for now only), representative (prefix, first name, last name), representative email)
        ?>
        <form method="post" action="addpartner.php">
            <label for class="org">Organisation Name</label>
            <input type="text" name="Organisation" class="org" placeholder="Enter here" required><br>
            <!--post code only, later add more detail address -->
            <label for class="pcode">Post Code</label>
            <input type="text" name="Postcode" class="pcode" placeholder="Enter here" required><br>
            <h2>Contact</h2>
            <label for="Prefix">Prefix</label>
            <select name="Prefix" class="prefx" id="prefixDropdown" required>
                <option value="">--Select--</option>
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
            </select>
            <label for class="Forenm">Forename</label>
            <input type="text" name="Forename" class="Fornm" placeholder="Enter here" required>
            <label for class="Surenm">Surename</label>
            <input type="text" name="Surename" class="Surenm" placeholder="Enter here" required><br>

            <label for class="contacteml">Email Address</label>
            <input type="text" name="EmailAddress" class="contacteml" placeholder="Enter here" required><br>
            <button type="submit">Add</button>
        </form>
        <?php
        //submit popup are you sure "Yes" submit, "No" back to partner.php
        //make pdo query with sql injection prevention
        //popup successfully added partner, send back to partner.php
    ?>
    </body>
</html>