<?php
require_once "db.php";

if (isset($_POST['send'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    mysqli_query($conn, 
        "INSERT INTO leads (name, email, message) 
         VALUES ('$name', '$email', '$message')"
    );

    header("Location: index.php?success=1");
    exit;
}
?>