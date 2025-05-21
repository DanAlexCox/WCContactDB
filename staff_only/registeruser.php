<?php
session_start();
include('connectdb.php');
        if(isset($_POST['registerbtn'])) {
            $address = $_POST['new_email'];

            $check_query = "SELECT COUNT(*) FROM `staff_user` WHERE Staff_email = :email";
            $check_stmt = $pdo->prepare($check_query);
            $check_stmt->bindParam(':email', $address);
            $check_stmt->execute();
            $existing_user = $check_stmt->fetchColumn();

            if($existing_user == 0) {
                $create_query = "INSERT INTO `staff_user` (staff_email) VALUES (:se)";
                $create_stmt = $pdo->prepare($create_query);
                $create_stmt->bindParam(':se', $address);

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
        ?>