<?php
require_once 'db.php';
session_start();

$msg = "";

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Invalid email address.";
    } elseif (strlen($pass) < 6) {
        $msg = "Password must be at least 6 characters.";
    } else {
        $check = mysqli_query($conn, "SELECT id FROM subscribers WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $msg = "Email already registered.";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO subscribers (name, email, password) VALUES ('$name', '$email', '$hash')");
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>

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
            padding: 30px;
            background: white;
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

<div class="navbar">Register</div>

<div class="container">

    <h2>Create Account</h2>

    <?php if ($msg) echo "<p class='msg'>$msg</p>"; ?>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">Register</button>

        <a class="small" href="login.php">Already have an account? Login</a>
        <a class="small" href="index.php">← Back to Home</a>
    </form>

</div>

</body>
</html>