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
?>

<html>
    <?php
    //check session data
    ?>
    <head>
        <title>Add Client</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/addclient.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>

    <?php
        //Make the client form (Prefix, Forename, Surname, Age, Gender, Religion, Email)
            ?>
            <form method="post" action="addclientconfirmed.php" id="clientForm" onsubmit="return confirmClient();" class="adclnt">
                <h2>Contact</h2>
                <label for class="contacteml">Email Address</label>
                <input type="text" name="EmailAddress" class="contacteml" placeholder="Enter here" required><br>
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
                <label for="ageDropdown" class="age">Age</label>
                <select name="Age" class="age" id="ageDropdown" required>
                    <option value="">--Select--</option>
                    <!-- Dynamically generate age options from 18 to 100 -->
                    <script>
                        for (let i = 18; i <= 100; i++) {
                        document.write(`<option value="${i}">${i}</option>`);
                        }
                    </script>
                </select><br>
                <label for="genderDropdown" class="gender">Gender</label>
                <select name="Gender" class="gender" id="genderDropdown" required>
                    <option value="">--Select--</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Non-Binary">Non-Binary</option>
                    <option value="Other">Other</option>
                    <option value="Prefer not to say">Prefer not to say</option>
                </select><br>
                <label for="religionDropdown" class="religion">Religion</label>
                <select name="Religion" class="religion" id="religionDropdown" required>
                    <option value="">--Select--</option>
                    <option value="Christianity">Christianity</option>
                    <option value="Islam">Islam</option>
                    <option value="Hinduism">Hinduism</option>
                    <option value="Buddhism">Buddhism</option>
                    <option value="Judaism">Judaism</option>
                    <option value="Atheism">Atheism</option>
                    <option value="Other">Other</option>
                </select><br>
                <button type="submit" name="regclient">Add</button>
            </form>
            <?php
        //cancel button back to clients.php, submit popup are you sure "Yes" submit, "No" undo submit (done)
            ?>
            <a href="clients.php"><button name="cancelAdd">Cancel</button></a>
            <?php
            //see form onsubmit

        //make pdo query with sql injection prevention (done see addclientconfirmed.php)
        //popup successfully added partner, send back to partner.php (done see addclientconfirmed.php)
    ?>
    </body>
</html>