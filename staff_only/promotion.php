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
            <h3>IMPORTANT: Submitting emails will queue up and send up to 200 emails every hour</h3>
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
                        <div id="selecttext">
                            <h2>Select a preset layout</h2>
                            <p>Note: Some sizes aren't accurate compared to actual sizes (select one for better preview)</p>
                        </div>
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
                    //select
                    ?>
                    <form method="post" action="promotion.php" id="customselect">
                        <h2>Select a custom option</h2>
                        <select name="customchoice">
                            <option value="">--SELECT--</option>
                            <option value="import">Import image</option>
                            <option value="blank">Blank page</option>
                        </select>
                        <input type="hidden" name="layoutchoice">
                        <button type="submit" name="customsubmit">Submit</button>
                    </form>
                    <?php
                } elseif(isset($_POST['presetsubmit'])){
                    //if preset layout selected customise
                    $layoutID = htmlspecialchars($_POST['layoutoption']);

                    $singleStmt = "SELECT * FROM `layout` WHERE Layout_ID = :lid";
                    $singleSQL = $pdo->prepare($singleStmt);
                    $singleSQL->bindParam(":lid", $layoutID, PDO::PARAM_INT);
                    $singleSQL->execute();
                    $singleData = $singleSQL->fetch();

                    $stringBody = $singleData['Body'];

                    ?>
                    <!-- form for inserting information into preview email -->
                    <div id="insertsection">
                        <form method="post" action="sendpromo.php" id="insertform" onsubmit="presetSendConfirm()">
                            <?php 
                            if(str_contains($stringBody, "!!SUBJECT!!")){
                                ?>
                                <label for="subject">Email Subject</label>
                                <input type="text" name="subject" id="subject" placeholder="!!SUBJECT!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!HEADER!!")){
                                ?>
                                <label for="heading">Heading</label>
                                <input type="text" name="heading" id="heading" placeholder="!!HEADER!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT TEXT!!")){
                                ?>
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" placeholder="!!EVENT TEXT!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT TITLE 1!!")){
                                ?>
                                <label for="title1">Title 1</label>
                                <input type="text" name="title1" id="title1" placeholder="!!EVENT TITLE 1!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT SUBTITLE 1")){
                                ?>
                                <label for="title1">Subtitle 1</label>
                                <input type="text" name="subtitle1" id="subtitle1" placeholder="!!EVENT SUBTITLE 1!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT TITLE 2!!")){
                                ?>
                                <label for="title2">Title 2</label>
                                <input type="text" name="title2" id="title2" placeholder="!!EVENT TITLE 2!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT SUBTITLE 2!!")){
                                ?>
                                <label for="subtitle2">Subtitle 2</label>
                                <input type="text" name="subtitle2" id="subtitle2" placeholder="!!EVENT SUBTITLE 2!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT TITLE 3!!")){
                                ?>
                                <label for="title3">Title 3</label>
                                <input type="text" name="title3" id="title3" placeholder="!!EVENT TITLE 3!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT SUBTITLE 3!!")){
                                ?>
                                <label for="subtitle3">Subtitle 3</label>
                                <input type="text" name="subtitle3" id="subtitle3" placeholder="!!EVENT SUBTITLE 3!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT TITLE 4!!")){
                                ?>
                                <label for="title4">Title 4</label>
                                <input type="text" name="title4" id="title4" placeholder="!!EVENT TITLE 4!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT SUBTITLE 4!!")){
                                ?>
                                <label for="subtitle4">Subtitle 4</label>
                                <input type="text" name="subtitle4" id="subtitle4" placeholder="!!EVENT SUBTITLE 4!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT TITLE 5!!")){
                                ?>
                                <label for="title5">Title 5</label>
                                <input type="text" name="title5" id="title5" placeholder="!!EVENT TITLE 5!!">
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT SUBTITLE 5!!")){
                                ?>
                                <label for="subtitle5">Subtitle5</label>
                                <input type="text" name="subtitle5" id="subtitle5" placeholder="!!EVENT SUBTITLE 5!!" required>
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT TITLE 6!!")){
                                ?>
                                <label for="title6">Title 6</label>
                                <input type="text" name="title6" id="title6" placeholder="!!EVENT TITLE 6!!">
                                <?php
                            }
                            if(str_contains($stringBody, "!!EVENT SUBTITLE 6!!")){
                                ?>
                                <label for="subtitle6">Subtitle 6</label>
                                <input type="text" name="subtitle6" id="subtitle6" placeholder="!!EVENT SUBTITLE 6!!">
                                <?php
                            }
                            ?>
                            <input type="hidden" name="layoutid" value="<?php echo $layoutID; ?>">
                            <button type="submit" name="presetfinish">Send</button>
                        </form>
                    </div>

                    <!--Show preview for email-->
                    <template id="previewsection">
                        <?php echo $stringBody; ?>
                    </template>

                    <div id="stringBodyContainer"></div>

                    <script>
                        const container = document.getElementById("stringBodyContainer");
                        const template = document.getElementById("previewsection");

                        const placeholderConfig = {
                            "!!SUBJECT!!": "subject",
                            "!!HEADER!!": "heading",
                            "!!EVENT TEXT!!": "description",
                            "!!EVENT TITLE 1!!": "title1",
                            "!!EVENT SUBTITLE 1!!": "subtitle1",
                            "!!EVENT TITLE 2!!": "title2",
                            "!!EVENT SUBTITLE 2!!": "subtitle2",
                            "!!EVENT TITLE 3!!": "title3",
                            "!!EVENT SUBTITLE 3!!": "subtitle3",
                            "!!EVENT TITLE 4!!": "title4",
                            "!!EVENT SUBTITLE 4!!": "subtitle4",
                            "!!EVENT TITLE 5!!": "title5",
                            "!!EVENT SUBTITLE 5!!": "subtitle5",
                            "!!EVENT TITLE 6!!": "title6",
                            "!!EVENT SUBTITLE 6!!": "subtitle6"
                        };

                        const placeholders = {};
                        for (const [placeholder, id] of Object.entries(placeholderConfig)) {
                            const input = document.getElementById(id);
                            if (input) {
                                placeholders[placeholder] = input;
                            }
                        }

                        function getOriginalTemplateHTML() {
                            return template.innerHTML;
                        }

                        function renderBody() {
                            let rawHTML = getOriginalTemplateHTML();
                            for (const [placeholder, input] of Object.entries(placeholders)) {
                                const value = input.value || "";
                                const regex = new RegExp(placeholder, 'g');
                                rawHTML = rawHTML.replace(regex, value);
                            }
                            container.innerHTML = rawHTML;
                        }

                        for (const input of Object.values(placeholders)) {
                            input.addEventListener("input", renderBody);
                        }

                        renderBody();
                    </script>
                    <?php
                } elseif(isset($_POST['customsubmit'])){
                    if($_POST['customchoice'] == "import"){
                        //if customchoice == "import", reveal import form and preview email after importing in html
                        ?>
                        <form method="post" action="addpendingemail.php" id="importform" enctype="multipart/form-data" onsubmit="return customQueueConfirm()">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Insert title here" required>
                            <label for="posterimport">Import poster file</label>
                            <input type="file" name="posterimport" id="posterimport" accept="image/*">
                            <input type="hidden" name="emailtype" value="allclients">
                            <input type="hidden" name="addpending">
                            <button type="submit" name="importfinish">Send to queue</button>
                        </form>

                        <template id="previewsection">
                            <div id="imagePreviewWrapper">
                                <p><strong>Poster Preview:</strong></p>
                                <img id="imagePreview" src="" alt="Poster preview" style="max-width: 70%; display: none;" />
                            </div>
                        </template>

                        <div id="stringBodyContainer"></div>

                        <script>
                            const fileInput = document.getElementById("posterimport");

                            const previewTemplate = document.getElementById("previewsection");
                            const previewClone = previewTemplate.content.cloneNode(true);
                            document.getElementById("stringBodyContainer").appendChild(previewClone);

                            const previewImage = document.getElementById("imagePreview");

                            fileInput.addEventListener("change", function () {
                                const file = this.files[0];

                                if (!file) {
                                    previewImage.style.display = "none";
                                    previewImage.src = "";
                                    return;
                                }

                                if (!file.type.startsWith("image/")) {
                                    alert("Please select a valid image file.");
                                    previewImage.style.display = "none";
                                    previewImage.src = "";
                                    return;
                                }

                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    previewImage.src = e.target.result;
                                    previewImage.style.display = "block";
                                };
                                reader.readAsDataURL(file);
                            });
                            </script>
                        <?php


                    } elseif($_POST['customchoice'] == "blank"){
                        //if customchoice == "blank", reveal form similar to partners/client email send forms
                        ?>
                        <form method="post" action="addpendingemail.php" id="blankform" onsubmit="customQueueConfirm()">
                            <label for='title'>Title</label><br>
                            <input type='text' id='title' name='title' placeholder='Insert title' required><br>
                            <label for='description'>Description</label><br>
                            <textarea id='description' name='description' placeholder='Insert details here'></textarea><br>
                            <input type="hidden" name="emailtype" value="allclients">
                            <input type="hidden" name="addpending">
                            <button type='submit' name="blankfinish">Send to queue</button>
                        </form>

                        <template id="previewsection">
                            <div id="emailPreview" style="border:1px solid #ccc; padding:10%; margin-top:10%; max-width:80%;">
                                <h2 id="previewTitle" style="margin-top:0;"></h2>
                                <p id="previewDescription" style="white-space:pre-wrap;"></p>
                            </div>
                        </template>

                        <div id="stringBodyContainer"></div>

                        <script>
                            const previewClone = document.getElementById("previewsection").content.cloneNode(true);
                            document.getElementById("stringBodyContainer").appendChild(previewClone);

                            const titleInput = document.getElementById("title");
                            const descriptionInput = document.getElementById("description");
                            const previewTitle = document.getElementById("previewTitle");
                            const previewDescription = document.getElementById("previewDescription");

                            function updatePreview() {
                                previewTitle.textContent = titleInput.value || "Your title will appear here";
                                previewDescription.textContent = descriptionInput.value || "Your description will appear here";
                            }

                            updatePreview();

                            titleInput.addEventListener("input", updatePreview);
                            descriptionInput.addEventListener("input", updatePreview);
                        </script>
                        <?php
                    } else{
                        $error = "Invalid promo input.";
                        header("Location: promotion.php?error=".urlencode($error));
                        exit();
                    }
                } else{
                    $error = "Invalid promo input.";
                    header("Location: promotion.php?error=".urlencode($error));
                    exit();
                }
            } else{
                //Select between preset and customisable layout
                ?>
                <form method="post" action="promotion.php">
                    <h2>Select an layout option</h2>
                    <select name="layoutchoice">
                        <option value="">--SELECT--</option>
                        <!-- <option value="preset">Preset Layout (Needs extra work)</option> -->
                        <option value="custom">Custom Layout (Import/blank email)</option>
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