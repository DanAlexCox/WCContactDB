<?php
include "connectdb.php";

if(isset($_POST['regpartner'])){
    $neworg = $_POST['Organisation'];
    $newpc = $_POST['Postcode'];
    $newname = htmlspecialchars($_POST['Prefix']) . " " . htmlspecialchars($_POST['Forename']) . " " . htmlspecialchars($_POST['Surname']);
    $neweml = $_POST['EmailAddress'];

    $ptnr_query = "INSERT `partners`(partner_name, address, representative, partner_email) VALUES (:pn, :ad, :rep, :pe)";
    $ptnr_stmt = $pdo->prepare($ptnr_query);
    $ptnr_stmt->bindParam(':pn', $neworg);
    $ptnr_stmt->bindParam(':ad', $newpc);
    $ptnr_stmt->bindParam(':rep', $newname);
    $ptnr_stmt->bindParam(':pe', $neweml);
    
    if($ptnr_stmt->execute()){
        $msg = "Added successfully";
        header("Location: partners.php?msg=".$msg);
        exit();
    } else {
        $error = "Error adding. Please try again.";
        header("Location: addpartner.php?error=".$msg);
        exit();
    }
}   



?>