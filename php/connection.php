<?php
  $hostname = "localhost";
  $username = "id18770679_user";
  $password = "Uh6PD3?\=%/pEqr*";
  $dbname = "id18770679_db_animals";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
  $conn->set_charset("utf8");
?>
