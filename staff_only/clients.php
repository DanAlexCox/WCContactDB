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
        <title>Clients</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/client.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
    </head>
    <?php
    include "navbar.php";
    ?>
    <body>
        <?php
        
        //Tasks:
        //- Locate client table (remake sql table)
            $stmt = "SELECT `partner_ID`, `partner_email`, `partner_name` AS `Partner`, `representative` AS `Contact` FROM `partners` AS `Associates`";
            $query = $pdo->prepare($stmt);
            $query->execute();

            $rowset = array();

        //- View client table (later make specific permissions for specially authorized users)

            echo "<form method = 'post' action = 'clients.php' class = 'clienttable'><table class = 'clnt'>";
            echo "<tr><th>Partner</th><th>Representative</th><th>Select</th></tr>";
            foreach($query as $row){
            //verify no dupes
            
            if(!in_array($row, $rowset)){
                echo "<tr>";
                echo "<td>".$row['Partner']."</td>";
                echo "<td>".$row['Contact']."</td>";
                echo "<td><input type = 'checkbox' class = 'checkbox' name = 'email[]' value = '".$row['partner_email']."'></td>";
                echo "<input type = 'hidden' name = 'contactname[]' value = '".$row['Partner']."'>";
                echo "<input type = 'hidden' name = 'partnerid' value = '".$row['partner_ID']."'>";
                echo "</tr>";
                array_push($rowset, $row);
            }
            }
            echo "</table>";

            echo "<input type='submit' class='dletbtn' name='dletbtn' value='Delete'>";
            echo "<input type='submit' class='mkemlbtn' name='mkemlbtn' value='Contact'>";
            echo "</form>";

        //- Contact client
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
                if(isset($_POST['mkemlbtn'])){
                    echo "<div class='ccontact'>";
        
        // Display the email form (complete)
                    echo "<form id='emailForm' method='post' onsubmit='return checkPassword();' action='sendcemail.php' class='sndeml'>";
        // Loop through selected checkboxes (complete)
                    $buttons = array();
                    foreach ($_POST['email'] as $partnerEM) {
                        echo "<input type='hidden' name='selected_emails[]' value='" . htmlspecialchars($partnerEM) . "'>";
                        array_push($buttons, $partnerEM);
                    }
                    $buttonsString = implode(", ", $buttons);

                    $part = array();
                    foreach($_POST['contactname'] as $contactNM){
                        echo "<input type = 'hidden' name = 'selected_contacts[]' value = '".htmlspecialchars($contactNM)."'>";
                        array_push($part, $contactNM);
                    }
                    $partString = implode(", ", $part);

                    echo "<label for class='email'>Email</label><br>";
                    echo "<input type = 'text' class = 'email' name ='emails[]' value = '".htmlspecialchars($buttonsString)."' readonly><br>";
                    echo "<label for class='title'>Title</label><br>";
                    echo "<input type = 'text' class = 'title' name = 'title' placeholder = 'Insert title' required><br>";
                    echo "<label for class='description'>Description</label><br>";
                    echo "<input type = 'text' class = 'description' name = 'description' placeholder = 'Insert details here'><br>";
                    echo "<input type = 'hidden' name = 'contacts[]' value = ". htmlspecialchars($partString) .">";
                    echo "<input type='hidden' name='sndemlbtn' value='1'>";
                    echo "<button type='submit'>Send</button>";
                    echo "</form>";
                    echo "</div>";
                }
        //- Remove client
                if(isset($_POST['dletbtn'])){
                    $partnerid = htmlspecialchars($_POST['partnerid']);

                    $delete_query = "DELETE FROM `partners` WHERE partner_ID = :id";
                    $delete_stmt = $pdo->prepare($delete_query);
                    $delete_stmt->bindParam(':id', $partnerid);
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
        //!!!(all client modifications can only be done with proper authorization)!!!!
        //- Add client details
            echo "<a href='addclient.php'><button>Add a client</button></a>";

        //- Modify client details
            echo "<a href='modifyclient.php'><button>Modify an existing client</button></a>";
        ?>
    </body>
</html>