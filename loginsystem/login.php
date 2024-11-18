<html>
    <head>
        <title>WC Login Page</title>
        <link rel="stylesheet" type="text/css" href="CSS/login.css">
        <link rel="icon" type="image/x-icon" href="CSS/images/w-logo-blue.png">
    </head>
    <body>
        <div id="login_body">
            <img src="CSS/images/logo.png" alt="logo">
            <h2>Login</h2>
            <form action="../loginsystem/login.php" method="post">
                <label for id="login_email">Email</label>
                <input type="email" id="login_email"></input><br>
                <label for id="login_pass">Password</label>
                <input type="password" id="login_pass"></input><br>
                <input type="submit"></input>
            </form>
            <?php
            //If correct email and password (OPTIONAL: opens up security question form and if thats correct...):
            //1. Add session data for username and userID
            //If not correct email and password, add relevant error message
            //Locks login screen attempts after 5 times for x period
            ?>
        </div>
    </body>

</html>