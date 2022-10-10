<?php
session_start();
include("connect.php");
$votes = $_POST["gvotes"];
$total_votes = $votes + 1;
$gid = $_POST["gid"];
$uid = $_SESSION["userdata"]["id"];
$sql1 = "UPDATE user SET votes='$total_votes' WHERE id=$gid";
$update_votes = mysqli_query($conn, $sql1);

$sql2 = "UPDATE user SET status=1 WHERE id=$uid";
$update_user_status = mysqli_query($conn, $sql2);

if ($update_votes &&  $update_user_status) {
    $groups = mysqli_query($conn, "SELECT * FROM user WHERE role = 2");
    $groups_data = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION["userdata"]["status"] = 1;
    $_SESSION["groupsdata"] = $groups_data;
    echo " 
    <script>
    alert('Vote is Succesfull!'); 
    window.location= '../include/dashboard.php';
    </script>
    ";
} else {
    echo " 
    <script>
    alert('Some Error Occured!'); 
    window.location= '../include/dashboard.php';
    </script>
    ";
}
