<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>HTML FORM</h1>
    <div class="container">
        <form action="connect.php" method="post">
            <div class="">
                <label>Name</label>
                <input type="text" name="name" required placeholder="enter your name">
            </div>
            <div class="">
                <label>email</label>
                <input type="email" name="email" required placeholder="enter your email">
            </div>
            <div class="genderContainer">
                <label>Gender</label>
                <input class='gender1' required type="radio" value="m" name="gender">Male
                <input class='gender1' required type="radio" value="f" name="gender">Female
                <input class='gender1' required type="radio" value="o" name="gender">Others
            </div>
            <div class="">
                <label>Mobile</label>
                <input type="text" required name="mobile" placeholder="+234..">
            </div>
            <div class="">
                <label>Password</label>
                <input type="password" required name="password" placeholder="enter your password..">
            </div>
            <div class="btn">
                <button type="submit">Submit Data</button>
            </div>
        </form>
    </div>
</body>
</html>