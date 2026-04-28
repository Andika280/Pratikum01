<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Agrilink ID</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .login-container p {
            color: #7f8c8d;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #dc3545;
        }

        .success-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #28a745;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ecf0f1;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            border-color: #2ecc71;
        }

        .btn-login {
            background-color: #2ecc71;
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .btn-login:hover {
            background-color: #27ae60;
            transform: translateY(-2px);
        }

        .link-register {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #2ecc71;
            text-decoration: none;
            font-weight: 600;
        }

        .link-register:hover {
            text-decoration: underline;
        }

        .footer-text {
            margin-top: 25px;
            font-size: 12px;
            color: #bdc3c7;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Agrilink ID</h2>

    <?php if($this->session->flashdata('error')): ?>
        <div class="error-msg">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('success')): ?>
        <div class="success-msg">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/proses_login'); ?>" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required autocomplete="off">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn-login">Masuk ke Dashboard</button>
    </form>

    <a href="<?= base_url('auth/register'); ?>" class="link-register">Belum punya akun? Daftar di sini</a>

    <div class="footer-text">
        &copy; 2026 Agrilink ID 
    </div>
</div>

</body>
</html>