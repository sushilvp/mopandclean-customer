<!-- Back Button -->
<a href="<?php echo base_url('profile'); ?>" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left me-1"></i>Back to Profile
</a>

<!-- Page Title -->
<div class="page-header mb-4">
    <h5 class="mb-1">Change Password</h5>
    <p class="text-muted mb-0">Update your account password</p>
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

<?php echo form_open('change-password', ['class' => 'booking-form']); ?>
    <div class="form-section">
        <label class="form-label fw-semibold">Current Password</label>
        <input type="password" class="form-control" name="current_password" required>
    </div>

    <div class="form-section">
        <label class="form-label fw-semibold">New Password</label>
        <input type="password" class="form-control" name="new_password" required>
        <small class="text-muted">Minimum 6 characters</small>
    </div>

    <div class="form-section">
        <label class="form-label fw-semibold">Confirm New Password</label>
        <input type="password" class="form-control" name="confirm_password" required>
    </div>

    <button type="submit" class="btn btn-primary btn-lg w-100 mb-4">
        <i class="bi bi-shield-check me-2"></i>Change Password
    </button>
<?php echo form_close(); ?>
