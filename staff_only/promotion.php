<?php
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
        <title>Promotion</title>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
        <link rel="stylesheet" type="text/css" href="CSS/promotion.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
        <script defer src="JS/script.js"></script>
        <script src="JS/timer.js" defer></script>
        <script src="JS/email.js" defer></script>
    </head>
    
    <body>
        <?php
        include "navbar.php";
        ?>
        <div class="promobody">
            <?php
            if(isset($_POST['layoutchoice'])){
                ?><form method="post" action="promotion.php" id="reset">
                    <button type="submit" name="resetbutton">Go Back</button>
                </form><?php
                //If promoselect="preset" Select from preset layouts
                if($_POST['layoutchoice'] == "preset"){
                    $layoutStmt = "SELECT * FROM `layout`";
                    $layoutSQL = $pdo->query($layoutStmt);
                    $layoutSQL->execute();
                    ?>
                    <form method="post" action="promotion.php" id="presetselect">
                        <h2>Select a preset layout</h2>
                        <div id="layoutbody">
                            <?php
                            foreach($layoutSQL as $layout){
                                ?>
                                <div class="layoutradio">
                                    <input type="radio" name="layoutoption" id="layout_<?php echo htmlspecialchars($layout['Layout_ID']); ?>" value="<?php echo htmlspecialchars($layout['Layout_ID']); ?>">
                                    <label for="layout_<?php echo htmlspecialchars($layout['Layout_ID']);?>">
                                        <?php echo htmlspecialchars($layout['Name']); ?>
                                    </label>
                                    <?php echo $layout['Body']; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <input type="hidden" name="layoutchoice">
                        <button type="submit" name="presetsubmit">Submit</button>
                    </form>
                    <?php            

                //If promoselect="custom"  open form list for all available valid customisations (logo, title, promonavbar etc.)
                } elseif($_POST['layoutchoice'] == "custom"){
                    
                    // change css accordingly
                } elseif(isset($_POST['presetsubmit'])){
                    //if preset layout selected customise
                    $layoutID = htmlspecialchars($_POST['layoutoption']);

                    $singleStmt = "SELECT * FROM `layout` WHERE Layout_ID = :lid";
                    $singleSQL = $pdo->prepare($singleStmt);
                    $singleSQL->bindParam(":lid", $layoutID, PDO::PARAM_INT);
                    $singleSQL->execute();
                    $singleData = $singleSQL->fetch();

                    ?>
                    <!-- form for inserting information into preview email -->
                    <div id="insertsection">
                        <form method="post" action="sendpromo.php" id="insertform" onsubmit="presetSendConfirm()">
                            <label for="heading">Heading</label>
                            <input type="text" name="heading" placeholder="!!HEADER!!" required>
                            <label for="title1">Title 1</label>
                            <input type="text" name="title1" placeholder="!!EVENT TITLE 1!!" required>
                            <label for="title1">Subtitle 1</label>
                            <input type="text" name="subtitle1" placeholder="!!EVENT SUBTITLE 1!!" required>
                            <label for="title2">Title 2</label>
                            <input type="text" name="title2" placeholder="!!EVENT TITLE 2!!" required>
                            <label for="subtitle2">Subtitle 2</label>
                            <input type="text" name="subtitle2" placeholder="!!EVENT SUBTITLE 2!!" required>
                            <label for="title3">Title 3</label>
                            <input type="text" name="title3" placeholder="!!EVENT TITLE 3!!" required>
                            <label for="subtitle3">Subtitle 3</label>
                            <input type="text" name="subtitle3" placeholder="!!EVENT SUBTITLE 3!!" required>
                            <label for="title4">Title 4</label>
                            <input type="text" name="title4" placeholder="!!EVENT TITLE 4!!" required>
                            <label for="subtitle4">Subtitle 4</label>
                            <input type="text" name="subtitle4" placeholder="!!EVENT SUBTITLE 4!!" required>
                            <label for="title5">Title 5</label>
                            <input type="text" name="title5" placeholder="!!EVENT TITLE 5!!">
                            <label for="subtitle5">Subtitle5</label>
                            <input type="text" name="subtitle5" placeholder="!!EVENT SUBTITLE 5!!" required>
                            <label for="title6">Title 6</label>
                            <input type="text" name="title6" placeholder="!!EVENT TITLE 6!!">
                            <label for="subtitle6">Subtitle 6</label>
                            <input type="text" name="subtitle6" placeholder="!!EVENT SUBTITLE 6!!">
                            <input type="hidden" name="layoutid" value="<?php echo $layoutID; ?>">
                            <button type="submit" name="presetfinish">Send</button>
                        </form>
                    </div>
                    <!--Show preview for email-->
                    <div id="previewsection">
                        <?php echo $singleData['Body']; ?>
                    </div>
                    <?php
                }else{
                }
                
                //Confirm button, after confirmation, sends email to all
            } else{
                //Select between preset and customisable layout
                ?>
                <form method="post" action="promotion.php">
                    <h2>Select an layout option</h2>
                    <select name="layoutchoice">
                        <option value="">--Select--</option>
                        <option value="preset">Preset Layout</option>
                        <option value="custom">Custom Layout</option>
                    </select>
                    <button type="submit" name="layoutbtn">Proceed</button>
                </form>
                <?php
            }
            ?>
            <!-- Send email to all clients (Until upload, send only to personal email) -->
        </div>
    </body>
</html>