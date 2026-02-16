<!-- Page Title -->
<div class="page-header mb-4">
    <h5 class="mb-1">Booking History</h5>
    <p class="text-muted mb-0">All your cleaning service bookings</p>
</div>

<?php if (empty($bookings)): ?>
    <div class="empty-state">
        <i class="bi bi-clock-history"></i>
        <p>No bookings yet</p>
        <a href="<?php echo base_url('book'); ?>" class="btn btn-primary btn-sm">Book Your First Service</a>
    </div>
<?php else: ?>
    <?php foreach ($bookings as $booking): ?>
        <a href="<?php echo base_url('booking/' . $booking->id); ?>" class="booking-card">
            <div class="booking-card-header">
                <span class="booking-service"><?php echo htmlspecialchars($booking->service_name ?: 'Service'); ?></span>
                <span class="badge badge-status badge-<?php echo strtolower(str_replace(' ', '-', $booking->status_name ?: 'pending')); ?>">
                    <?php echo htmlspecialchars($booking->status_name ?: 'N/A'); ?>
                </span>
            </div>
            <div class="booking-card-body">
                <div class="booking-info">
                    <i class="bi bi-calendar3"></i>
                    <span><?php echo $booking->assigned_date ? date('M d, Y', strtotime($booking->assigned_date)) : 'N/A'; ?></span>
                </div>
                <div class="booking-info">
                    <i class="bi bi-cash"></i>
                    <span>&#8377;<?php echo number_format(floatval($booking->total_cost), 2); ?></span>
                </div>
            </div>
            <div class="booking-card-footer">
                <small class="text-muted">Booking #<?php echo $booking->id; ?> &middot; <?php echo date('M d, Y', strtotime($booking->created_at)); ?></small>
                <i class="bi bi-chevron-right text-muted"></i>
            </div>
        </a>
    <?php endforeach; ?>
<?php endif; ?>
