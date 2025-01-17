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
        <title>Clients</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/client.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
        <script src="JS/email.js" defer></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>
        <?php
        
        //Tasks:
        //- Locate client table (remake sql table)
            $stmt = "SELECT * FROM `clients`";
            $query = $pdo->prepare($stmt);
            $query->execute();

            $rowset = array();

        //- View client table (later make specific permissions for specially authorized users)

        echo "<form method='post' action='clients.php?' class='clienttable'>";
        echo "<table class='clnt'>";
        echo "<thead><tr><th>Prefix</th><th>Forename</th><th>Surname</th><th>Gender</th><th>Age</th><th>Select</th></tr></thead>";
        echo "<tbody>";
        foreach($query as $row){
            //verify no dupes
            if(!in_array($row, $rowset)){
                echo "<tr>";
                echo "<td>".$row['Prefix']."</td>";
                echo "<td>".$row['Forename']."</td>";
                echo "<td>".$row['Surname']."</td>";
                echo "<td>".$row['Gender']."</td>";
                echo "<td>".$row['Age']."</td>";
                echo "<td><input type='checkbox' class='checkbox' name='email[".$row['Client_ID']."]' value='".$row['Email']."'>";
                echo "<input type='hidden' name='contactname[".$row['Client_ID']."]' value='".$row['Forename']." ".$row['Surname']."'>";
                echo "<input type='hidden' name='clientid[".$row['Client_ID']."]' value='".$row['Client_ID']."'></td>";
                echo "</tr>";
                array_push($rowset, $row);
            }
        }
        echo "</tbody>";
        echo "</table>";

            $userID = htmlspecialchars($_SESSION['User_ID']);

            $permcontstmt = "SELECT Privilege FROM `staff_user` WHERE User_ID = :usid";

            $permcontsql = $pdo->prepare($permcontstmt);
            $permcontsql->bindParam(':usid', $userID);
            $permcontsql->execute();
            $result = $permcontsql->fetch(PDO::FETCH_ASSOC);
            if ($result){
                $privilege = $result['Privilege'];
                if ($privilege === 'VC' || $privilege === 'VCM') {
                    echo "<input type='submit' id='mkemlbtn' class='mkemlbtn' name='mkemlbtn' value='Contact'>";
                    echo "<input type='submit' id='sendallbtn' class='sendallbtn' name='sendallbtn' value='Send to All'>";
                    if ($privilege === 'VCM') {
                        echo "<input type='submit' class='dletbtn' name='dletbtn' value='Delete'>";
                        echo "</form>";
                    //!!!(all client modifications can only be done with proper authorization (Complete))!!!!
                    //- Add client details
                        echo "<div class='button-container'>";
                        echo "<a href='addclient.php'><button>Add a client</button></a>";
                        echo "</div>";

                    //- Modify client details
                        echo "<a href='modifyclient.php'><button>Modify an existing client</button></a>";
                    } else{
                        echo "</form>";
                    }
                }
                else{
                    echo "</form>";
                }
            }

            echo "</form>";
        
        //- Contact client
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(isset($_POST['mkemlbtn']) && isset($_POST['email'])){
                    ?>
                    <div id="popupContainer" class="">
    <?php
                    echo "<div class='ccontact'>";
        
        // Display the email form (complete)
                    echo "<form id='emailForm' method='post' onsubmit='return checkPassword();' action='sendcemail.php' class='sndeml'>";
        // Loop through selected checkboxes (complete)
                    $emailArray = array();
                    $nameArray = array();
                    $idArray = array();

                    foreach ($_POST['email'] as $id => $email) {
                        $contactName = $_POST['contactname'][$id];
                        $clientId = $_POST['clientid'][$id];

                        array_push($emailArray, $email);
                        array_push($nameArray, $contactName);
                        array_push($idArray, $clientId);
                    }

                    $emailString = implode(", ", $emailArray);
                    $nameString = implode(", ", $nameArray);
                    $idString = implode(", ", $idArray);

                    echo "<label for class='email'>Email</label><br>";
                    echo "<input type = 'text' class = 'email' name ='emails[]' value = '".htmlspecialchars($emailString)."' readonly><br>";
                    echo "<label for class='title'>Title</label><br>";
                    echo "<input type = 'text' class = 'title' name = 'title' placeholder = 'Insert title' required><br>";
                    echo "<label for class='description'>Description</label><br>";
                    echo "<textarea class = 'description' name = 'description' placeholder = 'Insert details here'></textarea><br>";
                    echo "<input type = 'hidden' name = 'contacts[]' value = '". htmlspecialchars($nameString) ."'>";
                    echo "<input type='hidden' name='sndemlbtn' value='1'>";
                    echo "<button type='submit'>Send</button>";
                    echo "</form>";
                    echo "</div>";
                }
                ?>
</div>
<?php

        // "Send to All" feature
    if (isset($_POST['sendallbtn'])) {
        $allClientsQuery = "SELECT Email, CONCAT(Forename, ' ', Surname) AS FullName FROM `clients`";
        $allClientsStmt = $pdo->prepare($allClientsQuery);
        $allClientsStmt->execute();

        $emails = [];
        $contacts = [];
        foreach ($allClientsStmt as $row) {
            $emails[] = htmlspecialchars($row['Email']);
            $contacts[] = htmlspecialchars($row['FullName']);
        }

        ?>
        <div id="popupContainer" class="">
            <div class='ccontact'>
                <form id='emailForm' method='post' onsubmit='return checkPassword();' action='sendcemail.php' class='sndeml'>
                    <label for class='email'>Email</label><br>
                    <input type='text' class='email' name='emails[]' value='<?php echo implode(", ", $emails); ?>' readonly><br>
                    <label for class='title'>Title</label><br>
                    <input type='text' class='title' name='title' placeholder='Insert title' required><br>
                    <label for class='description'>Description</label><br>
                    <textarea class='description' name='description' placeholder='Insert details here'></textarea><br>
                    <input type = 'hidden' name = 'contacts[]' value = '<?php echo implode(", ", $contacts); ?>'>
                    <input type='hidden' name='sndemlbtn' value='1'>
                    <button type='submit'>Send</button>
                </form>
            </div>
        </div>
        <?php
    }
        //- Remove client
                if(isset($_POST['dletbtn'])){
                    $emailArray = array();
                    $idArray = array();
                    foreach ($_POST['email'] as $id => $email) {
                        $clientid = $_POST['clientid'][$id];

                        array_push($idArray, $clientid);
                    }
                    $idString = implode(", ", $idArray);

                    $delete_query = "DELETE FROM `clients` WHERE Client_ID = (:id)";
                    $delete_stmt = $pdo->prepare($delete_query);
                    $delete_stmt->bindParam(':id', $clientid);
                    if($delete_stmt->execute()){
                        $msg = "Successfully deleted.";
                        header("Location: clients.php?msg=".$msg);
                        exit();
                    } else{
                        $error = "Unable to delete.";
                        header("Location: clients.php?error=".$error);
                        exit();
                    }
                }
            }
        ?>
    </body>
</html>