<div class="auth-container">
    <div class="auth-card">
        <div class="auth-logo">
            <i class="bi bi-house-fill"></i>
        </div>
        <h1 class="auth-title">Create Account</h1>
        <p class="auth-subtitle">Sign up to book cleaning services</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-sm"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger alert-sm"><?php echo validation_errors(); ?></div>
        <?php endif; ?>

        <?php echo form_open('register', ['class' => 'auth-form']); ?>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="full_name" name="full_name"
                       placeholder="Full Name" value="<?php echo set_value('full_name'); ?>" required>
                <label for="full_name">Full Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="Email" value="<?php echo set_value('email'); ?>" required>
                <label for="email">Email Address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="phone" name="phone"
                       placeholder="Phone" value="<?php echo set_value('phone'); ?>" required>
                <label for="phone">Phone Number</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" id="address" name="address"
                          placeholder="Address" style="height: 80px" required><?php echo set_value('address'); ?></textarea>
                <label for="address">Address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                       placeholder="Confirm Password" required>
                <label for="confirm_password">Confirm Password</label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                <i class="bi bi-person-plus me-2"></i>Register
            </button>
        <?php echo form_close(); ?>

        <div class="auth-footer">
            Already have an account? <a href="<?php echo base_url('login'); ?>">Login</a>
        </div>
    </div>
</div>
