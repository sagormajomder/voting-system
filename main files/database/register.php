<?php
include("connect.php");
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$sid = isset($_POST["sid"]) ? $_POST["sid"] : "";
$password = isset($_POST["pass"]) ? $_POST["pass"] : "";
$cpassword = isset($_POST["cpass"]) ? $_POST["cpass"] : "";
$address = isset($_POST["address"]) ? $_POST["address"] : "";;
$images = isset($_FILES["images"]["name"]) ? $_FILES["images"]["name"] : "";
$tmp_name = isset($_FILES["images"]["tmp_name"]) ? $_FILES["images"]["tmp_name"] : "";
$role = isset($_POST["role"]) ? $_POST["role"] : "";

$sql = "SELECT * FROM user WHERE sid='$sid'";
$check = mysqli_query($conn, $sql);
if (mysqli_num_rows($check) > 0) {
    echo " 
        <script>
        alert('User Already Register With this Student ID'); 
        window.location= '../include/registration.html';
        </script>
        ";
} else if ($password == $cpassword) {
    move_uploaded_file($tmp_name, "../uploads/$images");

    $sql = "INSERT INTO user (name,sid,password,address,photo,role,status,votes) VALUES ('$name','$sid','$password','$address','$images','$role',0,0);";

    $insert = mysqli_query($conn, $sql);
    if ($insert) {
        echo " 
        <script>
        alert('Registration Succesfull!'); 
        window.location= '../';
        </script>
        ";
    } else {
        echo " 
        <script>
        alert('Some Error Occured! Please try again'); 
        window.location= '../include/registration.html';
        </script>
        ";
    }
} else {
    echo " 
        <script>
        alert('Password and Confirmed Password does not match'); 
        window.location= '../include/registration.html';
        </script>
        ";
}
