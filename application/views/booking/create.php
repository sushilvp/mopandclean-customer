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

    <!-- Square Feet Section -->
    <div class="form-section">
        <label class="form-label fw-semibold">
            <i class="bi bi-rulers me-1"></i>Square Feet
        </label>
        <div class="row g-2">
            <div class="col-4">
                <input type="number" class="form-control calc-field" name="sqft" id="sqft"
                       placeholder="Sqft" step="any" value="<?php echo set_value('sqft', '0'); ?>"
                       data-pair="sqft_cost" data-result="sub_total">
                <small class="text-muted">Quantity</small>
            </div>
            <div class="col-4">
                <input type="number" class="form-control calc-field" name="sqft_cost" id="sqft_cost"
                       placeholder="Cost" step="any" value="<?php echo set_value('sqft_cost', '0'); ?>"
                       data-pair="sqft" data-result="sub_total">
                <small class="text-muted">Cost/unit</small>
            </div>
            <div class="col-4">
                <input type="text" class="form-control subtotal-field" name="sub_total" id="sub_total"
                       value="0.00" readonly>
                <small class="text-muted">Subtotal</small>
            </div>
        </div>
    </div>

    <!-- Sofa Section -->
    <div class="form-section">
        <label class="form-label fw-semibold">
            <i class="bi bi-lamp me-1"></i>Sofa
        </label>
        <div class="row g-2">
            <div class="col-4">
                <input type="number" class="form-control calc-field" name="sofa" id="sofa"
                       placeholder="Qty" step="any" value="<?php echo set_value('sofa', '0'); ?>"
                       data-pair="sofa_cost" data-result="sub_total1">
                <small class="text-muted">Quantity</small>
            </div>
            <div class="col-4">
                <input type="number" class="form-control calc-field" name="sofa_cost" id="sofa_cost"
                       placeholder="Cost" step="any" value="<?php echo set_value('sofa_cost', '0'); ?>"
                       data-pair="sofa" data-result="sub_total1">
                <small class="text-muted">Cost/unit</small>
            </div>
            <div class="col-4">
                <input type="text" class="form-control subtotal-field" name="sub_total1" id="sub_total1"
                       value="0.00" readonly>
                <small class="text-muted">Subtotal</small>
            </div>
        </div>
    </div>

    <!-- Others Section -->
    <div class="form-section">
        <label class="form-label fw-semibold">
            <i class="bi bi-three-dots me-1"></i>Others
        </label>
        <div class="row g-2">
            <div class="col-4">
                <input type="number" class="form-control calc-field" name="others" id="others"
                       placeholder="Qty" step="any" value="<?php echo set_value('others', '0'); ?>"
                       data-pair="others_cost" data-result="sub_total2">
                <small class="text-muted">Quantity</small>
            </div>
            <div class="col-4">
                <input type="number" class="form-control calc-field" name="others_cost" id="others_cost"
                       placeholder="Cost" step="any" value="<?php echo set_value('others_cost', '0'); ?>"
                       data-pair="others" data-result="sub_total2">
                <small class="text-muted">Cost/unit</small>
            </div>
            <div class="col-4">
                <input type="text" class="form-control subtotal-field" name="sub_total2" id="sub_total2"
                       value="0.00" readonly>
                <small class="text-muted">Subtotal</small>
            </div>
        </div>
    </div>

    <!-- Total -->
    <div class="total-section">
        <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold fs-5">Total</span>
            <span class="fw-bold fs-4 text-primary" id="total_display">&#8377;0.00</span>
        </div>
        <input type="hidden" name="total_cost" id="total_cost" value="0">
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
