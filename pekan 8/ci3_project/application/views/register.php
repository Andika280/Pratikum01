<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun - Agrilink ID</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); height: 100vh; display: flex; justify-content: center; align-items: center; }
        .login-container { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 100%; max-width: 400px; text-align: center; }
        .login-container h2 { color: #2c3e50; margin-bottom: 10px; font-size: 24px; }
        .login-container p { color: #7f8c8d; margin-bottom: 30px; font-size: 14px; }
        .error-msg { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 13px; border-left: 4px solid #dc3545; }
        .form-group { text-align: left; margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #34495e; font-weight: 600; font-size: 14px; }
        .form-group input { width: 100%; padding: 12px; border: 2px solid #ecf0f1; border-radius: 8px; outline: none; transition: 0.3s; }
        .form-group input:focus { border-color: #2ecc71; }
        .btn-login { background-color: #2ecc71; color: white; width: 100%; padding: 12px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-login:hover { background-color: #27ae60; transform: translateY(-2px); }
        .link-register { display: block; margin-top: 20px; font-size: 14px; color: #2ecc71; text-decoration: none; font-weight: 600; }
        .link-register:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Daftar Akun Baru</h2>
    <p>Bergabunglah dengan Agrilink ID</p>

    <?php if($this->session->flashdata('error')): ?>
        <div class="error-msg"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <form action="<?= base_url('auth/proses_register'); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Contoh: putra@123" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="*********" required>
        </div>
        <button type="submit" class="btn-login">Daftar Sekarang</button>
    </form>

    <a href="<?= base_url('auth'); ?>" class="link-register">Sudah punya akun? Login di sini</a>
</div>

</body>
</html>