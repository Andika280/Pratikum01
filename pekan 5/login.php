<?php
session_start();
require 'koneksi.php';

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
    if ($result->num_rows > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        setcookie("username", $username, time() + (86400 * 30), "/");
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem</title>
</head>
<body>

<h2>Login Sistem</h2>

<?php if ($error != ""): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username"
        value="<?= isset($_COOKIE['username']) ? $_COOKIE['username'] : '' ?>" required><br><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>

</body>
</html>