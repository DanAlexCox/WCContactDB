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
        <title>Modify Client</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/partner.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>
        <?php
        //Get client list (*) dropdown -> confirm button
            $viewAllQuery = "SELECT * FROM `partners`";
            $viewAllStmt = $pdo->query($viewAllQuery);
            ?>
            <form method="post" action="modifypartner.php">
                <select name="partnerlist">
                    <option value=""></option>
                    <?php
                    foreach($viewAllStmt->fetchAll(PDO::FETCH_ASSOC) as $viewOne){
                        echo "<option value='".$viewOne['partner_ID']."'>".$viewOne['partner_ID'].
                                ": ".$viewOne['partner_name']." - ".$viewOne['representative']."</option>";
                    }
                    ?>
                </select>
                <button input='submit' name='searchbtn'>Go</button>
            </form>
            <?php
        //Form appears including confirmed from dropdown
            if(isset($_POST['searchbtn'])){
                $partID = htmlspecialchars($_POST['partnerlist']);
                $updateFormQuery = "SELECT * FROM `partners` WHERE partner_ID = :pid";
                $updateFormStmt = $pdo->prepare($updateFormQuery);
                $updateFormStmt->bindParam(':pid', $partID);

                if($updateFormStmt->execute()){
                    foreach($updateFormStmt as $row){
                    echo "<form method='post' action='modifypartner.php'>" ;
                    echo "<input type='text' name='Organisation' value='".htmlspecialchars($row['partner_name'])."' required>";
                    echo "<input type='text' name='Postcode' value='".htmlspecialchars($row['address'])."' required>";
                        $repTitle = explode(" ", $row['representative']);
                    echo "<select name='RepPrefix' class='prefx'  id='prefixDropdown' required>
                            <option value='".htmlspecialchars($repTitle[0])."'>".$repTitle[0]."</option>
                            <option value='Mr'>Mr</option>
                            <option value='Mrs'>Mrs</option>
                            <option value='Miss'>Miss</option>
                            <option value='Dr'>Dr</option>
                            <option value='Prof'>Prof</option>
                            <option value='Other'>Other</option>
                            </select>";
                    echo "<input type='text' name='RepForename' value='".htmlspecialchars($repTitle[1])."'required>";
                    echo "<input type='text' name='RepSurname' value='".htmlspecialchars($repTitle[2])."' required>";
                    echo "<input type='email' name='RepEmail' value='".htmlspecialchars($row['partner_email'])."' required>";
                    echo "<input type='hidden' name='PartnerID' value='".htmlspecialchars($row['partner_ID'])."'>";
                    echo "<button type='submit' name='updatebtn'>Confirm</button>";
                    echo "</form>";
                    }
                } else{
                    $error = "Unable to find any results.";
                    header("Location: modifyclient.php?error=".$error);
                    exit();
                }
            }

        //Update partner table using form data, sends message and goes back to client.php, else send error message
        if(isset($_POST['updatebtn'])){
            $updateOrg = htmlspecialchars($_POST['Organisation']);
            $updateAdd = htmlspecialchars($_POST['Postcode']);
            $updateRep = htmlspecialchars($_POST['RepPrefix']) . " " . htmlspecialchars($_POST['RepForename']) . " " . htmlspecialchars($_POST['RepSurname']);
            $updateEm = htmlspecialchars($_POST['RepEmail']);
            $updatingID = htmlspecialchars($_POST['PartnerID']);

            $updateQuery = "UPDATE `partners` SET partner_name = :uppt, address = :upadd, representative = :uprep,
                                partner_email = :upem WHERE partner_ID = :uppid";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->bindParam(':uppt', $updateOrg);
            $updateStmt->bindParam(':upadd', $updateAdd);
            $updateStmt->bindParam(':uprep', $updateRep);
            $updateStmt->bindParam(':upem', $updateEm);
            $updateStmt->bindParam(':uppid', $updatingID);

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