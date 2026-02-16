    </div>
</main>

<!-- Bottom Navigation -->
<nav class="app-bottomnav">
    <a href="<?php echo base_url('dashboard'); ?>" class="bottomnav-item <?php echo (isset($active_nav) && $active_nav === 'home') ? 'active' : ''; ?>">
        <i class="bi bi-house-door<?php echo (isset($active_nav) && $active_nav === 'home') ? '-fill' : ''; ?>"></i>
        <span>Home</span>
    </a>
    <a href="<?php echo base_url('book'); ?>" class="bottomnav-item <?php echo (isset($active_nav) && $active_nav === 'book') ? 'active' : ''; ?>">
        <i class="bi bi-calendar-plus<?php echo (isset($active_nav) && $active_nav === 'book') ? '-fill' : ''; ?>"></i>
        <span>Book</span>
    </a>
    <a href="<?php echo base_url('history'); ?>" class="bottomnav-item <?php echo (isset($active_nav) && $active_nav === 'history') ? 'active' : ''; ?>">
        <i class="bi bi-clock-history"></i>
        <span>History</span>
    </a>
    <a href="<?php echo base_url('profile'); ?>" class="bottomnav-item <?php echo (isset($active_nav) && $active_nav === 'profile') ? 'active' : ''; ?>">
        <i class="bi bi-person<?php echo (isset($active_nav) && $active_nav === 'profile') ? '-fill' : '-circle'; ?>"></i>
        <span>Profile</span>
    </a>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>
</html>
