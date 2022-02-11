<?php
// sumbit to database
$servername = "localhost";
$username = "root";
$password = "";
$database="users";

  // create a connection
  $conn = mysqli_connect($servername, $username, $password,$database);

  // die if connection was not successful
  if (!$conn) {
    // die("sorry we failed to connect: " . mysqli_connect_error());
    echo "fail";
  // } else {
  //   echo "connection is done";
  }
?>