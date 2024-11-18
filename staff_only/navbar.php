<p>Hello Navbar</p>
<?php
if($_SERVER['REQUEST_URI'] === "/WCContactDB/staff_only/partners.php" or "/WCContactDB/staff_only/clients.php"){
    echo "<li><a href='staff_portal.php'>Back to portal</a></li>";
} 
echo "<li><a href='logout.php'>Logout</a></li>";
?>