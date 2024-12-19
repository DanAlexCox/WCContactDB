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
        <title>Partners</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/partner.css">
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
        //- Locate Partnership table (complete)
            $stmt = "SELECT `partner_ID`, `partner_email`, `partner_name` AS `Partner`, `representative` AS `Contact` FROM `partners` AS `Associates`";
            $query = $pdo->prepare($stmt);
            $query->execute();

            $rowset = array();

        //- View partnership table (complete later make specific permissions for specially authorized users)

            echo "<form method = 'post' action = 'partners.php?' class = 'partnertable'><table class = 'ptnr'>";
            echo "<tr><th>Partner</th><th>Representative</th><th>Select</th></tr>";
            foreach($query as $row){
            //verify no dupes
            
            if(!in_array($row, $rowset)){
                echo "<tr>";
                echo "<td>".$row['Partner']."</td>";
                echo "<td>".$row['Contact']."</td>";
                echo "<td><input type = 'checkbox' class = 'checkbox' name = 'email[".$row['partner_ID']."]' value = '".$row['partner_email']."'>";
                echo "<input type = 'hidden' name = 'contactname[".$row['partner_ID']."]' value = '".$row['Partner']."'>";
                echo "<input type = 'hidden' name = 'partnerid[".$row['partner_ID']."]' value = '".$row['partner_ID']."'></td>";
                echo "</tr>";
                array_push($rowset, $row);
            }
            }
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

                    //!!!!(later all partner modifications (add, edit, remove) can only be done with proper authorization (Complete))!!!!
                    //- Add partner details (complete)
                        echo "<div class='button-container'>";
                        echo "<a href='addpartner.php'><button>Add a partner</button></a>";
                        echo "</div>";

                    //- Modify partner details (complete)
                        echo "<a href='modifypartner.php'><button>Modify an existing partner</button></a>";
                    } else{
                        echo "</form>";
                    }
                }
                else{
                    echo "</form>";
                }
            }

            echo "</form>";

        //- Contact partners (complete)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(isset($_POST['mkemlbtn']) && isset($_POST['email'])){
                    ?>
                    <div id="popupContainer">
        <?php
                    echo "<div class='pcontact'>";
        echo "<form id='emailForm' method='post' onsubmit='return checkPassword();' action='sendpemail.php' class='sndeml'>";
                    
        $emailArray = array();
        $nameArray = array();
        $idArray = array();
        foreach ($_POST['email'] as $id => $email) {
            $contactName = $_POST['contactname'][$id];
            $partnerid = $_POST['partnerid'][$id];

            array_push($emailArray, $email);
            array_push($nameArray, $contactName);
            array_push($idArray, $partnerid);
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
    ?>
</div>
<?php
                }
                if (isset($_POST['sendallbtn'])) {
                    // Fetch all partner emails
                    $allPartnersQuery = "SELECT `partner_email`, `partner_name` FROM `partners`";
                    $allPartnersStmt = $pdo->prepare($allPartnersQuery);
                    $allPartnersStmt->execute();
            
                    $emails = [];
                    $contacts = [];
                    foreach ($allPartnersStmt as $row) {
                        $emails[] = htmlspecialchars($row['partner_email']);
                        $contacts[] = htmlspecialchars($row['partner_name']);
                    }
            
                    ?>
                    <div id="popupContainer">
                        <div class='pcontact'>
                            <form id='emailForm' method='post' onsubmit='return checkPassword();' action='sendpemail.php' class='sndeml'>
                                <label for class='email'>Email</label><br>
                                <input type='text' class='email' name='emails[]' value='<?php echo implode(", ", $emails); ?>' readonly><br>
                                <label for class='title'>Title</label><br>
                                <input type='text' class='title' name='title' placeholder='Insert title' required><br>
                                <label for class='description'>Description</label><br>
                                <textarea class='description' name='description' placeholder='Insert details here'></textarea><br>
                                <input type = 'hidden' name = 'contacts[]' value = '<?php echo implode(", ",$contacts); ?>'>
                                <input type='hidden' name='sndemlbtn' value='1'>
                                <button type='submit'>Send</button> 
                            </form>
                        </div>
                    </div>
                    <?php
                }
        //- Remove partner (complete)
                if(isset($_POST['dletbtn'])){
                    $emailArray = array();
                    $idArray = array();
                    foreach ($_POST['email'] as $id => $email) {
                        $partnerid = $_POST['partnerid'][$id];

                        array_push($idArray, $partnerid);
                    }
                    $idString = implode(", ", $idArray);
                    $delete_query = "DELETE FROM `partners` WHERE partner_ID = (:id)";
                    $delete_stmt = $pdo->prepare($delete_query);
                    $delete_stmt->bindParam(':id', $idString);

                    
                    if($delete_stmt->execute()){
                        $msg = "Successfully deleted.";
                        header("Location: partners.php?msg=".$msg);
                        exit();
                    } else{
                        $error = "Unable to delete.";
                        header("Location: partners.php?error=".$error);
                        exit();
                    }
                }
            }
        ?>
    </body>
</html>