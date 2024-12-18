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

<html>
    <head>
        <title>Modify Client</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/modclient.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>
        <?php
        //Get client list (*) dropdown -> confirm button
            $viewAllQuery = "SELECT * FROM `clients`";
            $viewAllStmt = $pdo->query($viewAllQuery);
            ?>
            <form method="post" action="modifyclient.php">
                <select name="clientlist">
                    <option value=""></option>
                    <?php
                    foreach($viewAllStmt->fetchAll(PDO::FETCH_ASSOC) as $viewOne){
                        echo "<option value='".$viewOne['Client_ID']."'>".$viewOne['Prefix']." ".$viewOne['Forename']." "
                                .$viewOne['Surname']." - ".$viewOne['Age']."</option>";
                    }
                    ?>
                </select>
                <button input='submit' name='searchbtn'>Go</button>
            </form>
            <?php
        //Form appears including confirmed from dropdown
            if(isset($_POST['searchbtn'])){
                $cliID = htmlspecialchars($_POST['clientlist']);
                $updateFormQuery = "SELECT * FROM `clients` WHERE Client_ID = :cid";
                $updateFormStmt = $pdo->prepare($updateFormQuery);
                $updateFormStmt->bindParam(':cid', $cliID);

                if($updateFormStmt->execute()){
                    foreach($updateFormStmt as $row){
                    echo "<form method='post' action='modifyclient.php'>" ;
                    echo "<label for class='CliEml'>Email Address</label>
                            <input type='email' name='CliEmail' class='CliEml'value='".htmlspecialchars($row['Email'])."' required>";
                    echo "<label for class='CliPrefix'>Prefix</label>
                            <select name='CliPrefix' class='CliPfx'  id='prefixDropdown' required>
                            <option value='".htmlspecialchars($row['Prefix'])."'>".$row['Prefix']."</option>
                            <option value='Mr'>Mr</option>
                            <option value='Mrs'>Mrs</option>
                            <option value='Miss'>Miss</option>
                            <option value='Dr'>Dr</option>
                            <option value='Prof'>Prof</option>
                            <option value='Other'>Other</option>
                            </select>";
                    echo "<label for class='CliFnm'>Forename</label>
                            <input type='text' name='CliForename' class= 'CliFnm' value='".htmlspecialchars($row['Forename'])."'required>";
                    echo "<label for class='CliSnm'>Surname</label>
                            <input type='text' name='CliSurname' class = 'CliSnm' value='".htmlspecialchars($row['Surname'])."' required>";
                    echo "<label for class='CliAge'>Age</label>
                            <select name='CliAge' class='CliAge' id='ageDropdown' required>
                            <option value=".htmlspecialchars($row['Age']).">".htmlspecialchars($row['Age'])."</option>";
                            //Dynamically generate age options from 18 to 100
                            for ($i = 18; $i <= 100; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                    echo "</select><br>";
                    echo "<label for class='CliGndr'>Gender</label>
                            <select name='CliGender' class='CliGndr' id='cliGenderDropdown' required>
                                <option value=".htmlspecialchars($row['Gender']).">".htmlspecialchars($row['Gender'])."</option>
                                <option value='Male'>Male</option>
                                <option value='Female'>Female</option>
                                <option value='Non-Binary'>Non-Binary</option>
                                <option value='Other'>Other</option>
                                <option value='Prefer not to say'>Prefer not to say</option>
                            </select><br>";
                    echo "<label for class='CliRlgn'>Religion</label>
                            <select name='CliReligion' class='CliRlgn' id='CliReligionDropdown' required>
                                <option value=".htmlspecialchars($row['Religion']).">".htmlspecialchars($row['Religion'])."</option>
                                <option value='Christianity'>Christianity</option>
                                <option value='Islam'>Islam</option>
                                <option value='Hinduism'>Hinduism</option>
                                <option value='Buddhism'>Buddhism</option>
                                <option value='Judaism'>Judaism</option>
                                <option value='Atheism'>Atheism</option>
                                <option value='Other'>Other</option>
                            </select><br>";
                    echo "<input type='hidden' name='ClientID' value='".htmlspecialchars($row['Client_ID'])."'>";
                    echo "<button type='submit' name='updatebtn'>Confirm</button>";
                    echo "</form>";
                    }
                } else{
                    $error = "Unable to find any results.";
                    header("Location: modifyclient.php?error=".$error);
                    exit();
                }
            }

        //Update client table using form data, sends message and goes back to client.php, else send error message
        if(isset($_POST['updatebtn'])){
            $updatePref = htmlspecialchars($_POST['CliPrefix']);
            $updateFore = htmlspecialchars($_POST['CliForename']);
            $updateSurn = htmlspecialchars($_POST['CliSurname']);
            $updateEm = htmlspecialchars($_POST['CliEmail']);
            $updateGen = htmlspecialchars($_POST['CliGender']);
            $updateAge = htmlspecialchars($_POST['CliAge']);
            $updateReli = htmlspecialchars($_POST['CliReligion']);
            $updatingID = htmlspecialchars($_POST['ClientID']);

            $updateQuery = "UPDATE `clients` SET  Prefix = :uppf, Forename = :upfn, Surname = :upsn,
                                Email = :upem, Gender = :upgd, Age = :upag, Religion = :uprl WHERE Client_ID = :upcid";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':uppf', $updatePref);
            $updateStmt->bindParam(':upfn', $updateFore);
            $updateStmt->bindParam(':upsn', $updateSurn);
            $updateStmt->bindParam(':upem', $updateEm);
            $updateStmt->bindParam(':upgd', $updateGen);
            $updateStmt->bindParam(':upag', $updateAge);
            $updateStmt->bindParam(':uprl', $updateReli);
            $updateStmt->bindParam(':upcid', $updatingID);

            if($updateStmt->execute()){
                $msg = "Modified successfully.";
                header("Location: clients.php?msg=".$msg);
                exit();
            } else{
                $error = "Unable to modify data.";
                    header("Location: modifyclient.php?error=".$error);
                    exit();
            }
        }
        ?>
        <!--Cancel button-->
            <a href = "clients.php"><button name="cancelUpdate">Cancel</button></a>
    </body>
</html>