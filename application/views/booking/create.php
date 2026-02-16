<!-- Page Title -->
<div class="page-header mb-4">
    <h5 class="mb-1">Book a Service</h5>
    <p class="text-muted mb-0">Fill in the details to schedule your cleaning</p>
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

<?php echo form_open('book', ['class' => 'booking-form', 'id' => 'bookingForm']); ?>

    <!-- Service Type -->
    <div class="form-section">
        <label class="form-label fw-semibold">Service Type</label>
        <select class="form-select" name="service_id" id="service_id" required>
            <option value="">Select a service</option>
            <?php foreach ($services as $service): ?>
                <option value="<?php echo $service->id; ?>" <?php echo set_select('service_id', $service->id); ?>>
                    <?php echo htmlspecialchars($service->name); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Date -->
    <div class="form-section">
        <label class="form-label fw-semibold">Preferred Date</label>
        <input type="date" class="form-control" name="assigned_date" id="assigned_date"
               value="<?php echo set_value('assigned_date'); ?>"
               min="<?php echo date('Y-m-d'); ?>" required>
    </div>

    <!-- Comment -->
    <div class="form-section">
        <label class="form-label fw-semibold">Comments / Notes</label>
        <textarea class="form-control" name="comment" rows="3"
                  placeholder="Any special instructions..."><?php echo set_value('comment'); ?></textarea>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary btn-lg w-100 mb-4">
        <i class="bi bi-check-circle me-2"></i>Confirm Booking
    </button>

<?php echo form_close(); ?>
