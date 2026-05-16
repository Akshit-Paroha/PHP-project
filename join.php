<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$campaign_id = intval($_POST['campaign_id']);

// Prevent duplicate joins
$check = mysqli_query($conn, 
    "SELECT id FROM user_campaigns WHERE user_id=$user_id AND campaign_id=$campaign_id"
);

if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn, 
        "INSERT INTO user_campaigns (user_id, campaign_id) VALUES ($user_id, $campaign_id)"
    );
}

header("Location: dashboard.php");
exit;
?>