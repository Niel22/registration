<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'forms';

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("ConnectError". $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    function val($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = val($_POST['name']);
    $email = val($_POST['email']);
    $gender = val($_POST['gender']);
    $mobile = val($_POST['mobile']);
    $password = password_hash(val($_POST['password']), PASSWORD_DEFAULT);

    $stmt = $conn->prepare('INSERT INTO `data` (name,email,gender,mobile,password) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $name, $email, $gender, $mobile, $password);
    $result = $stmt->execute();

    if($result){
        header('location:connect.php');
        echo "Submitted Successfully";
    }

}
?>