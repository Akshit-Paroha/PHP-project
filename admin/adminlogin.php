<?php
session_start();
$msg = "";

if (isset($_POST['login'])) {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    // HARDCODED ADMIN LOGIN
    if ($user === "admin" && $pass === "admin123") {
        $_SESSION['admin_id'] = 1;
        $_SESSION['admin_user'] = "admin";
        header("Location: admindashboard.php");
        exit;
    } else {
        $msg = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }

        .navbar {
            background: #0147a6;
            padding: 15px;
            color: #fff;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .login-container {
            max-width: 420px;
            margin: 70px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        .login-container h2 {
            text-align: center;
            color: #0147a6;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 4px;
            margin-bottom: 15px;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: none;
            background: #0147a6;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #013c8d;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .back-link {
            margin-top: 15px;
            text-align: center;
        }

        .back-link a {
            color: #0147a6;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="navbar">Admin Panel</div>

<div class="login-container">

    <h2>Admin Login</h2>

    <?php if ($msg): ?>
        <p class="error"><?= $msg ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <div class="back-link">
        <a href="../index.php">← Back to Website</a>
    </div>

</div>

</body>
</html>