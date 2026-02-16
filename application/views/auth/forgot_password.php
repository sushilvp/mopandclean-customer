<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="MopAndClean">
        </div>
        <h1 class="auth-title">Forgot Password</h1>
        <p class="auth-subtitle">Enter your email to receive a reset link</p>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success alert-sm">
                <i class="bi bi-check-circle-fill me-1"></i>
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-sm"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-sm"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger alert-sm"><?php echo validation_errors(); ?></div>
        <?php endif; ?>

        <?php echo form_open('forgot-password', ['class' => 'auth-form']); ?>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="Email" value="<?php echo set_value('email'); ?>" required>
                <label for="email">Email Address</label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="bi bi-envelope me-2"></i>Send Reset Link
            </button>
        <?php echo form_close(); ?>

        <div class="auth-footer">
            Remember your password? <a href="<?php echo base_url('login'); ?>">Login</a>
        </div>
    </div>
</div>
