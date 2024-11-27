<?php
session_start();
include "connectdb.php";
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$inputPass = $input['password'] ?? '';

try {
    $check_query = "SELECT * FROM `staff_user` WHERE staff_email = :email AND username = :user";
    $chck = $pdo->prepare($check_query);
    $chck->bindParam(':email', $_SESSION['useremail']);
    $chck->bindParam(':user', $_SESSION['username']);
    $chck->execute();
    $user = $chck->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($inputPass, $user['password'])) {
        $_SESSION['passgood'] = $inputPass; // Set session flag
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Incorrect password.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'An error occurred during verification.']);
}
?>