<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <i class="bi bi-shield-lock"></i>
        </div>
        <h1 class="auth-title">Reset Password</h1>
        <p class="auth-subtitle">Enter your email and set a new password</p>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success alert-sm"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-sm"><?php echo $error; ?></div>
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

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="new_password" name="new_password"
                       placeholder="New Password" required>
                <label for="new_password">New Password</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                       placeholder="Confirm Password" required>
                <label for="confirm_password">Confirm New Password</label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="bi bi-shield-check me-2"></i>Reset Password
            </button>
        <?php echo form_close(); ?>

        <div class="auth-footer">
            Remember your password? <a href="<?php echo base_url('login'); ?>">Login</a>
        </div>
    </div>
</div>
