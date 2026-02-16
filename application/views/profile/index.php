<!-- Page Title -->
<div class="page-header mb-4">
    <h5 class="mb-1">My Profile</h5>
    <p class="text-muted mb-0">Manage your account details</p>
</div>

<?php if (!empty($success)): ?>
    <div class="alert alert-success d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?php echo $success; ?>
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
<?php endif; ?>

<!-- Profile Avatar -->
<div class="profile-avatar-section mb-4">
    <div class="profile-avatar">
        <i class="bi bi-person-fill"></i>
    </div>
    <h6 class="mt-2 mb-0"><?php echo htmlspecialchars($customer->full_name); ?></h6>
    <small class="text-muted"><?php echo htmlspecialchars($customer->email); ?></small>
</div>

<!-- Edit Profile Form -->
<?php echo form_open('profile', ['class' => 'booking-form']); ?>
    <div class="form-section">
        <label class="form-label fw-semibold">Full Name</label>
        <input type="text" class="form-control" name="full_name"
               value="<?php echo htmlspecialchars($customer->full_name); ?>" required>
    </div>

    <div class="form-section">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" class="form-control" value="<?php echo htmlspecialchars($customer->email); ?>" disabled>
        <small class="text-muted">Email cannot be changed</small>
    </div>

    <div class="form-section">
        <label class="form-label fw-semibold">Phone</label>
        <input type="tel" class="form-control" name="phone"
               value="<?php echo htmlspecialchars($customer->phone); ?>" required>
    </div>

    <div class="form-section">
        <label class="form-label fw-semibold">Address</label>
        <textarea class="form-control" name="address" rows="3" required><?php echo htmlspecialchars($customer->address); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
        <i class="bi bi-check-lg me-2"></i>Update Profile
    </button>
<?php echo form_close(); ?>

<!-- Quick Links -->
<div class="profile-links">
    <a href="<?php echo base_url('change-password'); ?>" class="profile-link-card">
        <div class="d-flex align-items-center">
            <div class="profile-link-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            <div>
                <span class="fw-semibold">Change Password</span>
                <small class="text-muted d-block">Update your account password</small>
            </div>
        </div>
        <i class="bi bi-chevron-right text-muted"></i>
    </a>

    <a href="<?php echo base_url('logout'); ?>" class="profile-link-card text-danger">
        <div class="d-flex align-items-center">
            <div class="profile-link-icon bg-danger-light">
                <i class="bi bi-box-arrow-right"></i>
            </div>
            <div>
                <span class="fw-semibold">Logout</span>
                <small class="text-muted d-block">Sign out of your account</small>
            </div>
        </div>
        <i class="bi bi-chevron-right text-muted"></i>
    </a>
</div>
