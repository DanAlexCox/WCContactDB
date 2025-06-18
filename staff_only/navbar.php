<link rel="stylesheet" type="text/css" href="CSS/navbar.css">
<section id="sidebar">
          <a href="staff_portal.php" class="brand">
            <span class="icon">
                <img src="CSS/images/w-logo-blue.png" alt="womens consortium logo">
            </span>
          </a>
          <ul class="side-menu top">
            <?php
            if(strpos($_SERVER['REQUEST_URI'], "/WCContactDB/staff_only/staff_portal.php") !== false){
                echo "<li><a href='partners.php'><span class='text'>Partners</span></a></li>";
                echo "<li><a href='clients.php'><span class='text'>Clients</span></a></li>";
                echo "<li><a href='promotion.php'><span class='text'>Promotion</span></a></li>";
                echo "<li><a href='import.php'><span class='text'>Import</span></a></li>";
                //If User_ID privileges = VCM, add email.php

                $uid = $_SESSION['User_ID'];
                $checkUser = "SELECT Privilege FROM `staff_user` WHERE User_ID = :uid";
                $checkUserSQL = $pdo->prepare($checkUser);
                $checkUserSQL->bindParam(":uid", $uid, PDO::PARAM_INT);
                $checkUserSQL->execute();
                $access = $checkUserSQL->fetch();
                if($access['Privilege'] == "VCM"){
                    echo "<li><a href='emails.php'><span class='text'>Pending Emails</span></a></li>";
                }
            } else{
                echo "<li><a href='staff_portal.php'><span class='text'>Back to portal</span></a></li>";
            }
            ?>
            <li>
                <a href="logout.php?msg=SuccessfullyLoggedOut">
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>