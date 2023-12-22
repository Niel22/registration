<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'signupform';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection ERrro" . $conn->connect_error);
}
?>