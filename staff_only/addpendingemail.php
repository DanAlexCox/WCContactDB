<?php
include "connectdb.php";
//Check subject and Layout_ID is selected to be used for emailqueue table
if(isset($_POST['addpending'])){
    $subject = htmlspecialchars($_POST['title']);
    $body = $_POST['description'];

    //Select correct email type and receive client ids
    $emailType = $_POST['emailtype'];
    $clientList = [];
    if($emailType == "allclients"){
        $clientList = [];
        $selectAll = "SELECT Client_ID FROM `clients`";
        $selectAllSQL = $pdo->query($selectAll);
        $selectAllSQL->execute();

        foreach($selectAllSQL as $clientID){
            $clientList[] = $clientID['Client_ID'];
        }
    } elseif($emailType == "selectclients"){
        $clientList = $_POST['clientlist'];
    } else{
        $error = "No email type selected.";
        header("Location: promotion.php?error=".$error);
        exit();
    }

    //Add queue entry for all selected clients
    for($i=0; $i < count($clientList); $i++){
        $clientID = $clientList[$i];
        $newQueueEmail = "INSERT INTO `emailqueue` (Subject, Body, Client_ID) VALUES (:sub, :bod, :cid);";
        $newQueueEmailSQL = $pdo->prepare($newQueueEmail);
        $newQueueEmailSQL->bindParam(":sub", $subject);
        $newQueueEmailSQL->bindParam(":bod", $body);
        $newQueueEmailSQL->bindParam(":cid", $clientID, PDO::PARAM_INT);
        $newQueueEmailSQL->execute();
    }
    $msg = "Queued successfully.";
    header("Location: promotion.php?msg=".$msg);
    exit();
}
?>