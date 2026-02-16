// MopAndClean Customer App - JavaScript

document.addEventListener('DOMContentLoaded', function() {

    // Profile image preview
    var profileInput = document.getElementById('profile_image');
    if (profileInput) {
        profileInput.addEventListener('change', function(e) {
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var preview = document.getElementById('profilePreview');
                    var placeholder = document.getElementById('profilePlaceholder');
                    if (preview) {
                        preview.src = event.target.result;
                        preview.style.display = '';
                        preview.parentElement.style.display = '';
                    }
                    if (placeholder) {
                        placeholder.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Set minimum date for date picker to today
    var dateInput = document.getElementById('assigned_date');
    if (dateInput && !dateInput.value) {
        var today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
});
