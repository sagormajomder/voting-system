<?php
session_start();
include("connect.php");
$sid = $_POST["sid"];
$password = $_POST["pass"];
$role = $_POST["role"];

$sql = "SELECT * FROM user WHERE sid='$sid' and password='$password' and role='$role'";
$check = mysqli_query($conn, $sql);
if (mysqli_num_rows($check) > 0) {
    $user_data = mysqli_fetch_array($check);
    $groups = mysqli_query($conn, "SELECT * FROM user WHERE role = 2");
    $groups_data = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION["userdata"] = $user_data;
    $_SESSION["groupsdata"] = $groups_data;

    echo " 
    <script>
    window.location= '../include/dashboard.php';
    </script>
    ";
} else {
    echo " 
    <script>
    alert('Invalid Credential or User Not Found'); 
    window.location= '../';
    </script>
    ";
}
