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

//Check privilege for User_ID in staff_user is "VCM"
$uid = $_SESSION['User_ID'];
$checkUser = "SELECT Privilege FROM `staff_user` WHERE User_ID = :uid";
$checkUserSQL = $pdo->prepare($checkUser);
$checkUserSQL->bindParam(":uid", $uid, PDO::PARAM_INT);
$checkUserSQL->execute();
$access = $checkUserSQL->fetch();
if(!$access['Privilege'] == "VCM"){
    $error = htmlspecialchars("Not got correct permission to view current page.");
    header("Location: staff_portal.php?error=".$error);
    exit();
} 

?>
<html>
    <head>
        <title>Email Queue</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/emails.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
        <script src="JS/email.js" defer></script>
    </head>
    
    <body>
        <?php
        include "navbar.php";
        ?>
        <div id="queuebody">
            <h1>Email Queue</h1>
            <?php
            if(isset($_POST['pagenumber'])){
                $pageNum = $_POST['pagenumber'];
            }else{
                $pageNum = 1;
            }

            if(isset($_POST['pagetotal'])){
                $pageTotal = $_POST['pagetotal'];
            } else{
                $pageTotal = 10;
            }
            $pageInd = $pageTotal*($pageNum-1);
            ?>
            <form method="post" action="emails.php" id="searchform">
                <?php
                $search = '';
                $searchReg = '%%';
                if(isset($_POST['searchbox'])){
                    $search = htmlspecialchars($_POST['searchbox']);
                    $searchReg = '%'.$search.'%';
                }
                ?>
                <label for="searchbox">Search</label>
                <input type="text" name="searchbox"
                    value="<?php if(isset($_POST['searchbox'])){echo $search;} ?>"
                    placeholder="Search term (Subject, Client Email)">
                <button type="submit" name="searchsubmit">Search</button>
            </form>
            
            <div id="navbody">
                <p>Page <?php echo htmlspecialchars($pageNum); ?></p>
                <form method="post" action="emails.php" id="prevpage">
                    <input type="hidden" name="pagenumber" value="<?php echo htmlspecialchars($pageNum - 1);?>">
                    <input type="hidden" name="pagetotal" value="<?php echo htmlspecialchars($pageTotal);?>">
                    <?php
                    if(isset($_POST['searchbox'])){
                        ?>
                        <input type="hidden" name="searchbox" value="<?php echo $search; ?>">
                        <?php
                    }
                    if($pageInd != 0){
                        ?>
                        <button type="submit" name="prevpage">To Page <?php echo htmlspecialchars($pageNum - 1); ?></button>
                        <?php
                    }
                    ?>
                </form>
                <form method="post" action="emails.php" id="nextpage">
                    <input type="hidden" name="pagenumber" value="<?php echo htmlspecialchars($pageNum + 1);?>">
                    <input type="hidden" name="pagetotal" value="<?php echo htmlspecialchars($pageTotal);?>">
                    <?php
                    if(isset($_POST['searchbox'])){
                        ?>
                        <input type="hidden" name="searchbox" value="<?php echo $search; ?>">
                        <?php
                    }
                    ?>
                    <?php
                    $selectCount = "SELECT COUNT(*) FROM `emailqueue`
                                        INNER JOIN (SELECT Client_ID, Email FROM `clients`) AS `clts`
                                            ON `clts`.Client_ID = `emailqueue`.Client_ID
                                        INNER JOIN (SELECT EmailStatus_ID, StatusName FROM `emailstatus`) AS `emst`
                                            ON `emst`.EmailStatus_ID = `emailqueue`.EmailStatus_ID
                                        WHERE `clts`.Email LIKE :ems
                                            OR `emailqueue`.Subject LIKE :sus";
                    $getCount = $pdo->prepare($selectCount);
                    $getCount->bindParam(":ems", $searchReg);
                    $getCount->bindParam(":sus", $searchReg);
                    $getCount->execute();
                    $count = $getCount->fetchColumn();
                
                    if(($pageTotal*($pageInd+1)) + 1< $count){
                        ?>
                        <button type="submit" name="nextpage">To Page <?php echo htmlspecialchars($pageNum + 1); ?></button>
                        <?php
                    }
                    ?>
                </form>
            </div>
            <form method="post" action="emails.php" id="queueform">
                <table>
                    <thead><tr><th>Queue ID</th><th>Subject</th><th>Client</th><th>Added Date</th><th>Status</th><th>Options</th></thead>
                <?php
                //Table to view pending emails with option to delete
                $queueStmt = "SELECT `emailqueue`.*, `clts`.Email AS 'Client', `emst`.StatusName AS 'Status' FROM `emailqueue`
                                INNER JOIN (SELECT Client_ID, Email FROM `clients`) AS `clts`
                                    ON `clts`.Client_ID = `emailqueue`.Client_ID
                                INNER JOIN (SELECT EmailStatus_ID, StatusName FROM `emailstatus`) AS `emst`
                                    ON `emst`.EmailStatus_ID = `emailqueue`.EmailStatus_ID
                                WHERE `clts`.Email LIKE :cser
                                    OR Subject LIKE :sser
                                LIMIT :ind, :tot";
                $queueSQL = $pdo->prepare($queueStmt);
                $queueSQL->bindParam(":cser", $searchReg);
                $queueSQL->bindParam(":sser", $searchReg);
                $queueSQL->bindParam(":ind", $pageInd, PDO::PARAM_INT);
                $queueSQL->bindParam(":tot", $pageTotal, PDO::PARAM_INT);
                $queueSQL->execute();
                foreach($queueSQL as $queueEntry){
                    ?>
                    <tr>
                        <td><?php echo $queueEntry['Queue_ID']; ?>
                            <input type="hidden" name="queueid" value="<?php echo $queueEntry['Queue_ID']; ?>"></td>
                        <td><?php echo $queueEntry['Subject']; ?></td>
                        <td><?php echo $queueEntry['Client']; ?>
                            <input type="hidden" name="clientid" value="<?php echo $queueEntry['Client_ID']; ?>"></td>
                        <td><?php echo $queueEntry['Created_at']; ?></td>   
                        <td><?php echo $queueEntry['Status']; ?>
                            <input type="hidden" name="statusid" value="<?php echo $queueEntry['EmailStatus_ID']; ?>"></td>
                        <!--Edit and delete buttons later-->
                        <!-- <td><input type='submit' name='editbtn' value='Edit'>
                        <input type='submit' name='dletbtn' value='Delete'></td> -->
                    </tr>
                    <?php
                }

            ?>
                </table>
            </form>
        </div>
    </body>
</html>