<?php
include "connectdb.php";

if(isset($_POST['regclient'])){
    $newpref = htmlspecialchars($_POST['Prefix']);
    $newfore = htmlspecialchars($_POST['Forename']);
    $newsur = htmlspecialchars($_POST['Surname']);
    $newgend = $_POST['Gender'];
    $newage = $_POST['Age'];
    $newreli = $_POST['Religion'];
    $neweml = $_POST['EmailAddress'];

    $clnt_query = "INSERT `clients`(Email, Prefix, Forename, Surname, Gender, Age, Religion) VALUES (:ce, :pr, :fn, :sn, :gd, :ag, :rg)";
    $clnt_stmt = $pdo->prepare($clnt_query);
    $clnt_stmt->bindParam(':ce', $neweml);
    $clnt_stmt->bindParam(':pr', $newpref);
    $clnt_stmt->bindParam(':fn', $newfore);
    $clnt_stmt->bindParam(':sn', $newsur);
    $clnt_stmt->bindParam(':gd', $newgend);
    $clnt_stmt->bindParam(':ag', $newage);
    $clnt_stmt->bindParam(':rg', $newreli);
    
    if($clnt_stmt->execute()){
        $msg = "Added successfully.";
        header("Location: clients.php?msg=".$msg);
        exit();
    } else {
        $error = "Error adding. Please try again.";
        header("Location: addclients.php?error=".$error);
        exit();
    }
}   



?>