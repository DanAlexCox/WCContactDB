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