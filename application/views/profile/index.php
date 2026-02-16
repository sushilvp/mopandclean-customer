<!-- Page Title -->
<div class="page-header mb-4">
    <h5 class="mb-1">My Profile</h5>
    <p class="text-muted mb-0">Your account details</p>
</div>

<?php if (!empty($success)): ?>
    <div class="alert alert-success d-flex align-items-center">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?php echo $success; ?>
    </div>
<?php endif; ?>

<!-- Profile Avatar -->
<div class="profile-avatar-section mb-4">
    <?php if (!empty($customer->profile_image)): ?>
        <div class="profile-avatar-img">
            <img src="<?php echo base_url('uploads/profiles/' . $customer->profile_image); ?>" alt="Profile">
        </div>
    <?php else: ?>
        <div class="profile-avatar">
            <i class="bi bi-person-fill"></i>
        </div>
    <?php endif; ?>
    <h6 class="mt-2 mb-0"><?php echo htmlspecialchars($customer->full_name); ?></h6>
    <small class="text-muted"><?php echo htmlspecialchars($customer->email); ?></small>
</div>

<!-- Profile Details Card -->
<div class="detail-card mb-3">
    <h6 class="detail-card-title"><i class="bi bi-person me-2"></i>Personal Information</h6>
    <div class="detail-row">
        <span>Full Name</span>
        <strong><?php echo htmlspecialchars($customer->full_name); ?></strong>
    </div>
    <div class="detail-row">
        <span>Email</span>
        <strong><?php echo htmlspecialchars($customer->email); ?></strong>
    </div>
    <div class="detail-row">
        <span>Phone</span>
        <strong><?php echo htmlspecialchars($customer->phone); ?></strong>
    </div>
    <div class="detail-row">
        <span>Address</span>
        <strong class="text-end" style="max-width:60%;"><?php echo htmlspecialchars($customer->address); ?></strong>
    </div>
</div>

<!-- Edit Profile Button -->
<a href="<?php echo base_url('edit-profile'); ?>" class="btn btn-primary btn-lg w-100 mb-3">
    <i class="bi bi-pencil-square me-2"></i>Edit Profile
</a>

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
