<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}

require_once __DIR__ . '/../db.php';

// ADD CAMPAIGN
$msg = "";
if (isset($_POST['add_campaign'])) {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];
    $budget = $_POST['budget'];

    $q = "INSERT INTO campaigns (title, description, start_date, end_date, budget)
          VALUES ('$title', '$desc', '$start', '$end', '$budget')";
    
    if (mysqli_query($conn, $q)) {
        $msg = "Campaign added successfully!";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}

// DELETE CAMPAIGN
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM campaigns WHERE id = $id");
    header("Location: campaigns.php");
    exit;
}

// FETCH CAMPAIGNS
$data = mysqli_query($conn, "SELECT * FROM campaigns ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Campaigns</title>

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

        .msg {
            padding: 10px;
            background: #c8e6c9;
            border-left: 4px solid #2e7d32;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 6px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 12px 20px;
            background: #0147a6;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #013c8d;
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

        .delete-btn {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        .delete-btn:hover {
            text-decoration: underline;
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
        <a href="analytics.php">Analytics</a>
        <a href="adminlogout.php">Logout</a>
    </div>
</div>

<div class="container">

    <h2>Manage Campaigns</h2>

    <?php if ($msg): ?>
        <div class="msg"><?= $msg ?></div>
    <?php endif; ?>

    <!-- ADD CAMPAIGN FORM -->
    <div class="card">
        <h3>Add New Campaign</h3>

        <form method="POST">
            <label>Campaign Title</label>
            <input type="text" name="title" required>

            <label>Description</label>
            <textarea name="description" required></textarea>

            <label>Start Date</label>
            <input type="date" name="start_date" required>

            <label>End Date</label>
            <input type="date" name="end_date" required>

            <label>Budget</label>
            <input type="number" name="budget" required>

            <button type="submit" name="add_campaign">Add Campaign</button>
        </form>
    </div>

    <!-- SHOW CAMPAIGNS -->
    <h3>All Campaigns</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Start</th>
            <th>End</th>
            <th>Budget</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['start_date'] ?></td>
            <td><?= $row['end_date'] ?></td>
            <td>₹<?= $row['budget'] ?></td>
            <td><a class="delete-btn" href="campaigns.php?delete=<?= $row['id'] ?>">Delete</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>