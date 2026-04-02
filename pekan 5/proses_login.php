<?php
require_once 'start.php';
require_once 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;

    setcookie("username", $username, time() + (86400 * 30), "/");

    header("Location: index.php");
} else {
    echo "Login gagal";
}
?>