<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}

require_once __DIR__ . '/../db.php';

// SAFE counts
$users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM subscribers"))['total'];

$campaigns = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM campaigns"))['total'];

// If leads table does not exist → avoid crashing:
$leads = 0;
$check_leads = mysqli_query($conn, "SHOW TABLES LIKE 'leads'");
if (mysqli_num_rows($check_leads) > 0) {
    $leads = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM leads"))['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f5;
        }

        .navbar {
            background: #0147a6;
            padding: 15px 25px;
            color: white;
            font-size: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
        }

        h2 {
            color: #0147a6;
            margin-bottom: 25px;
        }

        .cards {
            display: flex;
            gap: 20px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0;
            color: #0147a6;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>

</head>
<body>

<div class="navbar">
    <div>Admin Dashboard</div>
    <div>
        <a href="campaigns.php">Campaigns</a>
        <a href="leads.php">Leads</a>
        <a href="adminlogout.php">Logout</a>
    </div>
</div>

<div class="container">

    <h2>Overview</h2>

    <div class="cards">
        <div class="card">
            <h3>Total Users</h3>
            <p><?= $users ?></p>
        </div>

        <div class="card">
            <h3>Total Campaigns</h3>
            <p><?= $campaigns ?></p>
        </div>

        <div class="card">
            <h3>Total Leads</h3>
            <p><?= $leads ?></p>
        </div>
    </div>

</div>

</body>
</html>