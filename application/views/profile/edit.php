<!-- Back Button -->
<a href="<?php echo base_url('profile'); ?>" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left me-1"></i>Back to Profile
</a>

<!-- Page Title -->
<div class="page-header mb-4">
    <h5 class="mb-1">Edit Profile</h5>
    <p class="text-muted mb-0">Update your account details</p>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
<?php endif; ?>

<!-- Profile Image Upload -->
<div class="profile-avatar-section mb-4">
    <?php if (!empty($customer->profile_image)): ?>
        <div class="profile-avatar-img">
            <img src="<?php echo base_url('uploads/profiles/' . $customer->profile_image); ?>" alt="Profile" id="profilePreview">
        </div>
    <?php else: ?>
        <div class="profile-avatar" id="profilePlaceholder">
            <i class="bi bi-person-fill"></i>
        </div>
        <img src="" alt="Profile" id="profilePreview" class="profile-avatar-img" style="display:none;">
    <?php endif; ?>
    <label for="profile_image" class="btn btn-sm btn-outline-primary mt-2">
        <i class="bi bi-camera me-1"></i>Change Photo
    </label>
</div>

<!-- Edit Form -->
<?php echo form_open_multipart('edit-profile', ['class' => 'booking-form']); ?>

    <input type="file" name="profile_image" id="profile_image" accept="image/*" class="d-none">

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

    <button type="submit" class="btn btn-primary btn-lg w-100 mb-4">
        <i class="bi bi-check-lg me-2"></i>Save Changes
    </button>

<?php echo form_close(); ?>
