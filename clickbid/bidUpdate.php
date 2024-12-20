<?php
include 'backend/connection.php';
session_start();
$userId = $_SESSION['user_id'];
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectId = $_POST['project_id'];
    $bid = $_POST['new_bid'];

    $sql = "UPDATE `projects` SET `price` = '$bid', `freelancer_name` = '$username', `freelancer_id` = '$userId' where project_id= '$projectId'";
    $result = mysqli_query($conn, $sql);
}
?>
