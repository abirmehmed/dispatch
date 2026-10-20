<?php
session_start();
$pass = 'dispatch2024'; // Change this password

if (isset($_POST['password']) && $_POST['password'] === $pass) {
    $_SESSION['auth'] = true;
    header('Location: admin.php');
    exit;
}

if (!isset($_SESSION['auth'])) {
    echo '<!DOCTYPE html><html><head><link rel="stylesheet" href="style.css"></head><body>
    <form method="POST" style="max-width:300px;margin:50px auto;text-align:center;">
        <h2>Admin Access</h2>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form></body></html>';
    exit;
}
