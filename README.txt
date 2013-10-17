Overview:

This sample application provides an example Diabetes Manager that makes use of an Entra Glucometer
and a Fitbit Aria Wi-Fi Smart Scale.  There is support for multiple users where each user can login and register
their own glucometer and weight scale.  Users are managed with a simple SQLite database.

Requirements:

* PHP 5.4
* SQLite 3
* 2net Connect API key/secret.  See http://www.qualcommlife.com/

Files:

* 2net.ini - Configuration for API key/secret and server endpoint
* 2net.php - Sample 2net Connect API core interface
* 2net_partner.php - Sample 2net Connect API partner interface
* sample.php - Sample application class
* index.php - Main index page which displays device readings
* login.php - Login page
* logout.page - Logout page
* devices.php - Device management
* session.php - User session validation

Database:

* sample.sqlite - SQLite database for users
