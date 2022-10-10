<?php
$servername = "localhost";
$username = "sagor";
$password = "Sagor112";
$dbname = "voting";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Sorry we failed to connect: " . mysqli_connect_error());
//  if($conn){
//      echo "Database Succesfully Connected!";
//  }else{
//      die("Sorry we failed to connect: ". mysqli_connect_error());
//  }
