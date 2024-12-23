# WCContactDB

Client and Partner Contact system for Women's Consortium by Daniel Cox

Consists of:

1. loginsystem:
    - connectdb.php - connects to pdo database
    - login.php - login to the staff_only section
    - CSS
        a. login.css
        b. images folder
    - JS (empty)

2. staff_only:
    - addclient.php - holds form for adding a client
    - addclientconfirmed.php - adds a new client to the database when successfully submitted
    - addpartner.php - holds form for adding a partner
    - addpartnerconfirmed.php - adds a new partner to the database when successfully submitted
    - check_password.php - verifies user password before sending any email
    - clients.php - main section for viewing abilities linked to clients
    - connectdb.php - connects to pdo database
    - logout.php - ends login session and sends to loginsystem/login.php
    - modifyclient.php - holds form for modifying a client's details
    - modifypartner.php - holds form for modifying a partner's details
    - navbar.php - holds section for left side navbar
    - partners.php - main section for viewing abilities linked to partners
    - registeruser.php - registers a user to be able to login to staff_only
    - sendcemail.php - phpmailer script for sending a client email
    - sendpemail.php - phpmailer script for sending a partner email
    - staff_portal.php - first page upon successful login and includes register user and sends to registeruser.php
    - CSS:
        a. addclient.css - CSS for addclient.php
        b. addpartner.css - CSS for addpartner.php
        c. client.css - CSS for clients.php
        d. main.css - main CSS theme for staff_only
        e. modclient.css - CSS for modifyclient.php
        f. modpartner.css - CSS for modifypartner.php
        g. navbar.css - CSS for navbar.php
        h. partner.css - CSS for partners.php
        i. images folder
    - JS:
        a. email.js - script for opening and closing an email form via partners.php and clients.php
        b. script.js - script for verifying password and adding a partner or client
        c. timer.js - script for session timeout

3. vendor holds phpmailer and composer files

List of bugs reported:
1. partner.php:
    - blank space under modify buttons are included with the a href link
2. client.php
    - blank space under modify buttons are included with the a href link

Future improvements:
1. login.php - locks out of logging in after 5-10 tries