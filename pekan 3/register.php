<?php
session_start();
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $whatsapp = htmlspecialchars(trim($_POST["whatsapp"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    if (!empty($username) && !empty($password) && !empty($email)) {
        $_SESSION['users'][$username] = [
            'password' => $password,
            'email' => $email,
            'whatsapp' => $whatsapp
        ];
        $pesan = "<p style='color:#28a745; text-align:center; font-weight:bold; background:white; padding:10px; border-radius:10px;'>Registrasi sukses! Silakan <a href='login.php'>Login</a></p>";
    } else {
        $pesan = "<p style='color:#dc3545; text-align:center; font-weight:bold; background:white; padding:10px; border-radius:10px;'>Harap isi semua data!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Agrilink ID</title>
    <link rel="stylesheet" href="style1.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav>
      <div class="navbar">
        <h2 class="logo">
            <a href="beranda awal.html" style="display: flex; align-items: center; gap: 10px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-leaf-fill" viewBox="0 0 16 16">
                <path d="M1.4 1.7c.217.289.65.84 1.725 1.274 1.093.44 2.885.774 5.834.528 2.02-.168 3.431.51 4.326 1.556C14.161 6.082 14.5 7.41 14.5 8.5q0 
                 .344-.027.734C13.387 8.252 11.877 7.76 10.39 7.5c-2.016-.288-4.188-.445-5.59-2.045-.142-.162-.402-.102-.379.112.108.985 1.104 1.82 1.844 2.308
                  2.37 1.566 5.772-.118 7.6 3.071.505.8 1.374 2.7 1.75 4.292.07.298-.066.611-.354.715a.7.7 0 0 1-.161.042 1 1 0 0 1-1.08-.794c-.13-.97-.396-1.913-.8
                  68-2.77C12.173 13.386 10.565 14 8 14c-1.854 0-3.32-.544-4.45-1.435-1.124-.887-1.889-2.095-2.39-3.383-1-2.562-1-5.536-.65-7.28L.73.806z"/>
            </svg> Agrilink ID
            </a>
        </h2>
        <ul class="menu">
            <li><a href="cuaca.html">Cuaca</a></li>
            <li><a href="edukasi.html">Edukasi</a></li>
            <li><a href="login.php">Masuk</a></li>
            <li><a href="register.php">Daftar</a></li>
        </ul>
      </div>
    </nav>
    <div class="wrapper">
      <form action="" method="POST">
        <h1>Daftar Akun</h1>
        
        <?php echo $pesan; ?>

        <div class="input-box">
          <input type="text" name="username" placeholder="Username" required />
          <i class="bi bi-person-fill"></i>
        </div>
        <div class="input-box">
          <input type="email" name="email" placeholder="Alamat Email" required />
          <i class="bi bi-envelope-fill"></i>
        </div>
        <div class="input-box">
          <input type="tel" name="whatsapp" placeholder="Nomor WhatsApp" required />
          <i class="bi bi-telephone-fill"></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required />
          <i class="bi bi-lock-fill"></i>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox" required /> Saya menyetujui Syarat & Ketentuan</label>
        </div>
        <button type="submit" class="btn">Daftar</button>
        <div class="register-link">
          <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
        </div>
      </form>
    </div>
  </body>
</html>