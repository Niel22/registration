<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'connect.php';

    function val($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = val($_POST['username']);
        $password = val($_POST['password']);

    $stmt = $conn->prepare('SELECT * FROM registration WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows  == 1){
        while($row = $result->fetch_assoc()){
            if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['username'] = $username;
                header('location:home.php');

            }else{
                header('location:login.php?error=Incorrect Password');
            }
        }
    }else {
        header('location:login.php?error=Username does not exist');
    }
    $stmt->close();
}
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login Page</title>
  </head>
  <body>
    <h1 class="text-center">Login Page</h1>
    <div class="container mt-5">

        <?php
        if(isset($_GET['error'])){
        ?>
        <div class="alert alert-danger" role="alert">
        <?= $_GET['error'];?>
        </div>
        <?php } ?>

    <form action="login.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Name</label>
        <input type="text" class="form-control" name="username" required placeholder="enter your username">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required placeholder="enter your password">
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    </div>
  </body>
</html>