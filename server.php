<?php

// Database connection details
// $servername = "localhost";
// $username = "if0_40217992";
// $password = "azthtaquFOOc";
// $dbname = "promptPayqr";
// $mysqli = new mysqli("localhost", "if0_40217992","azthtaquFOOc","promptPayqr");

// // Create a new database connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// $link = mysqli_connect($servername, $username, $password, $dbname);
// if ($link->connect_error) {
//     die("Connection failed: " . $link->connect_error);
// }
// $con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// }
// mysqli_query($con, "SET NAMES 'utf8' ");
// date_default_timezone_set('Asia/Bangkok');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "promptpayqr";
// $mysqli = new mysqli("localhost", "root","","promptpayqr");

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$link = mysqli_connect($servername, $username, $password, $dbname);
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}


?>