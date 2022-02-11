<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $showerror = false;
    $showalert = false;
    include 'partials/dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists = false;
    // ALTER TABLE `users` ADD UNIQUE(`username`);
    // check whether this username existlist
    $exists=false;
$existsql="SELECT * FROM `users` WHERE username='$username';";
$existresult=mysqli_query($conn,$existsql);
$numexistrows=mysqli_num_rows($existresult);
if($numexistrows>0){
    $exists=true;
}
else{
    $exists=false;
    if (($password == $cpassword)) {
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$hash');";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showalert = true;
        }
    }
    else{
        $showerror=true;
    }
}
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
    <title>SIGNUP page</title>
    <style>
        .container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    require 'partials/nav.php';
    ?>
    <?php
    if ($showalert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>success!</strong> your account is now created and you can login.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    }
    if ($showerror) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>Fail</strong> password not match 
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    }
    if($exists){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Fail</strong> you are already exists 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";  
    }

    ?>
    <div class="container my-3">
        <h1 class="text-center">signup to our website</h1>
        <form class="my-4" action="/soham/signup.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" maxlength="20">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name="password" maxlength="30">
                <div id="emailHelp" class="form-text">Make sure to type the same password</div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>