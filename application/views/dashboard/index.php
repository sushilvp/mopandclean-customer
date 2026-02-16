<!-- Welcome Section -->
<div class="welcome-section mb-4">
    <h4 class="mb-1">Hello, <?php echo htmlspecialchars($customer_name); ?>!</h4>
    <p class="text-muted mb-0">What would you like to do today?</p>
</div>

<!-- Quick Actions -->
<div class="row g-3 mb-4">
    <div class="col-6">
        <a href="<?php echo base_url('book'); ?>" class="quick-action-card">
            <div class="quick-action-icon bg-primary-light">
                <i class="bi bi-calendar-plus text-primary"></i>
            </div>
            <span>Book Service</span>
        </a>
    </div>
    <div class="col-6">
        <a href="<?php echo base_url('history'); ?>" class="quick-action-card">
            <div class="quick-action-icon bg-accent-light">
                <i class="bi bi-clock-history text-accent"></i>
            </div>
            <span>View History</span>
        </a>
    </div>
</div>

<!-- Active Bookings -->
<div class="section-header">
    <h6 class="section-title">Active Bookings</h6>
</div>

<?php if (empty($active_bookings)): ?>
    <div class="empty-state">
        <i class="bi bi-calendar-x"></i>
        <p>No active bookings</p>
        <a href="<?php echo base_url('book'); ?>" class="btn btn-primary btn-sm">Book Now</a>
    </div>
<?php else: ?>
    <?php foreach ($active_bookings as $booking): ?>
        <a href="<?php echo base_url('booking/' . $booking->id); ?>" class="booking-card">
            <div class="booking-card-header">
                <span class="booking-service"><?php echo htmlspecialchars($booking->service_name ?: 'Service'); ?></span>
                <span class="badge badge-status badge-<?php echo strtolower(str_replace(' ', '-', $booking->status_name ?: 'pending')); ?>">
                    <?php echo htmlspecialchars($booking->status_name ?: 'Pending'); ?>
                </span>
            </div>
            <div class="booking-card-body">
                <div class="booking-info">
                    <i class="bi bi-calendar3"></i>
                    <span><?php echo $booking->assigned_date ? date('M d, Y', strtotime($booking->assigned_date)) : 'Not scheduled'; ?></span>
                </div>
                <div class="booking-info">
                    <i class="bi bi-cash"></i>
                    <span>&#8377;<?php echo number_format(floatval($booking->total_cost), 2); ?></span>
                </div>
            </div>
            <div class="booking-card-footer">
                <small class="text-muted">Booking #<?php echo $booking->id; ?></small>
                <i class="bi bi-chevron-right text-muted"></i>
            </div>
        </a>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Recent Activity -->
<?php if (!empty($recent_bookings)): ?>
    <div class="section-header mt-4">
        <h6 class="section-title">Recent Activity</h6>
    </div>
    <?php $count = 0; foreach ($recent_bookings as $booking): if ($count >= 3) break; ?>
        <a href="<?php echo base_url('booking/' . $booking->id); ?>" class="booking-card mini">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="fw-medium"><?php echo htmlspecialchars($booking->service_name ?: 'Service'); ?></span>
                    <small class="text-muted d-block"><?php echo date('M d, Y', strtotime($booking->created_at)); ?></small>
                </div>
                <span class="badge badge-status badge-<?php echo strtolower(str_replace(' ', '-', $booking->status_name ?: 'pending')); ?>">
                    <?php echo htmlspecialchars($booking->status_name ?: 'Pending'); ?>
                </span>
            </div>
        </a>
    <?php $count++; endforeach; ?>
<?php endif; ?>
