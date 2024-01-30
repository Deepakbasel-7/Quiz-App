<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userquiz";

$conn = mysqli_connect('localhost','root','','userquiz');

if (!$conn)
 {
    die("Connection failed: " . mysqli_connect_error());
}

?>
 