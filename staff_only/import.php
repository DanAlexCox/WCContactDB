<?php
require '../vendor/autoload.php';

session_start();
include "connectdb.php";

if(isset($_GET['error'])){
    // Sanitize the message to prevent XSS
    $error = htmlspecialchars($_GET['error']);
    // Display a JavaScript alert with the message
    echo "<script>alert('$error');</script>";
}

if(isset($_GET['msg'])){
    // Sanitize the message to prevent XSS
    $msg = htmlspecialchars($_GET['msg']);
    // Display a JavaScript alert with the message
    echo "<script>alert('$msg');</script>";
}

if(!isset($_SESSION['User_ID'])){
    $msg = 'Must sign in again.';
    session_unset();
    session_destroy();
    header("Location: ../loginsystem/login.php?msg=".urlencode($msg));
    exit();
}
?>
<html>
    <head>
        <title>Import</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/import.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
        <script src="JS/email.js" defer></script>
    </head>
    
    <body>
        <?php
        include "navbar.php";
        ?>
        <div id="importbody">
            <?php
            if(!isset($_POST['importchoice'])){
                ?>
                <h1>Import new clients</h1>
                <?php
                //Form for selecting import method
                ?>
                <form method="post" action="import.php" id="importmethod">
                    <h2>Select the type of import you would like to proceed with</h2>
                    <select name="importchoice">
                        <option value="new">Add New Clients</option>
                        <option value="update">Update Existing Clients</option>
                    </select>
                    <button type="submit">Proceed</button>
                </form>
                <?php
            } else{
                if($_POST['importchoice'] == "new"){
                    if(!isset($_POST['newimportchoice'])){
                        //Form to select import method for new client/s
                        ?>
                        <form method="post" action="import.php" id="newmethod">
                            <h2>How would you like to import new client/s?</h2>
                            <select name="newimportchoice">
                                <option value="manual">Manually for singular client</option>
                                <option value="group">Automatically via spreadsheet</option>
                            </select>
                            <input type="hidden" name="importchoice" value="new">
                            <button type="submit">Proceed</button>
                        </form>
                        <?php
                    } elseif($_POST['newimportchoice'] =="manual"){
                        //Form to add single client
                        header("Location: addclient.php");
                        exit();
                    } elseif($_POST['newimportchoice'] == "group"){
                        //Form to import spreadsheet of clients
                        ?>
                        <form method="post" action="import.php" id="newspreadsheet" enctype="multipart/form-data">
                            <label for="posterimport">Import a valid spreadsheet file</label>
                            <input type="file" name="spreadsheetimport" id="spreadsheetimport" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                            <input type="hidden" name="importchoice" value="new">
                            <input type="hidden" name="newimportchoice" value="group">
                            <button type="submit" name="newspreadsheet">Import</button>
                        </form>
                        <?php
                        if(isset($_POST['newspreadsheet'])){
                            //read imported file
                            $uploadDir = 'uploads/';
                            $uploadNam = basename($_FILES['spreadsheetimport']['name']);
                            $uploadFile = $uploadDir.$uploadNam;

                            if (move_uploaded_file($_FILES['spreadsheetimport']['tmp_name'], $uploadFile)) {

                                $inputFileName = $uploadFile;
                                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                                $reader->setReadEmptyCells(false);
                                $spreadsheet = $reader->load($inputFileName);

                                $sheet = $spreadsheet->getActiveSheet();

                                $dataArray = $sheet->toArray();

                                $emailColIndex = null;
                                $emailRowIndex = null;
                                //Find row with name "Email"
                                foreach ($dataArray as $rowIndex =>$row) {
                                    foreach ($row as $colIndex => $cellValue) {
                                        if (!empty($cellValue) && trim($cellValue) === "Email") {
                                            $emailColIndex = $colIndex; // 0-based column index
                                            $emailRowIndex = $rowIndex; // 0-based row index
                                            break 2;
                                        }
                                    }
                                }

                                if ($emailColIndex !== null) {
                                    // Get emails from rows below the header
                                    $emails = [];
                                    for ($i = $emailRowIndex + 1; $i < count($dataArray); $i++) {
                                        $email = $dataArray[$i][$emailColIndex] ?? null;
                                        if (!empty($email)) {
                                            $emails[] = $email;
                                        }
                                    }

                                    $keyholder = [];
                                    $paramholders = [];
                                    foreach ($emails as $index => $email){
                                        $key = ":eml$index";
                                        $keyholder[] = $key;
                                        $paramholders[$key] = $email;
                                    }

                                    $addEmailStmt = "INSERT INTO `clients` (Email) VALUES (".implode('), (', $keyholder).");";

                                    $addEmailSQL = $pdo->prepare($addEmailStmt);
                                    foreach($paramholders as $pkey => $param){
                                        $addEmailSQL->bindValue($pkey, $param);
                                    }
                                    
                                    $addEmailSQL->execute();

                                    unlink($uploadFile);
                                    $msg = "Successfully imported.";
                                    header("Location: import.php?msg=".urlencode($msg));
                                    exit();
                                } else {
                                    echo "'Email' header not found.\n";
                                }
                            } else {
                                ?><p style="color:red;">File upload failed</p><?php
                            }
                        } else {
                            $error = "Invalid input.";
                            header("Location: import.php?error=".urlencode($error));
                            exit();
                        }
                    } else{
                        $error = "Invalid input.";
                        header("Location: import.php?error=".urlencode($error));
                        exit();
                    }
                } elseif($_POST['importchoice'] == "update"){
                    //Form to update single client
                    header("Location: modifyclient.php");
                    exit();
                } else{
                    $error = "Invalid input.";
                    header("Location: import.php?error=".urlencode($error));
                    exit();
                }
            }
            ?>
        </div>
    </body>
</html>