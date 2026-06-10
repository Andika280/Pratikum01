<?php $this->load->view('templates/header', ['title' => 'Login']); ?>

<body class="login-page">

<div class="login-box">
    <h2>Login</h2>
    <?php if($this->session->flashdata('error')): ?>
        <p class="error"><?= $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <?php if($this->session->flashdata('success')): ?>
        <p class="success"><?= $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <form action="<?= base_url('auth/login'); ?>" method="post">
        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>
    </form>
    <p><a href="<?= base_url('auth/register'); ?>">Belum punya akun? Register</a></p>
</div>

<?php $this->load->view('templates/footer'); ?>
