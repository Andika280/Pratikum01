<?php $this->load->view('templates/header', ['title' => 'Register']); ?>

<body class="login-page">

<div class="login-box">
    <h2>Registrasi Akun</h2>

    <form action="<?= base_url('auth/register'); ?>" method="post">
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Daftar</button>
    </form>
    <p><a href="<?= base_url('auth/login'); ?>">Sudah punya akun? Login</a></p>
</div>

<?php $this->load->view('templates/footer'); ?>
