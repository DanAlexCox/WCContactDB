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
    - addpartner.php
3. vendor holds phpmailer and composer files

List of bugs reported:
1. N/A

Future improvements:
1. login.php - locks out of logging in after 5-10 tries