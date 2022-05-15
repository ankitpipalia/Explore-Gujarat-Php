<?php
/*
This file contains database configuration assuming you are running mysql using user "root" and password ""
*/

define('DB_SERVERS', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root1234');
define('DB_NAME', 'gujarat');

// Try connecting to the Database
$conn = mysqli_connect(DB_SERVERS, DB_USERNAME, DB_PASSWORD, DB_NAME);

//Check the connection
if($conn == false){
    dir('Error: Cannot connect');
}

?>