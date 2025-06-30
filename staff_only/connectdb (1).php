<?php
  $servername = "ams203.greengeeks.net";
  $databasename = "womensc1_wc";
  $username = "womensc1_user";
  $password = "87J1=jdwOvi&";
  
  try {
    $pdo = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>