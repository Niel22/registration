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
        $password = password_hash(val($_POST['password']), PASSWORD_DEFAULT);

    $stmt = $conn->prepare('SELECT * FROM registration WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        header('location:sign.php?error=Username ALready Exist');
    }else {
        $stmt = $conn->prepare('INSERT INTO registration (`username`, `password`) VALUES (? , ?)');
        $stmt->bind_param('ss', $username, $password);
        $result = $stmt->execute();

        if($result){
            header('location:sign.php?success=Registered Successful');
        }
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

    <title>Signup Page</title>
  </head>
  <body>
    <h1 class="text-center">Signup Page</h1>
    <div class="container mt-5">
        <?php
        if(isset($_GET['success'])){
        ?>
        <div class="alert alert-success" role="alert">
            <?= $_GET['success'];?>
        </div>
        <?php } ?>

        <?php
        if(isset($_GET['error'])){
        ?>
        <div class="alert alert-danger" role="alert">
        <?= $_GET['error'];?>
        </div>
        <?php } ?>

    <form action="sign.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Name</label>
        <input type="text" class="form-control" name="username" required placeholder="enter your username">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required placeholder="enter your password">
      </div>
      <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
    </div>
  </body>
</html>