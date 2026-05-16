<?php
require_once "../db.php";
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}

$query = "
SELECT uc.id, u.name AS username, u.email, c.title
FROM user_campaigns uc
JOIN subscribers u ON uc.user_id = u.id
JOIN campaigns c ON uc.campaign_id = c.id
ORDER BY uc.id DESC
";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Joined Campaigns</title>
    <style>
        body { font-family: Arial; background: #eef2f5; }
        table { width: 80%; margin: 40px auto; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ccc; }
        th { background: #0147a6; color: white; }
        h2 { text-align: center; color: #0147a6; }
    </style>
</head>
<body>

<h2>Users Who Joined Campaigns</h2>

<table>
    <tr>
        <th>#</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Campaign</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
    </tr>
    <?php endwhile; ?>

</table>

</body>
</html>