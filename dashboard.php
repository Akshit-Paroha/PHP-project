<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /marketing_project/login.php");
    exit;
}

$uid = $_SESSION['user_id'];
$name = $_SESSION['username'];

// Fetch campaigns safely
$campaigns = mysqli_query($conn, "SELECT * FROM campaigns ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>

    <style>
        body {
            margin: 0;
            background: #eef2f5;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #0147a6;
            padding: 15px 25px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
        }

        h2 {
            color: #0147a6;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        .campaign {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .campaign:last-child {
            border-bottom: none;
        }

        .campaign h3 {
            margin: 0;
            color: #0147a6;
        }

        .info {
            margin-top: 5px;
            font-size: 14px;
            color: #444;
        }
    </style>
</head>

<body>

<div class="navbar">
    <div>Welcome, <?= htmlspecialchars($name) ?></div>
    <div>
        <a href="/marketing_project/logout.php">Logout</a>
    </div>
</div>

<div class="container">

    <h2>Available Campaigns</h2>

    <div class="card">

        <?php if (mysqli_num_rows($campaigns) == 0): ?>
            <p style="text-align:center;color:#777;font-size:18px;">
                No campaigns available yet.
            </p>
        <?php else: ?>

          <?php
$user_id = $_SESSION['user_id'];

// get joined campaign IDs
$joined = mysqli_query($conn, "SELECT campaign_id FROM user_campaigns WHERE user_id = $user_id");
$joined_ids = [];
while ($j = mysqli_fetch_assoc($joined)) {
    $joined_ids[] = $j['campaign_id'];
}
?>

<?php while ($c = mysqli_fetch_assoc($campaigns)): ?>
    <div class="campaign">
        <h3><?= htmlspecialchars($c['title']) ?></h3>
        <div class="info">
            <?= nl2br(htmlspecialchars($c['description'])) ?><br>
            <strong>Start:</strong> <?= $c['start_date'] ?> |
            <strong>End:</strong> <?= $c['end_date'] ?><br>
            <strong>Budget:</strong> ₹<?= $c['budget'] ?>
        </div>

        <?php if (!in_array($c['id'], $joined_ids)): ?>
            <form method="POST" action="join.php">
                <input type="hidden" name="campaign_id" value="<?= $c['id'] ?>">
                <button type="submit" 
                        style="margin-top:10px;padding:10px 18px;background:#0147a6;color:white;border:none;border-radius:6px;cursor:pointer;">
                    Join Campaign
                </button>
            </form>
        <?php else: ?>
            <p style="color:green;margin-top:10px;font-weight:bold;">Joined ✔</p>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
        <?php endif; ?>

    </div>

</div>

</body>
</html>