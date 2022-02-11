<?php

  $login = false;
  $showalert = false;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/dbconnect.php';
  $username = $_POST["username"];
  $password = $_POST["password"];

  // $sql = "SELECT * FROM `users` WHERE username='$username' AND password='$password';";
  $sql = "SELECT * FROM `users` WHERE username='$username';";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    while($row=mysqli_fetch_assoc($result)){
    if(password_verify($password,$row['password'])){
    $login = true;
  
    session_start();
    $_SESSION['loggedin']=true;
    $_SESSION['username']=$username;

    //for redirect to another page
    header("location:welcome.php");
    }else{
      $showalert = true;
    }
  }
  } else {
    $showalert = true;
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
  <title>login page</title>
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
  if ($login) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>success!</strong> you are login.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
  if ($showalert) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>Fail</strong> first you are signup
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }

  ?>
  <div class="container my-3">
    <h1 class="text-center">login to our website</h1>
    <form class="my-4" action="/soham/login.php" method="post">
      <div class="mb-3 col-md-6">
        <label for="username" class="form-label">username</label>
        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" maxlength="20">
      </div>
      <div class="mb-3 col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="Password" name="password" maxlength="30">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>