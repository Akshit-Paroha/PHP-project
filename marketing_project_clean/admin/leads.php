<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}

require_once __DIR__ . '/../db.php';

// Fetch leads
$leads = mysqli_query($conn, "SELECT * FROM leads ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Leads</title>

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
        }

        .navbar a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
        }

        h2 {
            color: #0147a6;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            border-collapse: collapse;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        table th, table td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #0147a6;
            color: white;
        }

        .empty {
            text-align: center;
            padding: 25px;
            background: white;
            border-radius: 10px;
            font-size: 18px;
            color: #555;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>

</head>
<body>

<div class="navbar">
    <div>Admin Panel</div>
    <div>
        <a href="admindashboard.php">Dashboard</a>
        <a href="campaigns.php">Campaigns</a>
        <a href="leads.php">Leads</a>
        <a href="adminlogout.php">Logout</a>
    </div>
</div>

<div class="container">

    <h2>All Leads</h2>

    <?php if (mysqli_num_rows($leads) == 0): ?>
        <div class="empty">No leads found.</div>
    <?php else: ?>

    <table>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($leads)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['message'] ?></td>
            <td><?= $row['created_at'] ?></td>
        </tr>
        <?php endwhile; ?>

    </table>

    <?php endif; ?>

</div>

</body>
</html>