<?php
require_once 'db.php';
session_start();

$msg = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, password, name FROM subscribers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hash, $name);
        $stmt->fetch();

        if (password_verify($pass, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $name;
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "Incorrect password.";
        }
    } else {
        $msg = "Email not registered.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Login</title>

    <style>
        body {
            margin: 0;
            background: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #0147a6;
            padding: 15px;
            text-align: center;
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        .container {
            max-width: 420px;
            margin: 60px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            color: #0147a6;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #0147a6;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #013c8d;
        }

        .msg {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .small {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #0147a6;
            text-decoration: none;
            font-size: 14px;
        }

    </style>

</head>
<body>

<div class="navbar">Login</div>

<div class="container">

    <h2>User Login</h2>

    <?php if ($msg) echo "<p class='msg'>$msg</p>"; ?>

    <form method="POST">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Login</button>

        <a class="small" href="register.php">Don’t have an account? Register</a>
        <a class="small" href="index.php">← Back to Home</a>

    </form>

</div>

</body>
</html>