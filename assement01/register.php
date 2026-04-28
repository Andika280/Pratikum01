<?php
require 'koneksi.php';
if (isset($_POST['register'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
    if ($conn->query($sql)) {
        echo "<script>alert('Registrasi sukses! Silakan login.'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Registrasi Akun Operator</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit" name="register">Daftar</button>
    </form>
    <a href="login.php">Sudah punya akun? Login</a>
</body>
</html>