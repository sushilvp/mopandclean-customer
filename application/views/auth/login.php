<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="MopAndClean">
        </div>
        <p class="auth-subtitle">Welcome back! Login to your account</p>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-sm"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-sm"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-sm"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger alert-sm"><?php echo validation_errors(); ?></div>
        <?php endif; ?>

        <?php echo form_open('login', ['class' => 'auth-form']); ?>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="email_or_phone" name="email_or_phone"
                       placeholder="Email or Phone" value="<?php echo set_value('email_or_phone'); ?>" required>
                <label for="email_or_phone">Email or Phone</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
        <?php echo form_close(); ?>

        <div class="auth-footer mb-2">
            <a href="<?php echo base_url('forgot-password'); ?>">Forgot Password?</a>
        </div>
        <div class="auth-footer">
            Don't have an account? <a href="<?php echo base_url('register'); ?>">Register</a>
        </div>
    </div>
</div>
