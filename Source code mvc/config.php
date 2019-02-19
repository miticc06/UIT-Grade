<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

date_default_timezone_set('Asia/Krasnoyarsk');



/* Cấu hình apps */
$tokenfb = '';
$appsecretfb = '';
$verifyServicesFB = '';
  
$UsernameEmailSMTP = '@gmail.com'; 
$PasswordEmailSMTP = '';
$linkSite = 'https://gradeuit.kienthuc24h.com/';
/* Cấu hình apps */

?>