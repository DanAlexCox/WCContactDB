# WCContactDB

Client and Partner Contact system for Women's Consortium by Daniel Cox

loginsystem:
1. connectdb.php - connects to pdo database
2. login.php - login to the staff_only section
3. CSS
    - login.css
    - images folder
4. JS (empty)

staff_only:
1. addclient.php - holds form for adding a client
2. addclientconfirmed.php - adds a new client to the database when successfully submitted
3. addpartner.php - holds form for adding a partner
4. addpartnerconfirmed.php - adds a new partner to the database when successfully submitted
5. check_password.php - verifies user password before sending any email
6. clients.php - main section for viewing abilities linked to clients
7. connectdb.php - connects to pdo database
8. logout.php - ends login session and sends to loginsystem/login.php
9. modifyclient.php - holds form for modifying a client's details
10. modifypartner.php - holds form for modifying a partner's details
11. navbar.php - holds section for left side navbar
12. partners.php - main section for viewing abilities linked to partners
13. registeruser.php - registers a user to be able to login to staff_only
14. sendcemail.php - phpmailer script for sending a client email
15. sendpemail.php - phpmailer script for sending a partner email
16. staff_portal.php - first page upon successful login and includes register user and sends to registeruser.php
17. CSS:
    - addclient.css - CSS for addclient.php
    - addpartner.css - CSS for addpartner.php
    - client.css - CSS for clients.php
    - main.css - main CSS theme for staff_only
    - modclient.css - CSS for modifyclient.php
    - modpartner.css - CSS for modifypartner.php
    - navbar.css - CSS for navbar.php
    - partner.css - CSS for partners.php
    - images folder
18. JS:
    - email.js - script for opening and closing an email form via partners.php and clients.php
    - script.js - script for verifying password and adding a partner or client
    - timer.js - script for session timeout

vendor holds phpmailer and composer files

List of bugs reported:
1. partner.php:
    - blank space under modify buttons are included with the a href link
2. client.php
    - blank space under modify buttons are included with the a href link
    - Error: Cannot modify header information - headers already sent by (output started at /home/womensc1/public_html/contactsys/staff_only/clients.php:69)
        when deleting a client
        - temp solution: use side navbar to refresh update the page
    - deletes only 1 user at a time when selecting multiple
    - ctrl+c doesnt work on contacting form
3. addclient.php
    - add email input is a text field not email field
    - may stay on addclientconfirmed.php
        temp solution: refresh page
4. sendc/pemail.php
    - doesn't take into account new lines or tab

Future improvements:
1. login.php - locks out of logging in after 5-10 tries