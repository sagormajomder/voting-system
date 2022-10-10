<?php
session_start();
include("../database/connect.php");
if (!isset($_SESSION["userdata"])) {
    header("location:../");
}
$userdata = $_SESSION["userdata"];
$groupsdata = $_SESSION["groupsdata"];

$sql = "UPDATE user SET status=0 WHERE role = 1";

if (!$groupsdata) {
    mysqli_query($conn, $sql);
    $userdata['status'] = 0;
}
if ($userdata['status'] == 0) {
    $status = "<b style='color:red'> Not Voted </b>";
} else {
    $status = "<b style='color:green'> Voted </b>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online CR Selection - Dashboard</title>
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
    <header id="header">
        <div class="text">
            <button onclick="window.location.href='../' " id="back_btn">Back</button>
            <h1>Online CR Selection</h1>
            <button onclick="window.location.href='../database/logout.php' " id="logout_btn">logout</button>
        </div>
        <hr>
    </header>
    <main>
        <div id="profile">
            <img src="../uploads/<?php echo $userdata['photo'] ?>" alt="photo">
            <div class="info">
                <p><b>Name: </b><?php echo $userdata['name'] ?></p>
                <p><b>Student ID: </b><?php echo $userdata['sid'] ?></p>
                <p><b>Address: </b><?php echo $userdata['address'] ?></p>
                <p><b>Status: </b><?php echo $status ?></p>
            </div>

        </div>
        <div id="group">
            <?php
            if ($groupsdata) {
                for ($i = 0; $i < count($groupsdata); $i++) {
            ?>
                    <div id="group_inner">
                        <img src="../uploads/<?php echo $groupsdata[$i]['photo'] ?>" alt="Candidate photo">
                        <div class="info">
                            <p><b>Candidate Name: </b><?php echo $groupsdata[$i]['name'] ?></p>
                          <!--  <p><b>Votes: </b><?php echo $groupsdata[$i]['votes'] ?></p> -->
                            <form action="../database/vote.php" method="POST">
                                <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                                <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                                <?php
                                if ($userdata["status"] == 0) {
                                ?>
                                    <input type="submit" name="votebtn" value="Vote" id="votebtn">

                                <?php
                                } else {
                                ?>
                                    <button disable type="button" name="votebtn" value="Vote" id="votedid">Voted</button>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "Candidate Doesn't Register Yet";
            }
            ?>

        </div>
    </main>


</body>

</html>