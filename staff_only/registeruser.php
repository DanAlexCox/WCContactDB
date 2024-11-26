<?php
session_start();
include('connectdb.php');
        if(isset($_POST['registerbtn'])) {
            $address = $_POST['new_email'];
            $new_username = $_POST['new_username'];
            $new_password = $_POST['new_password'];
    
            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&:)].*[@$!%*?&:)])[A-Za-z\d@$!%*?&:)]{8,}$/', $new_password)) {
                $error = "Password must be at least 8 characters long and contain at least one number and one special character.";
                header("Location: staff_portal.php?error=".$error);
                exit();
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $check_query = "SELECT COUNT(*) FROM `staff_user` WHERE Username = :username";
                $check_stmt = $pdo->prepare($check_query);
                $check_stmt->bindParam(':username', $new_username);
                $check_stmt->execute();
                $existing_user = $check_stmt->fetchColumn();

                if($existing_user == 0) {
                    $create_query = "INSERT INTO `staff_user` (staff_email, username, password) VALUES (:se, :us, :pa)";
                    $create_stmt = $pdo->prepare($create_query);
                    $create_stmt->bindParam(':se', $address);
                    $create_stmt->bindParam(':us', $new_username);
                    $create_stmt->bindParam(':pa', $hashed_password);

                    if($create_stmt->execute()) {
                        $msg = "Registered successfully";
                        header("Location: staff_portal.php?msg=".$msg);
                        exit();
                    } else {
                        $error = "Error creating user. Please try again.";
                        header("Location: staff_portal.php?error=".$msg);
                        exit();
                    }
                } else {
                    $error = "Username already exists. Please choose a different username.";
                    header("Location: staff_portal.php?error=".$error);
                    exit();
                }
            }
        }
        ?>