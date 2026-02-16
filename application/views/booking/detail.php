<!-- Back Button -->
<a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left me-1"></i>Back
</a>

<!-- Booking Header -->
<div class="detail-header mb-4">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h5 class="mb-1">Booking #<?php echo $booking->id; ?></h5>
            <p class="text-muted mb-0"><?php echo htmlspecialchars($booking->service_name ?: 'Service'); ?></p>
        </div>
        <span class="badge badge-status badge-lg badge-<?php echo strtolower(str_replace(' ', '-', $booking->status_name ?: 'pending')); ?>">
            <?php echo htmlspecialchars($booking->status_name ?: 'Pending'); ?>
        </span>
    </div>
</div>

<!-- Date Info -->
<div class="detail-card mb-3">
    <h6 class="detail-card-title"><i class="bi bi-calendar3 me-2"></i>Schedule</h6>
    <div class="detail-row">
        <span>Assigned Date</span>
        <strong><?php echo $booking->assigned_date ? date('M d, Y', strtotime($booking->assigned_date)) : 'Not scheduled'; ?></strong>
    </div>
    <?php if ($booking->start_date): ?>
    <div class="detail-row">
        <span>Start Date</span>
        <strong><?php echo date('M d, Y', strtotime($booking->start_date)); ?></strong>
    </div>
    <?php endif; ?>
    <?php if ($booking->end_date): ?>
    <div class="detail-row">
        <span>End Date</span>
        <strong><?php echo date('M d, Y', strtotime($booking->end_date)); ?></strong>
    </div>
    <?php endif; ?>
</div>

<!-- Cost Breakdown (shown only if admin has filled costs) -->
<?php if (floatval($booking->total_cost) > 0): ?>
<div class="detail-card mb-3">
    <h6 class="detail-card-title"><i class="bi bi-receipt me-2"></i>Cost Breakdown</h6>

    <?php if (floatval($booking->sub_total) > 0): ?>
    <div class="detail-row">
        <span>Square Feet (<?php echo $booking->sqft; ?> x &#8377;<?php echo number_format(floatval($booking->sqft_cost), 2); ?>)</span>
        <strong>&#8377;<?php echo number_format(floatval($booking->sub_total), 2); ?></strong>
    </div>
    <?php endif; ?>

    <?php if (floatval($booking->sub_total1) > 0): ?>
    <div class="detail-row">
        <span>Sofa (<?php echo $booking->sofa; ?> x &#8377;<?php echo number_format(floatval($booking->sofa_cost), 2); ?>)</span>
        <strong>&#8377;<?php echo number_format(floatval($booking->sub_total1), 2); ?></strong>
    </div>
    <?php endif; ?>

    <?php if (floatval($booking->sub_total2) > 0): ?>
    <div class="detail-row">
        <span>Others (<?php echo $booking->others; ?> x &#8377;<?php echo number_format(floatval($booking->others_cost), 2); ?>)</span>
        <strong>&#8377;<?php echo number_format(floatval($booking->sub_total2), 2); ?></strong>
    </div>
    <?php endif; ?>

    <div class="detail-row total">
        <span>Total Cost</span>
        <strong class="text-primary fs-5">&#8377;<?php echo number_format(floatval($booking->total_cost), 2); ?></strong>
    </div>
</div>
<?php endif; ?>

<!-- Comment -->
<?php if (!empty($booking->comment)): ?>
<div class="detail-card mb-3">
    <h6 class="detail-card-title"><i class="bi bi-chat-text me-2"></i>Notes</h6>
    <p class="mb-0"><?php echo nl2br(htmlspecialchars($booking->comment)); ?></p>
</div>
<?php endif; ?>

<!-- Meta Info -->
<div class="detail-card mb-4">
    <h6 class="detail-card-title"><i class="bi bi-info-circle me-2"></i>Info</h6>
    <div class="detail-row">
        <span>Created</span>
        <strong><?php echo date('M d, Y h:i A', strtotime($booking->created_at)); ?></strong>
    </div>
</div>
